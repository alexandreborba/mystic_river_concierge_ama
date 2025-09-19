<?php
// echo '<!-- Functions Loaded -->' . chr(10);
@ini_set('default_charset', 'UTF-8');
@ini_set('upload_max_filesize', '20M');
# @date_default_timezone_set('Europe/Lisbon');
@date_default_timezone_set('Europe/Lisbon');
@ini_set("display_errors", 0);

if (!function_exists('f_nomedafuncao')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_nomedafuncao()
    {
    }
    // endFunction
} // endif

if (!function_exists('f_addToDate')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_addToDate($dt, $quant, $tp) {
        try {
            $date = new DateTime($dt);
            
            switch (strtolower($tp)) {
                case 'd':
                    $date->modify("+{$quant} days");
                    break;
                case 'm':
                    $date->modify("+{$quant} months");
                    break;
                case 'y':
                    $date->modify("+{$quant} years");
                    break;
                default:
                    throw new Exception("Tipo inválido. Use 'd' para dias, 'm' para meses ou 'y' para anos.");
            }

            return $date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}

if (!function_exists('f_getVideoDimensions')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_getVideoDimensions($filePath) {
        $cmd = "ffprobe -v error -select_streams v:0 -show_entries stream=width,height -of json " . escapeshellarg($filePath);
        $output = shell_exec($cmd);
        $data = json_decode($output, true);

        if (isset($data['streams'][0]['width']) && isset($data['streams'][0]['height'])) {
            return $data['streams'][0]['width'] . ' x ' . $data['streams'][0]['height'];
        } else {
            return "Dimensions not found";
        }
    }
    // endFunction
    /* 
    // Example usage
    
    $video->videoFileDimensions = getVideoDimensions($videoPath);
    
    */
} // endif

if (!function_exists('f_welcomeMessage')) {
    /**
     * Função para retornar mensagem de boas-vindas
     * @return array
     */
    function f_welcomeMessage()
    {
        return [
            1 => "Welcome to the system!",
            2 => "Please log in to continue."
        ];
    }
    // endFunction
} // endif

if (!function_exists('f_ajustProductPrice')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_ajustProductPrice($price)
    {
        $price = str_replace(" €", "", $price);
        $price = str_replace(",", ".", $price);
        $price = str_replace(" ", "", $price);
        return $price;
    }
    // endFunction
} // endif

if (!function_exists('f_tempFtoC')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_tempFtoC()
    {
        $celsius = ($fahrenheit - 32) * 5 / 9;
        return $celsius;
    }
    // endFunction
} // endif

if (!function_exists('f_tempCtoF')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_tempCtoF()
    {
        $fahrenheit = ($celsius * 9 / 5) + 32;
        return $fahrenheit;
    }
    // endFunction
} // endif

if (!function_exists('f_partDate')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_partDate($date, $format='d-m', $sep='-') {
        $aDate = explode($sep, $date);
        
        $aDate = explode("-", $date);
        switch($format){
            case 'd-m':
                return $aDate[2].$sep.$aDate[1];
            break;
            case 'm-d':
                return $aDate[1].$sep.$aDate[2];
            break;
            case 'd-m-Y':
                return $aDate[2].$sep.$aDate[1].$sep.$aDate[0];
            break;
            case 'm-d-Y':
                return $aDate[1].$sep.$aDate[2].$sep.$aDate[0];
            break;
            case 'Y-m-d':
                return $aDate[0].$sep.$aDate[1].$sep.$aDate[2];
            break;
            default:
                return $aDate[0].$sep.$aDate[1].$sep.$aDate[2];
            break;
        } // end switch
        return $aDate;
    }
    // endFunction
} // endif

if (!function_exists('f_formatFirstLetter')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_formatFirstLetter($string) {
        if (strlen($string) > 0) {
            // Extrai a primeira letra
            $firstLetter = substr($string, 0, 1);
            // Formata a primeira letra com negrito e cor vermelha
            $formattedLetter = '<span style="color:red; font-weight:bold;">' . $firstLetter . '</span>';
            // Junta a primeira letra formatada com o restante da string
            $formattedString = $formattedLetter . substr($string, 1);
            return $formattedString;
        } else {
            // Se a string estiver vazia, retorna-a sem modificações
            return $string;
        }
    }
    // endFunction
} // endif

if (!function_exists('f_countFilesInDirectory')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_countFilesInDirectory($path) {
        // Verifica se o caminho é um diretório válido
        if (!is_dir($path)) {
            return 0;
        }

        // Inicializa o contador de arquivos
        $fileCount = 0;

        // Abre o diretório
        $dir = opendir($path);

        // Itera sobre os itens no diretório
        while (($file = readdir($dir)) !== false) {
            // Ignora os diretórios "." e ".."
            if ($file != "." && $file != "..") {
                // Verifica se o item é um arquivo
                if (is_file($path . DIRECTORY_SEPARATOR . $file)) {
                    $fileCount++;
                }
            }
        }

        // Fecha o diretório
        closedir($dir);

        return $fileCount;
    } // end function
} // end if



if (!function_exists('getPaginaAtual')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */
    function getPaginaAtual() {
        $paginaCompleta = $_SERVER['PHP_SELF'];
        $ultimaBarra = strrpos($paginaCompleta, '/');
        $nomePagina = substr($paginaCompleta, $ultimaBarra + 1);
        return $nomePagina;
    }
    // endFunction
} // endif

if (!function_exists('f_gen_password')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_gen_password($length = 25)
    {
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' .
            '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';

        $str = '';
        $max = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++)
        $str .= $chars[random_int(0, $max)];

        return $str;
    } // endFunction
} // endif


if (!function_exists('f_getConnHeroku')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_getConnHeroku($cleardbdatabaseurl)
    {
        # posicao dos :
        $pos1 = strpos($cleardbdatabaseurl, ":");
        $pos2 = strpos($cleardbdatabaseurl, "@");
        $pos3 = strpos($cleardbdatabaseurl, "/");
        $pos4 = strpos($cleardbdatabaseurl, "?");

        $dbConfigHeroku['driver'] = "mysql";
        $dbConfigHeroku['user'] = substr($cleardbdatabaseurl, 0, $pos1);
        $dbConfigHeroku['password'] = substr($cleardbdatabaseurl, $pos1 + 1, $pos2 - $pos1 - 1);
        $dbConfigHeroku['host'] = substr($cleardbdatabaseurl, $pos2 + 1, $pos3 - $pos2 - 1);
        $dbConfigHeroku['database'] = substr($cleardbdatabaseurl, $pos3 + 1, $pos4 - $pos3 - 1);

        #return $dbConfigHeroku;
    }
    
    // endFunction
} // endif

if (!function_exists('f_hoje')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_hoje()
    {
        return date('d-m-Y');
    }
    // endFunction
} // endif

if (!function_exists('f_todayDate')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_todayDate()
    {
        return date('Y-m-d');
    }
    // endFunction
} // endif

if (!function_exists('f_isMobile')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    // endFunction
} // endif

if (!function_exists('f_toParagraph')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_toParagraph($text, $align = 'justify', $style = null)
    {

        $aText = explode("&#13;", str_replace("&#10;", "", $text));
        $sParagraph = null;
        foreach ($aText as $txt) {
            $sParagraph .= "<p class='text-" . $align . "' style='$style'>$txt</p>" . chr(10);
        }
        return $sParagraph;
    }
    // endFunction
} // endif

if (!function_exists('f_dayNameFromDate')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_dayNameFromDate($date)
    {
        // Converte a data recebida para timestamp
        $timestamp = strtotime($date);
        
        // Retorna o nome do dia da semana em inglês
        return mb_strtolower(date('l', $timestamp));
    }
    // endFunction
} // endif

if (!function_exists('f_html_comment')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_html_comment($str)
    {
        echo '<-- comment: ' . $str . ' -->';
    }
    // endFunction
} // endif

if (!function_exists('f_HTMLcomment')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_HTMLcomment($str)
    {
        echo '<-- comment: ' . $str . ' -->';
    }
    // endFunction
} // endif

if (!function_exists('f_lower')) {
    /**
     * Funcao para converter string para Minúsculas
     * @param $str
     */
    function f_lower($str)
    {
        return mb_strtolower($str);
    }
    // endFunction
} // endif

if (!function_exists('f_upper')) {
    /**
     * Funcao para string para Maiúsculas
     * @param $str
     */
    function f_upper($str)
    {
        return mb_strtoupper($str);
    }
    // endFunction
} // endif

if (!function_exists('f_translate')) {
    /**
     * Funcao para traduzir utilizando a array aDictionary do Config.php
     * @param $string
     */
    function f_translate($string, $lang)
    {
        include_once "Dictionary.php";
        unset($translated);
        $text = $aDictionary[trim($string)][$lang];
        $translated = ($text != "") ? $text : $string;
        unset($text);
        return $translated;
    }
    // endFunction
} // endif

if (!function_exists('f_fileextension')) {
    /**
     * Funcao para extrair a extensao do ficheiro
     * @param $file_name string
     */
    function f_fileextension($filename)
    {
        return '.' . f_lower(str_replace('.', '', strrchr($filename, '.')));
    } // endFunction
} // endif

if (!function_exists('f_json_encode')) {
    /**
     * Funcao para exibir o json_encode estruturado da array
     * @param $array
     */
    function f_json_encode($array)
    {
        return "<pre>" . json_encode($array) . "</pre>";
    }
    // endFunction
} // endif

if (!function_exists('f_dd')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_dd($data)
    {
        highlight_string("<?php\n " . var_export($data, true) . "?>");
        echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
        #die();
    }
    // endFunction
} // endif
if (!function_exists('f_dump')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_dump($x)
    {
        echo "<pre>";
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args()); #die;
        echo "</pre>";
    } // endFunction
} // endif

