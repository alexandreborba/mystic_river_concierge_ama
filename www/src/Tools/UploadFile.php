<?php
namespace Src\Tools;

class UploadFile
{
    private string $tempName;
    private string $path;
    private string $filename;
    private ?string $newName;
    private string $extension;
    private int $size;
    private string $type;
    private int $error;

    public function __construct(array $file, string $uploadDir, ?string $newName = null)
    {
        $this->tempName = $file['tmp_name'] ?? '';
        $this->filename = $file['name'] ?? '';
        $this->size     = $file['size'] ?? 0;
        $this->type     = $file['type'] ?? '';
        $this->error    = $file['error'] ?? UPLOAD_ERR_OK;
        $this->path     = rtrim($uploadDir, '/') . '/';
        $this->newName  = $newName;
        $this->extension = pathinfo($this->filename, PATHINFO_EXTENSION);

        $this->validateAndMove();
    }

    private function getUploadErrorMessage(int $code): string
    {
        return match ($code) {
            UPLOAD_ERR_INI_SIZE   => 'O arquivo excede upload_max_filesize no php.ini.',
            UPLOAD_ERR_FORM_SIZE  => 'O arquivo excede MAX_FILE_SIZE no formulário HTML.',
            UPLOAD_ERR_PARTIAL    => 'O arquivo foi apenas parcialmente enviado.',
            UPLOAD_ERR_NO_FILE    => 'Nenhum arquivo foi enviado.',
            UPLOAD_ERR_NO_TMP_DIR => 'Pasta temporária ausente.',
            UPLOAD_ERR_CANT_WRITE => 'Falha ao gravar arquivo em disco.',
            UPLOAD_ERR_EXTENSION  => 'Envio bloqueado por extensão PHP.',
            default               => 'Erro de upload desconhecido.',
        };
    }

    private function validateAndMove(): void
    {
        // 1) Verifica upload via POST
        if (!is_uploaded_file($this->tempName)) {
            throw new \InvalidArgumentException(
                "O arquivo “{$this->filename}” não é um upload HTTP válido (via POST)."
            );
        }

        // 2) Verifica se ocorreu erro no upload
        if ($this->error !== UPLOAD_ERR_OK) {
            $msg = $this->getUploadErrorMessage($this->error);
            throw new \InvalidArgumentException(
                "Falha no upload de “{$this->filename}”: {$msg} (código {$this->error})."
            );
        }

        // 3) Verifica diretório de destino
        if (!is_dir($this->path)) {
            throw new \InvalidArgumentException(
                "Diretório de destino “{$this->path}” não existe."
            );
        }
        if (!is_writable($this->path)) {
            throw new \InvalidArgumentException(
                "Sem permissão de escrita em “{$this->path}”."
            );
        }

        // 4) Define nome final
        $finalName = $this->newName !== null
            ? $this->newName . ".{$this->extension}"
            : $this->filename;
        $destination = $this->path . $finalName;

        // 5) Move o arquivo
        if (!move_uploaded_file($this->tempName, $destination)) {
            $phpErr = error_get_last();
            $detail = $phpErr['message'] ?? 'razão desconhecida';
            throw new \InvalidArgumentException(
                "Não foi possível mover “{$this->filename}” para “{$destination}”: {$detail}."
            );
        }

        // Atualiza o nome de arquivo final
        $this->newName = $finalName;
    }

    /**
     * Retorna o nome do arquivo no destino após o upload.
     */
    public function getNewFilename(): string
    {
        return $this->newName;
    }

    /**
     * Retorna o caminho completo do arquivo no servidor.
     */
    public function getFullPath(): string
    {
        return $this->path . $this->newName;
    }
}