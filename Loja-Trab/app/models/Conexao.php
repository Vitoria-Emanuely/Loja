
<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 09/11/2017
 * Time: 10:40
 */
header('Content-Type: text/html; charset=utf-8');


class Conexao {

    const HOST      = "localhost";
    const NOMEBANCO = "BD_2INFO3_17";
    const USUARIO   = "root";
    const SENHA     = "root";
    
    //!!!Substitua daqui para baixo
    public static $conexao = null;


    public static function getConexao(){
        
        try{
            if(self::$conexao == null){
                self::$conexao = new PDO("mysql:host=".self::HOST.";dbname=".self::NOMEBANCO, self::USUARIO, self::SENHA);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            
            return self::$conexao;
            
        }catch(Exception $e){
            die("Falhou a conexao ou ocorreu um erro banco: " . $e->getMessage()); 
        }

    }
}

//teste conexao
//$con = new Conexao();
//$con->getConexao();
