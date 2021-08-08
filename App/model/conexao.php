<?php

namespace App\model;

    class conexao{

        private static $instance;
        

        public static function getConexao(){
            $username='root';
            $pass='';
            
            if (!isset(self::$instance)){
        self::$instance = new \PDO('mysql:host=localhost;dbname=crud_produtos;charset=utf8',$username,$pass);
            }
            return self::$instance;
        }
    };