if (!function_exists('f_md5Invert')) {
    /**
     * Funcao para gerar o Invert Md5 do conteúdo
     * @param $string
     */
    function f_md5Invert($string)
    {
        return strrev(md5($string));
    } //end function
} // endif

if (!function_exists('f_seguranca')) {
    /**
     * Funcao para evitar sql-injection em conteúdo
     * @param string|$comSeguranca
     */
    function f_seguranca($comSeguranca)
    {
        $comSeguranca = addslashes($comSeguranca);
        $comSeguranca = htmlspecialchars($comSeguranca);
        $comSeguranca = str_replace("SELECT", "",    $comSeguranca);
        $comSeguranca = str_replace("FROM", "",        $comSeguranca);
        $comSeguranca = str_replace("WHERE", "",    $comSeguranca);
        $comSeguranca = str_replace("INSERT", "",    $comSeguranca);
        $comSeguranca = str_replace("UPDATE", "",    $comSeguranca);
        $comSeguranca = str_replace("DELETE", "",    $comSeguranca);
        $comSeguranca = str_replace("DROP", "",        $comSeguranca);
        $comSeguranca = str_replace("DATABASE", "",    $comSeguranca);
        return $comSeguranca;
    } //end function
} // endif

if (!function_exists('f_security')) {
    /**
     * Funcao para evitar sql-injection em conteúdo
     * @param string|$security
     */
    function f_security($security)
    {
        $security = addslashes($security);
        $security = htmlspecialchars($security);
        $security = str_replace("SELECT", "",    $security);
        $security = str_replace("FROM", "",        $security);
        $security = str_replace("WHERE", "",        $security);
        $security = str_replace("INSERT", "",    $security);
        $security = str_replace("UPDATE", "",    $security);
        $security = str_replace("DELETE", "",    $security);
        $security = str_replace("DROP", "",        $security);
        $security = str_replace("DATABASE", "",    $security);
        return $security;
    } //end function
} // endif


if (!function_exists('f_encode')) {
    /**
     * Funcao para o encode de uma string
     * @param string|$stringamos
     */
    function f_encode($stringamos)
    {
        $base = "q2sAdu7xCNgdM6OpUt7hyrFzG3cZvb0VkljLf4XhSiReI9H3oP5m5rEaJdT9b@$["; //aqui escreves a tua propria string para substituir os caracteres ja encriptados pelo base64 (utiliza sempre 64 caracteres)
        $b64_str = base64_encode($stringamos); //aqui encriptamos em base64
        $i = 0;
        $j = 0;
        $encoded = null;
        while ($i < strlen($b64_str)) {
            if ($j == 64) $j = 0;
            $k[$i] = $b64_str[$i] . $base[$j]; //aqui o nucleo do nosso sistema de encriptação
            $encoded .= $k[$i];
            $i++;
            $j++;
        }
        return $encoded; // retornamos a nossa variavel encriptada já com o nosso sistema
    } //end function
} // endif

if (!function_exists('f_decode')) {
    /**
     * Funcao para o decode de uma string
     * @param string|$stringamos
     */
    function f_decode($stringamos)
    {
        $i = 0;
        $j = 0;
        $k = array();
        $str = ($stringamos) ? $stringamos:"";
        $decoded = null;
        while ($i < strlen($str)) {
            $k[$i] = $str[$j]; //aqui retiras os caracteres q foram adicionados à string encriptada
            $decoded .= $k[$i];
            $i++;
            $j = $j + 2;
        }
        $decoded = base64_decode($decoded); //no final de retirados os caracteres: base64_decode
        return $decoded;
    } //end function
} // endif

if (!function_exists('f_geraCod')) {
    /**
     * Função para gerar código randomico
     *  @param int | $tamanho
     *  @param bool | $maiusculas
     *  @param bool | $minusculas
     *  @param bool | $numeros
     *  @param int | $codigos
     *
     */
    function f_geraCod($tamanho = 10, $maiusculas = true, $minusculas = true, $numeros = true, $codigos = false)
    {

        // $maiusculas = true;
        // $minusculas = true;
        // $numeros 	= true;
        // $codigos 	= false;

        $maius = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
        $minus = "abcdefghijklmnopqrstuwxyz";
        $numer = "0123456789";

        $codig = '!@#$%&*()-+.,;?{[}]^><:|';
        $base = '';
        $base .= ($maiusculas) ? $maius : '';
        $base .= ($minusculas) ? $minus : '';
        $base .= ($numeros) ? $numer : '';
        $base .= ($codigos) ? $codig : '';

        srand((float) microtime() * 10000000);
        $senha = '';

        for ($i = 0; $i < $tamanho; $i++) {
            $senha .= substr($base, rand(0, strlen($base) - 1), 1);
        }

        return $senha;
    } //end function
} // endif

if (!function_exists('f_goto')) {
    /**
     * Funcao  para
     *
     *
     */
    function f_goto($irPara)
    {
        $scr  = "<script type='text/javascript'>";
        $scr .=    "window.location='" . $irPara . "';";
        $scr .=    "</script>";
        return $scr;
    } // endFunction
} // endif


if (!function_exists('f_filesSizeFormat')) {
    /**
     * Função para
     *
     *
     */
    function f_filesSizeFormat($val)
    {
        # 64.048;
        if ($val) {
            $kbytes = $val / 1024;
            $Mbytes = $kbytes / 1024;

            if ($kbytes >= 1) {
                $size = number_format($kbytes, 2, ',', '.') . " Kb (" . number_format($val, 0, ',', '.') . "  bytes)";
            }
            if ($Mbytes >= 1) {
                $size = number_format($Mbytes, 2, ',', '.') . " Mb (" . number_format($val, 0, ',', '.') . "  bytes)";
            }


            return $size;
        }
    } //end function
} // endif

