<?php

define("APP", "mystic_river_concierge");
// define("THIS_HOST", strtolower($_SERVER['HTTP_HOST']));
define("THIS_HOST", getenv('CONTAINER_NAME'));

#echo "DB Switch HOST ".THIS_HOST . chr(10);


switch (THIS_HOST) {
    /*
    case "127.0.0.1":
        $connCfg['driver']      = 'mysql';
        $connCfg['host']        = 'localhost';
        $connCfg['port']        = '3306';
        $connCfg['db_name']     = 'alexan38_mysticinvest'; // pay attention to this
        $connCfg['username']    = 'alexan38_mysticinvest';
        $connCfg['password']    = 'mysticinvest@1a2b3c4d5e';
        break;
    */
    
    case 'mystic_river_concierge_ama-local': // SERVIDOR DOCKER LOCAL, CONTAINER DE DESENVOLVIMENTO
        $connCfg['driver']      = 'mysql';
        $connCfg['host']        = 'mysql01L'; // Nome do container MySQL como host
        $connCfg['port']        = '3306';           // Porta padrão do MySQL
        $connCfg['db_name']     = 'mystic-river-concierge-ama';  // Nome do banco de dados
        $connCfg['username']    = 'root';           // Usuário conforme configurado no container
        $connCfg['password']    = 'root_password';  // Senha conforme configurada no container
        # define("WEBHOST", "localhost:8010/");
        define("CONTAINER_NAME", THIS_HOST);
    break;

    case 'mystic_river_concierge_ama-dev': // SERVIDOR DOCKER DE DESENVOLVIMENTO
        $connCfg['driver']      = 'mysql';
        $connCfg['host']        = 'mysql01D';       // Nome do container MySQL como host
        $connCfg['port']        = '3306';           // Porta padrão do MySQL
        $connCfg['db_name']     = 'mystic-river-concierge-ama';  // Nome do banco de dados
        $connCfg['username']    = 'root';           // Usuário conforme configurado no container
        $connCfg['password']    = 'root_password';  // Senha conforme configurada no container
        # define("WEBHOST", "srvdockerlab:8010/");
        define("CONTAINER_NAME", THIS_HOST);
    break;

    case 'mystic_river_concierge_ama-qua': // SERVIDOR DOCKER DE QUALIDADE
        $connCfg['driver']      = 'mysql';
        $connCfg['host']        = 'mysql01Q';       // Nome do container MySQL como host
        $connCfg['port']        = '3306';           // Porta padrão do MySQL
        $connCfg['db_name']     = 'mystic-river-concierge-ama';  // Nome do banco de dados
        $connCfg['username']    = 'root';           // Usuário conforme configurado no container
        $connCfg['password']    = 'root_password';  // Senha conforme configurada no container
        # define("WEBHOST", "srvdockerlab:8010/");
        define("CONTAINER_NAME", THIS_HOST);
    break;
    
    case 'mystic_river_concierge_ama-prd': // SERVIDOR DOCKER DE QUALIDADE
        $connCfg['driver']      = 'mysql';
        $connCfg['host']        = 'mysql01P';       // Nome do container MySQL como host
        $connCfg['port']        = '3306';           // Porta padrão do MySQL
        $connCfg['db_name']     = 'mystic-river-concierge';  // Nome do banco de dados
        $connCfg['username']    = 'root';           // Usuário conforme configurado no container
        $connCfg['password']    = 'root_password';  // Senha conforme configurada no container
        # define("WEBHOST", "10.179.96.11:8010/");
        define("CONTAINER_NAME", THIS_HOST);
    break;

    default:
        $connCfg['driver']      = 'mysql';
        $connCfg['host']        = 'mysql01P';       // Nome do container MySQL como host
        $connCfg['port']        = '3306';           // Porta padrão do MySQL
        $connCfg['db_name']     = 'mystic-river-concierge';  // Nome do banco de dados
        $connCfg['username']    = 'root';           // Usuário conforme configurado no container
        $connCfg['password']    = 'root_password';  // Senha conforme configurada no container
        # define("WEBHOST", "srvdockerlab:8010/");
        define("CONTAINER_NAME", THIS_HOST);
        #echo '<!-- mystic_river_concierge_ama-local -->'.chr(10);
    break;

} // end switch
#echo '<!-- DB Switch Data '.chr(10);
#print_r($connCfg).'<br>';
