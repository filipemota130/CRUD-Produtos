<?php

namespace App\Model;

    class conexao{

        private static $instance;

        public static function getConexao(){
            
            if (!isset(self::$instance)){
                self::$instance = new \PDO('mysql:host=localhost;dbname=plataforma_y;charset=utf8','root','');
            }
            return self::$instance;
        }
    };