if (!function_exists('f_filesSizeFormatShort')) {
    /**
     * Função para
     *
     *
     */
    function f_filesSizeFormatShort($val)
    {
        # 64.048;
        $kbytes = $val / 1024;
        $mbytes = $kbytes / 1024;

        if ($kbytes >= 1) {
            $size = number_format($kbytes, 2, ',', '.') . " Kb";
        }
        if ($mbytes >= 1) {
            $size = number_format($mbytes, 2, ',', '.') . " Mb";
        }


        return $size;
    } //end function
} // endif


if (!function_exists('f_verifica_mobile')) {
    /**
     * Função para
     *
     *
     */
    function f_verifica_mobile()
    {

        $iphone     = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $ipad       = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
        $android    = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
        $palmpre    = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
        $berry      = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
        $ipod       = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $symbian    = strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");

        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { /*Se este dispositivo for portátil, faça/escreva o seguinte */
            return true;
        } else {
            return false;
        }
    } // endFunction
} // endif

if (!function_exists('f_cap')) {
    /**
     * Função para
     *
     *
     */
    function f_cap($string)
    {
        return ucwords($string);
    
    } // endFunction
} // endif

if (!function_exists('f_caption')) {
    /**
     * Função para
     *
     *
     */
    function f_caption($string)
    {
        // utiliza a function f_minusculas();
        # $loc = setlocale(LC_CTYPE, 'pt_BR');
        # $loc = setlocale(LC_ALL, "pt_BR.ISO8859-1", "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

        $frase = $string;
        $nova_frase = '';

        $palavras = str_word_count($frase, 1, 'á,é,í,ó,Á,É,Í,Ó,à,À,â,ê,ô,Â,Ê,Ô,ã,õ,Ã,Õ,ç,Ç');
        $count_palavras = str_word_count($frase);

        for ($i = 0; $i < $count_palavras; $i++) {

            $palavra = strlen($palavras[$i]);

            if ($palavra    > 2 && $palavras[$i] != 'dos' && $palavras[$i] != 'das') {
                $palavra = ucwords(f_lower($palavras[$i]));
            } else {
                $palavra = f_lower($palavras[$i]);
            }
            $nova_frase .= ($i < $count_palavras) ? $palavra . " " : $palavra;
        }
        return $nova_frase;
    } //end function
} // endif

if (!function_exists('f_maiusculas')) {
    /**
     * Função para
     *
     *
     */
    function f_maiusculas($str)
    {
        return mb_strtoupper($str, 'UTF-8');
    } //end function
} // endif


if (!function_exists('f_minusculas')) {
    /**
     * Função para
     *
     *
     */
    function f_minusculas($str)
    {
        return mb_strtolower($str, 'UTF-8');
    } //end function
} // endif

if (!function_exists('f_resize_crop_image')) {
    /**
     * Função para
     *
     *
     */
    function f_resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $middle = 2, $quality = 80)
    {
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch ($mime) {
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                //$quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                //$quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $width) {
            //cut point by height
            $h_point = (($height - $height_new) / $middle);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        } else {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if ($dst_img) imagedestroy($dst_img);
        if ($src_img) imagedestroy($src_img);
    } //end function
} // endif



if (!function_exists('f_noSpaces')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_noSpaces($str)
    {
        return str_replace(' ', '', $str);
    } // endFunction
} // endif

if (!function_exists('f_SpaceToDash')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_SpaceToDash($str)
    {
        return str_replace(' ', '-', $str);
    } // endFunction
} // endif

if (!function_exists('f_year')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_year()
    {
        return date("Y");
    } // endFunction
} // endif

if (!function_exists('f_month')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_month()
    {
        return date("m");
    } // endFunction
} // endif

if (!function_exists('f_day')) {
    /**
     * Funcao  para
     * @param $data
     */
    function f_day()
    {
        return date("d");
    } // endFunction
} // endif

if (!function_exists('f_dateandhour')) {
    /**
     * Função para
     *
     *
     */
    function f_dateandhour()
    {
        return date("Y-m-d H:i:s");
    } //end function
} // endif

if (!function_exists('f_date')) {
    /**
     * Função para
     *
     *
     */
    function f_date()
    {
        return date("Y-m-d");
    } //end function
} // endif


if (!function_exists('f_utf8_encode')) {
    function f_utf8_encode($string){
        return mb_convert_encoding($string, 'UTF-8', 'ISO-8859-1');
    } //end function
} // endif

if (!function_exists('f_base64ErlEncode')) {
    function f_base64ErlEncode($data){
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    } //end function
} // endif

if (!function_exists('f_jwt_token_validate')) {
    function f_jwt_token_validate($token, $secretkey){
        $parts = explode(".", $token);
        $signature = f_base64ErlEncode(
            hash_hmac('sha256', $parts[0] . '.' . $parts[1], $secretkey, true)
        );
        if($signature == $parts[2]){
            $payload = json_decode(
                base64_decode($parts[1])
            );

            return true;

        }else{
            return false;
        }
    } //end function
} // endif


if (!function_exists('f_jwt_token_generate')) {
    function f_jwt_token_generate($secretkey='secret'){
        $secretkey = trim($secretkey);
        $header     = f_base64ErlEncode('{"alg": "HS256", "typ" : "JWT"}');
        $payload    = f_base64ErlEncode('{"sub": "'.md5(time()).'", "name": "MysticInvest", "iat" : '.time().'}');
        $signature  = f_base64ErlEncode(
            hash_hmac('sha256', $header . '.' . $payload, $secretkey, true)
        );
        
        return $header.'.'.$payload.'.'.$signature;

    } //end function
} // endif

if (!function_exists('f_datetime')) {
    /**
     * Função para
     *
     *
     */
    function f_datetime()
    {
        return date("Y-m-d H:i:s");
    } //end function
} // endif

if (!function_exists('f_dateimagerenew')) {
    /**
     * Função para
     *
     *
     */
    function f_dateimagerenew()
    {
        return date("YmdHis");
    } //end function
} // endif

if (!function_exists('f_dateYMDHS')) {
    /**
     * Função para
     *
     *
     */
    function f_dateYMDHS()
    {
        return date("YmdHis");
    } //end function
} // endif

if (!function_exists('f_dateImageHourRenew')) {
    /**
     * Função para
     *
     *
     */
    function f_dateImageHourRenew()
    {
        return date("YmdH");
    } //end function
} // endif

if (!function_exists('f_dateImageDayRenew')) {
    /**
     * Função para
     *
     *
     */
    function f_dateImageDayRenew()
    {
        return date("Ymd");
    } //end function
} // endif

if (!function_exists('f_dateImageMounthRenew')) {
    /**
     * Função para
     *
     *
     */
    function f_dateImageMounthRenew()
    {
        return date("Ym");
    } //end function
} // endif

if (!function_exists('f_ip')) {
    /**
     * Função para
     *
     *
     */
    function f_ip()
    {
        //return $_SERVER['REMOTE_ADDR'];
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    } //end function
} // endif

if (!function_exists('f_txt_to_br')) {
    /**
     * Função para
     *
     *
     */
    function f_txt_to_br($txt)
    {
        $txt = str_replace("&#13;&#10;", "<br>", $txt);
        $txt = str_replace("&#13;", "<br>", $txt);
        $txt = str_replace("&#10;", "<br>", $txt);
        return $txt;
    } //end function
} // endif

if (!function_exists('f_br_to_txt')) {
    /**
     * Função para
     *
     *
     */
    function f_br_to_txt($txt)
    {
        $txt = str_replace("<br>", "&#13;&#10;", $txt);
        return $txt;
    } //end function
} // endif

if (!function_exists('f_quotes')) {
    /**
     * Função para
     *
     *
     */
    function f_quotes($string)
    {
        # retira aspas e apostrofes
        # 	Chr(34)- aspas simples
        # 	Chr(39)- aspas duplas

        $string = str_replace(chr(34), "´", $string);
        $string = str_replace(chr(39), "´", $string);

        return trim($string);
    } //end function
} // endif

if (!function_exists('f_sanitize_email')) {
    /**
     * Função para
     *
     *
     */
    function f_sanitize_email($field)
    {
        $field = filter_var($field, FILTER_SANITIZE_EMAIL);
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    } //end function
} // endif
if (!function_exists('f_ajustDate')) {
    function f_ajustDate($date, $sep='-'){
        $div = (str_contains($date, '-')) ? "-":"/";
        $aDate = explode($div, $date);
        return $aDate[2].$sep.$aDate[1].$sep.$aDate[0];
    } //end function
} // endif

if (!function_exists('f_ajustTime')) {
    function f_ajustTime($time){
        
        $aTime = explode(":", $time);
        return $aTime[0].':'.$aTime[1];
    } //end function
} // endif

if (!function_exists('f_ajustDateTime')) {
    /**
     * Função para
     *
     *
     */
    function f_ajustDateTime($original_date_hour)
    {
        return f_dateHourAjustFormat($original_date_hour);
    } //end function
} // endif

if (!function_exists('f_ajustDateTimeToDate')) {
    /**
     * Função para
     *
     *
     */
    function f_ajustDateTimeToDate($datetime)
    {
        return substr($datetime, 0, 10);
    } //end function
} // endif


if (!function_exists('f_dateHourAjustFormat')) {
    /**
     * Função para
     *
     *
     */
    function f_dateHourAjustFormat($original_date_hour)
    {
        #formata data dd/mm/aaaa -> aaaa/mm/dd (vice-versa)
        $data = explode(" ", $original_date_hour);

        $original_date_hour    = $data[0];
        $original_time         = $data[1];

        if (substr_count($original_date_hour, "-") > 0) {
            $data_form_date = implode('-', array_reverse(explode('-', $original_date_hour)));
            $data_form_date = str_replace("-", "/", $data_form_date);
            $original_time = substr($original_time, 0, -3);
        }
        if (substr_count($original_date_hour, "/") > 0) {
            $data_form_date = implode('/', array_reverse(explode('/', $original_date_hour)));
            $data_form_date = str_replace("/", "-", $data_form_date);
        }
        return "$data_form_date $original_time";
    } //end function
} // endif

if (!function_exists('f_newLines')) {
    /**
     * Função para
     *
     *
     */
    function f_newLines($txt)
    {
        $txt = str_replace(chr(13), "<br />", $txt);
        return $txt;
    } //end function
} // endif

if (!function_exists('f_getBrowser')) {
    /**
     * Funcao  para
     *
     *
     */
    function f_getBrowser()
    {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        // Identify the browser. Check Opera and Safari first in case of spoof. Let Google Chrome be identified as Safari.
        if (preg_match('/opera/', $userAgent)) {
            $name = 'Opera';
        } elseif (preg_match('/webkit/', $userAgent)) {
            $name = 'Safari';
        } elseif (preg_match('/msie/', $userAgent)) {
            $name = 'Microsoft Internet Explorer';
        } elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent)) {
            $name = 'Mozilla Firefox';
        } else {
            $name = 'desconhecido';
        }

        // What version?
        if (preg_match('/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches)) {
            $version = $matches[1];
        } else {
            $version = 'desconhecida';
        }

        // Running on what platform?
        if (preg_match('/linux/', $userAgent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/', $userAgent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/', $userAgent)) {
            $platform = 'windows';
        } else {
            $platform = 'desconhecida';
        }

        return array(
            'nome'      => $name,
            'versao'   => $version,
            'plataforma'  => $platform,
            'userAgent' => $userAgent
        );
    } //end function
} // endif

if (!function_exists('f_showLink')) {
    function f_showLink($string)
    {
        preg_match_all('#(\w*://|www\.)[a-z0-9]+(-+[a-z0-9]+)*(\.[a-z0-9]+(-+[a-z0-9]+)*)+(/([^\s()<>;]+\w)?/?)?#i', $string, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
        foreach (array_reverse($matches) as $match) {
            $a = '<a title=\'Clique para abrir em uma nova aba!\' target=\'_blank\' href="' . (strpos($match[1][0], '/') ? '' : 'http://') . $match[0][0] . '">' . $match[0][0] . '</a>';
            $string = substr_replace($string, $a, $match[0][1], strlen($match[0][0]));
        }
        return $string;
    } //end function
} // endif

if (!function_exists('f_gerarLinks')) {
    /**
     * A função MontarLink() transforma em links as URLs iniciadas por 'http://' ou 'www' contidas no argumento 'texto'.
     * Se a URL tiver mais que 60 caracteres, serão exibidos os 25 primeiros, seguidos de reticências (...) e os últimos 15.
     * Se 'texto' não for uma string, a função retorna 'texto' sem quaisquer alterações.
     */

    function f_gerarLinks($comment)
    {
        if (!is_string($comment)) return $comment;

        if (preg_match('@[^(http://)]((www\.)[a-zA-Z0-9./?&_\-#=;%]+)@i', $comment)) {
            $comment = preg_replace('@[^(http://)]((www\.)[a-zA-Z0-9./?&_\-#=;%]+)@i', ' http://$1', $comment);
        }
        if (preg_match('@((http://)[a-zA-Z0-9./?&_\-#=;%]+)@i', $comment)) {
            $comment = preg_replace('@((http://)[a-zA-Z0-9./?&_\-#=;%]+)@i', "<a target='_blank' href='$1'>$1</a>", $comment);
        }

        return $comment;
    } //end function
} // endif


if (!function_exists('f_getAge')) {
    /**
     *function f_getIdade($aniversario, $curr = 'now') {
     *	$year_curr = date("Y", strtotime($curr));
     *	$days = !($year_curr % 4) || !($year_curr % 400) & ($year_curr % 100) ? 366: 355;
     *	list($d, $m, $y) = explode('/', $aniversario);
     *	return floor(((strtotime($curr) - mktime(0, 0, 0, $m, $d, $y)) / 86400) / $days);
     *} //end function
     **/
    function f_getAge($dtAniversario)
    {
        // formato da data de aniversario YYYY-MM-DD
        $dateNow  = new DateTime($dtAniversario . ' 00:00:00'); // data e hora de nascimento

        $interval = $dateNow->diff(new DateTime()); // data e hora atual

        # echo $interval->format( '%Y Anos, %m Meses, %d Dias, %H Horas, %i Minutos e %s Segundos' ); // 110 Anos, 2 Meses, 3 Dias, 02 Horas, 2 Minutos e 54 Segundos
        return $interval->format('%Y anos');
    }
} // endif

if (!function_exists('f_age')) {
    function f_age($dateOfBirth)
    {
        #$dateOfBirth = "17-10-1985";
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
    } //end function
} // endif

if (!function_exists('f_agecalculator')) {
    function f_agecalculator($data_nasc)
    { // dd/mm/yyyy

        $data_nasc = explode('/', $data_nasc);

        $data = date('d/m/Y');

        $data = explode('/', $data);

        $anos = $data[2] - $data_nasc[2];

        //return $data[2].' - '.$data_nasc[2];

        if ($data_nasc[1] > $data[1]) {
            return $anos - 1;
        }


        if ($data_nasc[1] == $data[1])
            if ($data_nasc[0] <= $data[0]) {
                return $anos;
                //break;
            } else {
                return $anos - 1;
                //break;
            }

        if ($data_nasc[1] < $data[1])
            return $anos;
    }
} //end if

if (!function_exists('f_diffDays')) {
     /**
     * Function to calculate diferrence between two dates in days
     * @param string $sDate
     * @param string $fDate
     * @return int
     */
    function f_diffDays($sDate,$fDate)
    {
        $startDate = new DateTime($sDate);
        $endDate = new DateTime($fDate);
        $difference = $endDate->diff($startDate);
        return $difference->format("%a");
    }
} //end if

if (!function_exists('f_dayOfWeek')) {
    function f_dayOfWeek($date){

        //Get the day of the week using PHP's date function.
        $dayOfWeek = date("l", strtotime($date));

        //Print out the day that our date fell on.
        return f_Caption(strtolower($dayOfWeek));
    }
}
if (!function_exists('f_diaDaSemana')) {
    function f_diaDaSemana($date){

        $daysRef = array(
            'Monday'    => 'Segunda-Feira',
            'Tuesday'   => 'Terça-Feira',
            'Wednesday' => 'Quarta-Feira',
            'Thursday'  => 'Quinta-Feira',
            'Friday'    => 'Sexta-Feira',
            'Saturday'  => 'Sábado',
            'Sunday'    => 'Domingo',
        );

        //Get the day of the week using PHP's date function.
        $dayOfWeek = date("l", strtotime($date));

        //Print out the day that our date fell on.
        return strtolower($daysRef[$dayOfWeek]);
    }
}
if (!function_exists('f_age')) {
    function f_age($ddmmaaaa)
    {
        // Declara a data! :P
        $data = $ddmmaaaa;

        // Separa em dia, mês e ano
        list($dia, $mes, $ano) = explode('/', $data);

        // Descobre que dia é hoje e retorna a unix timestamp
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);

        // Depois apenas fazemos o cálculo já citado :)
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        return $idade;
    } // END function
} // END if

if (!function_exists('f_hide_email')) {
    function f_hide_email($email)
    {
        $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
        $key = str_shuffle($character_set);
        $cipher_text = '';
        $id = 'e' . rand(1, 999999999);
        for ($i = 0; $i < strlen($email); $i += 1) $cipher_text .= $key[strpos($character_set, $email[$i])];
        $script = 'var a="' . $key . '";var b=a.split("").sort().join("");var c="' . $cipher_text . '";var d="";';
        $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
        $script .= 'document.getElementById("' . $id . '").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';
        $script = "eval(\"" . str_replace(array("\\", '"'), array("\\\\", '\"'), $script) . "\")";
        $script = '<script type="text/javascript">/*<![CDATA[*/' . $script . '/*]]>*/</script>';
        return '<span id="' . $id . '">[javascript protected email address]</span>' . $script;
    } // END function
} // END if

if (!function_exists('f_mascara_cpf')) {
    /**
     * Função para
     *
     *
     */
    function f_mascara_cpf($string)
    {
        #	999.999.999-99
        $mask = substr($string, 0, 3) . ".";
        $mask .= substr($string, 3, 3) . ".";
        $mask .= substr($string, 6, 3) . "-";
        $mask .= substr($string, 9, 2);

        return $mask;
    } //end function
} // endif

if (!function_exists('f_emailpart')) {
    function f_emailpart($email, $mask_char = '*', $perc = 50)
    {
        list($user, $domain) = preg_split("/@/", $email);

        $len = strlen($user);
        $mask_count = floor($len * $perc / 100);
        $offset = floor(($len - $mask_count) / 2);
        $masked = substr($user, 0, $offset)
            . str_repeat($mask_char, $mask_count)
            . substr($user, $mask_count + $offset);

        return ($masked . '@' . $domain);
    } // END function
} // END if

if (!function_exists('f_cutText')) {

    function f_cutText($texto, $limite = 100, $tres_p = ' …')
    {
        //Retorna o texto em plain/text
        $trans_tbl = get_html_translation_table(HTML_ENTITIES);
        $trans_tbl = array_flip($trans_tbl);
        $texto = trim(strip_tags(strtr($texto, $trans_tbl)));

        if (strlen($texto) <= $limite)
            return $texto;
        $result = array_shift(explode('||', wordwrap($texto, $limite, '||')));
        return $result . $tres_p;
    }
} // endif


if (!function_exists('f_accentsRemove')) {
    /**
     * Função para
     *
     *
     */
    function f_accentsRemove($string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    } //end function
} // endif

if (!function_exists('f_time_diff')) {
    /**
     * Função para
     *
     *
     */
    function f_time_diff($from, $to, $full = false) {
        $from = new DateTime($from);
        $to = new DateTime($to);
        $diff = $to->diff($from);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'ano',
            'm' => 'mes',
            'w' => 'semana',
            'd' => 'dia',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                if($v == "mes"){
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 'es' : '');
                }else{
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                }

            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' atrás' : 'just now';
    }
} // endif

if(!function_exists('f_respCode')){
    function f_respCode($code){
        echo http_response_code($code);
    }
}

if (!function_exists('f_httpCode')) {
    /**
     * Função para
     *
     *
     */
    function f_httpCode($code = NULL) {
        if ($code !== NULL) {
            switch ($code) {
                case 100: $text='HTTP/1.1 ' . $code .'Continue';
                    break;
                case 101: $text='HTTP/1.1 ' . $code . 'Switching Protocols';
                    break;
                case 200: $text='HTTP/1.1 ' . $code . 'OK';
                    break;
                case 201: $text='HTTP/1.1 ' . $code . 'Created';
                    break;
                case 202: $text='HTTP/1.1 ' . $code . 'Accepted';
                    break;
                case 203: $text='HTTP/1.1 ' . $code . 'Non-Authoritative Information';
                    break;
                case 204: $text='HTTP/1.1 ' . $code . 'No Content';
                    break;
                case 205: $text='HTTP/1.1 ' . $code . 'Reset Content';
                    break;
                case 206: $text='HTTP/1.1 ' . $code . 'Partial Content';
                    break;
                case 300: $text='HTTP/1.1 ' . $code . 'Multiple Choices';
                    break;
                case 301: $text='HTTP/1.1 ' . $code . 'Moved Permanently';
                    break;
                case 302: $text='HTTP/1.1 ' . $code . 'Moved Temporarily';
                    break;
                case 303: $text='HTTP/1.1 ' . $code . 'See Other';
                    break;
                case 304: $text='HTTP/1.1 ' . $code . 'Not Modified';
                    break;
                case 305: $text='HTTP/1.1 ' . $code . 'Use Proxy';
                    break;
                case 400: $text='HTTP/1.1 ' . $code . 'Bad Request';
                    break;
                case 401: $text='HTTP/1.1 ' . $code . 'Unauthorized';
                    break;
                case 402: $text='HTTP/1.1 ' . $code . 'Payment Required';
                    break;
                case 403: $text='HTTP/1.1 ' . $code . 'Forbidden';
                    break;
                case 404: $text='HTTP/1.1 ' . $code . 'Not Found';
                    break;
                case 405: $text='HTTP/1.1 ' . $code . 'Method Not Allowed';
                    break;
                case 406: $text='HTTP/1.1 ' . $code . 'Not Acceptable';
                    break;
                case 407: $text='HTTP/1.1 ' . $code . 'Proxy Authentication Required';
                    break;
                case 408: $text='HTTP/1.1 ' . $code . 'Request Time-out';
                    break;
                case 409: $text='HTTP/1.1 ' . $code . 'Conflict';
                    break;
                case 410: $text='HTTP/1.1 ' . $code . 'Gone';
                    break;
                case 411: $text='HTTP/1.1 ' . $code . 'Length Required';
                    break;
                case 412: $text='HTTP/1.1 ' . $code . 'Precondition Failed';
                    break;
                case 413: $text='HTTP/1.1 ' . $code . 'Request Entity Too Large';
                    break;
                case 414: $text='HTTP/1.1 ' . $code . 'Request-URI Too Large';
                    break;
                case 415: $text='HTTP/1.1 ' . $code . 'Unsupported Media Type';
                    break;
                case 500: $text='HTTP/1.1 ' . $code . 'Internal Server Error';
                    break;
                case 501: $text='HTTP/1.1 ' . $code . 'Not Implemented';
                    break;
                case 502: $text='HTTP/1.1 ' . $code . 'Bad Gateway';
                    break;
                case 503: $text='HTTP/1.1 ' . $code . 'Service Unavailable';
                    break;
                case 504: $text='HTTP/1.1 ' . $code . 'Gateway Time-out';
                    break;
                case 505: $text='HTTP/1.1 ' . $code . 'HTTP Version not supported';
                    break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . $code . ' ' . $text);
            $GLOBALS['http_response_code'] = $code;
        } else {
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }
        return $code;
    } // end function
} // end if

if (!function_exists('f_cotacao')) {
    /**
     * Funcao  para buscar a cotacao em tempo real
     * @param $data
     */
    function f_cotacao($moeda='USD')
    {
        $hg = file_get_contents("https://economia.awesomeapi.com.br/last/{$moeda}-BRL");
        
        $aCotacao = json_decode($hg, true);
        return $aCotacao["{$moeda}BRL"]["high"];

    } // endFunction
} // endif

if(!function_exists('seems_utf8')){
    function seems_utf8( $str ) {
        mbstring_binary_safe_encoding();
        $length = strlen( $str );
        reset_mbstring_encoding();
        for ( $i = 0; $i < $length; $i++ ) {
            $c = ord( $str[ $i ] );
            if ( $c < 0x80 ) {
                $n = 0; // 0bbbbbbb
            } elseif ( ( $c & 0xE0 ) == 0xC0 ) {
                $n = 1; // 110bbbbb
            } elseif ( ( $c & 0xF0 ) == 0xE0 ) {
                $n = 2; // 1110bbbb
            } elseif ( ( $c & 0xF8 ) == 0xF0 ) {
                $n = 3; // 11110bbb
            } elseif ( ( $c & 0xFC ) == 0xF8 ) {
                $n = 4; // 111110bb
            } elseif ( ( $c & 0xFE ) == 0xFC ) {
                $n = 5; // 1111110b
            } else {
                return false; // Does not match any model.
            }
            for ( $j = 0; $j < $n; $j++ ) { // n bytes matching 10bbbbbb follow ?
                if ( ( ++$i == $length ) || ( ( ord( $str[ $i ] ) & 0xC0 ) != 0x80 ) ) {
                    return false;
                }
            }
        }
        return true;

    } // endFunction
} // endif

if(!function_exists('f_retiraAcentos')){
    /**
    * Função para
    *
    *
    */
    function f_retiraAcentos($string) {

        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
        
        $new_string = str_replace($comAcentos, $semAcentos, $string);
        return $new_string;
        
    } //end function
} // endif

if (!function_exists('f_getWeekday')) {
    /**
     * Function to find a weekday from a date
     * @param $data
     */
    function f_getWeekday($date) {
        #$days = ['DOM','segunda-feira','terça-feira','quarta-feira','quinta-feira','sexta-feira','SAB',];
        $days = [
            1 => 'DOM',
            2 => 'segunda-feira',
            3 => 'terça-feira',
            4 => 'quarta-feira',
            5 => 'quinta-feira',
            6 => 'sexta-feira',
            7 => 'SAB',
        ];
        $weekdayNumber = date('w', strtotime($date))+1;
        if($weekdayNumber>7) $weekdayNumber = 1; // Ajusta o domingo para 1
        $weekdayName = $days[$weekdayNumber];
        $weekday['number'] = $weekdayNumber;
        $weekday['name'] = $weekdayName;
        return $weekday;
    }
    // endFunction
} // endif

if (!function_exists('f_getWeekdayShort')) {
    /**
     * Function to find a weekday from a date
     * @param $data
     */
    function f_getWeekdayShort($date) {
        #$days = ['DOM','segunda-feira','terça-feira','quarta-feira','quinta-feira','sexta-feira','SAB',];
        $days = [
            1 => 'DOM',
            2 => 'SEG',
            3 => 'TER',
            4 => 'QUA',
            5 => 'QUI',
            6 => 'SEX',
            7 => 'SAB',
        ];
        $weekdayNumber = date('w', strtotime($date))+1;
        if($weekdayNumber>7) $weekdayNumber = 1; // Ajusta o domingo para 1
        $weekdayName = $days[$weekdayNumber];
        $weekday['number'] = $weekdayNumber;
        $weekday['name'] = $weekdayName;
        return $weekday;
    }
    // endFunction
} // endif

if(!function_exists('f_limpaMascaras')){
    /**
    * Função para
    *
    *
    */
    function f_limpaMascaras($texto){
            $limpa = $texto;
            $limpa = str_replace('.','',$limpa);
            $limpa = str_replace(':','',$limpa);
            $limpa = str_replace('-','',$limpa);
            $limpa = str_replace('/','',$limpa);
            $limpa = str_replace(',','',$limpa);
            $limpa = str_replace('(','',$limpa);
            $limpa = str_replace(')','',$limpa);
            $limpa = str_replace(' ','',$limpa);
            $limpa = str_replace('•','-',$limpa);
    return $limpa;
    }//end function
} // endif

if (!function_exists('f_actualMonth')) {
    /**
     * Function to find a weekday from a date
     * @param $data
     */
    function f_actualMonth($data=null) {
        if (empty($data)) {
            $data = date('Y-m-d'); // Obtém a data atual no formato 'YYYY-MM-DD'
        }
        // Extrai o mês da data
        $mesAtual = date('m', strtotime($data));

        return $mesAtual;
    }
    // endFunction
} // endif

if (!function_exists('f_lastDayOfMonth')) {
    /**
     * Function to find a weekday from a date
     * @param $data
     */
    function f_lastDayOfMonth($date=null) {
       // Converting string to date
       return date("Y-m-t", strtotime($date));
    }
    // endFunction
} // endif

if (!function_exists('f_firstDayOfMonth')) {
    /**
     * Function to find a weekday from a date
     * @param $data
     */
    function f_firstDayOfMonth($date=null){

        return date("Y-m-01", strtotime($date));
    }
} // endif

if (!function_exists('f_noSeconds')) {
    /**
     * Function to find a weekday from a date
     * @param $data
     */
    function f_noSeconds($time) {
       $time = explode(":", $time);
       return $time[0].':'.$time[1];
    }
    // endFunction
} // endif

if (!function_exists('f_timeToMinutes')) {
    /**
     * Function to find a weekday from a date
     * @param $data
     */
    function f_timeToMinutes($time) {

        $var_array_h_m = explode(":",$time);
        $var_array_h_m[0];
        $var_array_h_m[1];		
        $var_tot_minutos = ($var_array_h_m[0] *60);
        $var_tot_minutos = $var_tot_minutos + $var_array_h_m[1];
    
        return $var_tot_minutos;
    }
    // endFunction
} // endif

if (!function_exists('f_diffMinutes')) {
    /**
     * Function to 
     * @param $h1
     * @param $h2
     */
    function f_diffMinutes($h1, $h2) {
        // Criar objetos DateTime com os horários recebidos como strings
        $datetime1 = new DateTime($h1);
        $datetime2 = new DateTime($h2);

        // Calcular a diferença em minutos entre os horários
        $interval = $datetime1->diff($datetime2);
        $diferencaEmMinutos = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

        return $diferencaEmMinutos;
    }
    // endFunction
} // endif
if (!function_exists('f_sumMinutes')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */
    function f_sumMinutes($mA, $mB) {
        // Somar os minutos
        $totalMinutos = $mA + $mB;

        // Calcular as horas e minutos
        $horas = floor($totalMinutos / 60);
        $minutos = $totalMinutos % 60;

        // Formatar o resultado para hh:mm
        $resultado = sprintf('%02d:%02d', $horas, $minutos);

        return $resultado;
    }
    // endFunction
} // endif

if (!function_exists('f_sumMinutesToTime')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */
    function f_sumMinutesToTime($mA, $mB) {
        // Somar os minutos
        $totalMinutos = $mA + $mB;

        // Calcular as horas e minutos
        $horas = floor($totalMinutos / 60);
        $minutos = $totalMinutos % 60;

        // Formatar o resultado para hh:mm
        $resultado = sprintf('%02d:%02d', $horas, $minutos);

        return $resultado;
    }
    // endFunction
} // endif

if (!function_exists('f_daysOfMonth')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */
    function f_daysOfMonth($date) {
        
        $startDate = new DateTime($date);
        $startDate->modify('first day of this month');
        $endDate = new DateTime($date);
        $endDate->modify('last day of this month');

        $dates = array();

        while ($startDate <= $endDate) {
            if ($startDate->format('N') <= 5) { // Dias da semana de segunda a sexta-feira (1 a 5)
                $dates[] = $startDate->format('Y-m-d');
            }
            $startDate->modify('+1 day');
        }

        return $dates;
    }
    // endFunction
} // endif

if (!function_exists('f_firstAndLastDayOfMonth')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */
    function f_firstAndLastDayOfMonth($date) {
        
        $startDate = new DateTime($date);
        $startDate->modify('first day of this month');
        
        $endDate = new DateTime($date);
        $endDate->modify('last day of this month');

        $f = $startDate->format('Y-m-d');
        $l = $endDate->format('Y-m-d');

        
        return array(
            "fd"=>$f, 
            "ld"=>$l
        );
    }
    // endFunction
} // endif


if (!function_exists('f_quantoTempoFalta')) {
    function f_quantoTempoFalta($dtAtual, $dtAniversario) {
        $dataAtual = new DateTime($dtAtual);
        $aDtAniversario = explode("-",$dtAniversario);
        $dtAniversario = date("Y").'-'.$aDtAniversario[1].'-'.$aDtAniversario[2];
        $dataAniversario = new DateTime($dtAniversario);
    
        $interval = $dataAtual->diff($dataAniversario);

        $txt = '-> ';
        if ($interval->m >0) $txt .= $interval->m . " meses, ";
        if ($interval->d >0) $txt .= $interval->d . " dias";
        return $txt;
    }
} // endif

if (!function_exists('f_qtdDiasUteis')) {
    function f_qtdDiasUteis($dataInicial, $dataFinal) {
        $diasUteis = 0;
    
        $dataAtual = new DateTime($dataInicial);
        $dataFinal = new DateTime($dataFinal);
    
        while ($dataAtual <= $dataFinal) {
            $diaSemana = $dataAtual->format('N'); // 1 (segunda) a 7 (domingo)
            
            // Verifica se o dia da semana não é sábado (6) ou domingo (7)
            if ($diaSemana < 6) {
                $diasUteis++;
            }
    
            $dataAtual->modify('+1 day'); // Avança para o próximo dia
        }
    
        return $diasUteis;
    }
} // endif
if (!function_exists('getDiasUteisDaSemana')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */

    function getDiasUteisDaSemana($dataInformada) {
        // Convertendo a data informada para um objeto DateTime
        $data = new DateTime($dataInformada);

        // Obtendo o dia da semana (0 - domingo, 1 - segunda, ..., 6 - sábado)
        $diaSemana = $data->format('w');

        // Calculando o deslocamento para o primeiro dia útil (segunda-feira)
        $diasParaPrimeiroDiaUtil = 1 - $diaSemana;
        if ($diasParaPrimeiroDiaUtil >= 0) {
            $diasParaPrimeiroDiaUtil -= 7; // Se o dia da semana for segunda-feira ou posterior, recuamos uma semana
        }

        // Calculando o deslocamento para o último dia útil (sexta-feira)
        $diasParaUltimoDiaUtil = 5 - $diaSemana;
        if ($diasParaUltimoDiaUtil <= 0) {
            $diasParaUltimoDiaUtil += 7; // Se o dia da semana for sexta-feira ou anterior, avançamos uma semana
        }

        // Obtendo o primeiro dia útil da semana
        $primeiroDiaUtil = clone $data;
        $primeiroDiaUtil->modify("$diasParaPrimeiroDiaUtil days");

        // Obtendo o último dia útil da semana
        $ultimoDiaUtil = clone $data;
        $ultimoDiaUtil->modify("$diasParaUltimoDiaUtil days");

        return array(
            'pDU' => $primeiroDiaUtil->format('Y-m-d'),
            'uDU' => $ultimoDiaUtil->format('Y-m-d')
        );
    }
    // endFunction
} // endif


if (!function_exists('getDiasUteisDaSemanaMes')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */

    function getDiasUteisDaSemanaMes($dataInformada) {
        // Convertendo a data informada para um objeto DateTime
        $data = new DateTime($dataInformada);

        // Obtendo o dia da semana (0 - domingo, 1 - segunda, ..., 6 - sábado)
        $nrodiaSemana = $data->format('w');

        // Calculando o deslocamento para o primeiro dia útil (segunda-feira)
        $diasParaPrimeiroDiaUtil = 1 - $nrodiaSemana;
        if ($diasParaPrimeiroDiaUtil >= 0) {
            $diasParaPrimeiroDiaUtil -= 7; // Se o dia da semana for segunda-feira ou posterior, recuamos uma semana
        }

        // Calculando o deslocamento para o último dia útil (sexta-feira)
        $diasParaUltimoDiaUtil = 5 - $nrodiaSemana;
        if ($diasParaUltimoDiaUtil <= 0) {
            $diasParaUltimoDiaUtil += 7; // Se o dia da semana for sexta-feira ou anterior, avançamos uma semana
        }

        // Obtendo o primeiro dia útil da semana
        $primeiroDiaUtil = clone $data;
        $primeiroDiaUtil->modify("$diasParaPrimeiroDiaUtil days");

        // Obtendo o último dia útil da semana
        $ultimoDiaUtil = clone $data;
        $ultimoDiaUtil->modify("$diasParaUltimoDiaUtil days");

        return array(
            'pDU' => $primeiroDiaUtil->format('Y-m-d'),
            'uDU' => $ultimoDiaUtil->format('Y-m-d')
        );
    }
    // endFunction
} // endif

if (!function_exists('f_minToHours')) {
    /**
     * Function to 
     * @param $m1
     * @param $m2
     */
    function f_minToHours($min){
        return sprintf("%02d:%02d", floor($min/60), $min%60);
    }
    // endFunction
} // endif

if (!function_exists('f_isThisMonth')) {
    /**
     * Function to 
     * @param $date
     */
    function f_isThisMonth($date){
        $aDate = explode('-', $date);
        $dateYear = $aDate[0];
        $dateMonth = $aDate[1];

        $today = date('Y-m-d');
        $aToday = explode('-', $today);
        $todayYear = $aToday[0];
        $todayMonth = $aToday[1];

        return ($dateYear == $todayYear && $dateMonth == $todayMonth) ? true : false;
    }
    // endFunction
} // endif

if (!function_exists('f_monthNameByDate')) {
    /**
     * Function to 
     * @param $date
     */
    function f_monthNameByDate($date, $lang = 'pt-br'){
        $aDate = explode('-', $date);
        $monthDate = $aDate[1];
        $sMonths = [ 
                'lang' => 'en', 
                'months' => [   '01' => 'January', 
                                '02' => 'February', 
                                '03' => 'March', 
                                '04' => 'April', 
                                '05' => 'May', 
                                '06' => 'June', 
                                '07' => 'July', 
                                '08' => 'August', 
                                '09' => 'September', 
                                '10' => 'October', 
                                '11' => 'November', 
                                '12' => 'December'
                ],
                
                'lang' => 'pt-br', 
                'months' => [   '01' => 'Janeiro', 
                                '02' => 'Fevereiro', 
                                '03' => 'Março', 
                                '04' => 'Abril', 
                                '05' => 'Maio', 
                                '06' => 'Junho', 
                                '07' => 'Julho', 
                                '08' => 'Agosto', 
                                '09' => 'Setembro', 
                                '10' => 'Outubro', 
                                '11' => 'Novembro', 
                                '12' => 'Dezembro'
                ],
        ];
        
        return $sMonths[$lang]['months'][$monthDate];;
    }
    // endFunction
} // endif


if (!function_exists('f_monthNameByNumber')) {
    /**
     * Function to 
     * @param $date
     */
    function f_monthNameByNumber($number, $lang = 'pt-br'){

        $sMonths["pt-br"] = ['01' => 'Janeiro', 
                                '02' => 'Fevereiro', 
                                '03' => 'Março', 
                                '04' => 'Abril', 
                                '05' => 'Maio', 
                                '06' => 'Junho', 
                                '07' => 'Julho', 
                                '08' => 'Agosto', 
                                '09' => 'Setembro', 
                                '10' => 'Outubro', 
                                '11' => 'Novembro', 
                                '12' => 'Dezembro'
                
        ];
        #return 'test';
        return $sMonths[$lang][$number];
    }
    // endFunction
} // endif


if (!function_exists('f_zip')) {
    function f_zip($thisdir, $zipfile='zipfile'){

        
    }  //end function
} // endif


if (!function_exists('f_unzip')) {
    function f_unzip($filename){

    }
    //end function
} // endif

if (!function_exists('f_gen_randompass')) {
    function f_gen_randompass($passlength = 8){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#%^*>\$@?/[]=+';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $passlength; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }//end function
} // endif

if (!function_exists('f_debug')) {
    function f_debug($content) {
       echo "<!-- debug  : {$content}-->";

    } // end function
} // endif

if (!function_exists('f_firstName')) {
    function f_firstName($fullname) {
        $aName = explode(' ', $fullname);
    
    return $aName[0];
    } // end function
} // endif

if (!function_exists('f_partOfText')) {
    function f_partOfText($text, $size) {
        $parteDoTexto = substr($text, 0, $size);
    
    return $parteDoTexto;
    } // end function
} // endif

if (!function_exists('f_genUsername')) {
    function f_genUsername($fullName) {
        // Divide o nome completo em partes usando espaços como delimitador
        $parts = explode(" ", $fullName);

        // Verifica se há pelo menos duas partes (nome e sobrenome)
        if (count($parts) >= 2) {
            // Obtém o primeiro nome
            $firstName = $parts[0];

            // Obtém o último sobrenome
            $lastName = $parts[count($parts) - 1];

            // Concatena o primeiro nome e o último sobrenome com um ponto entre eles
            $username = $firstName . '.' . $lastName;

            return $username;
        } else {
            // Retorna uma mensagem de erro se o nome completo não tiver pelo menos duas partes
            return "Nome completo inválido";
        }
    }//end function
} // endif

if (!function_exists('f_printTemplateText')) {
    function f_printTemplateText($text, $changes) {
        foreach ($changes as $variable => $value) {
            $text = str_replace("%$variable%", $value, $text);
        }
        return $text;

    } // end function
} // endif

if (!function_exists('f_prevMonthsAndYears')) {
    function f_prevMonthsAndYears($date) {
        // Convert the date into a DateTime object
        $currentDate = new DateTime($date);

        // Get the month and year from the current date
        $currentMonth = $currentDate->format('n');
        $currentYear = $currentDate->format('Y');

        // Create an array to store the previous months and years
        $previousMonthsAndYears = [];

        // Add the current month and year to the beginning of the array
        $previousMonthsAndYears[] = [
            'month' => $currentMonth,
            'year' => $currentYear,
        ];

        // Loop to get the previous months and years
        for ($i = 1; $i < $currentMonth; $i++) {
            // Calculate the previous month and year
            $previousMonth = $currentMonth - $i;
            $previousYear = $currentYear;

            if ($previousMonth <= 0) {
                // If the month is less than or equal to 0, adjust the month and year
                $previousMonth += 12;
                $previousYear -= 1;
            }

            // Format the month as two digits
            $formattedMonth = sprintf("%02d", $previousMonth);

            // Add the month and year to the array
            $previousMonthsAndYears[] = [
                'm' => $formattedMonth,
                'y' => $previousYear,
            ];
        }


        // Return the array with previous months and years
        return $previousMonthsAndYears;
    } // end function
} // endif

if (!function_exists('f_genUsername')) {
    function f_genUsername($fullName)
    {
        $removedMultispace = preg_replace('/\s+/', ' ', $fullName);

        $sanitized = preg_replace('/[^A-Za-z0-9\ ]/', '', $removedMultispace);

        $lowercased = strtolower($sanitized);

        $splitted = explode(" ", $lowercased);

        if (count($splitted) == 1) {
            $username = substr($splitted[0], 0, rand(3, 6)) . rand(111111, 999999);
        } else {
            $username = $splitted[0] . substr($splitted[1], 0, rand(0, 4)) . rand(11111, 99999);
        }

        return $username;

        #$username = generateUsername("Elon Musk");
        #echo $username;
    } // end function
} // endif

if (!function_exists('f_genUName')) {
    function f_genUName($fullname){
        $aName = explode(' ', f_lower($fullname));
        return $aName[0].'.'.end($aName);
    } // end function
} // endif


if (!function_exists('f_Exist_DIR')) {
    
    function f_Exist_DIR($path){
        $all = @scandir($path);
        $result = ($all !== false) ? true : false;
        // echo 'f_Exist_DIR->'.$result;
        return $result;
    } // end function

} // endif


if (!function_exists('f_Permission_DIR')) {

    function f_Permission_DIR($path)
    {
       @chmod($path, 0777);
       
        // echo 'f_Permission_DIR->777 OK!';

    } // end function

} // endif



if (!function_exists('f_Create_DIR')) {
    
    function f_Create_DIR($dir)
    {
        try{
            if (!mkdir($dir, 0777, true)) {
                throw new Exception("Error creating the directory.");
            }
            echo $dir.' created!';
        } catch (Exception $ex) {
            echo "An error occurred: " . $ex->getMessage();
            return false;
        } // end try catch
    } // end function
    
} // endif



if (!function_exists('f_getDayOfWeek')) {
    function f_getDayOfWeek($date) {
        // Converte a string da data para um timestamp
        $timestamp = strtotime($date);
    
        // Obtém o dia da semana a partir do timestamp (0 = Domingo, 1 = Segunda, etc.)
        $dayOfWeekNumber = date('w', $timestamp);
    
        // Array com os nomes dos dias da semana
        $daysOfWeek = [
            'Domingo / Sunday',
            'Segunda-feira / Monday',
            'Terça-feira / Tuesday',
            'Quarta-feira / Wednesday',
            'Quinta-feira / Thursday',
            'Sexta-feira / Friday',
            'Sábado / Saturday',
        ];
    
        // Retorna o nome do dia da semana correspondente
        return $daysOfWeek[$dayOfWeekNumber];
    }
    
    // Exemplo de uso
    //$date = "2024-08-26";
    //echo getDayOfWeek($date); // Retorna "Segunda-feira"
} // endif

#echo '<!-- Functions Loaded ! -->'.chr(10);




