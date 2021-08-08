<?php

namespace App\model;

    class Produto{

        private $id, $nome, $descricao, $categoria, $imagem, $link, $avaliacao;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id= $id;
        }

        public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }
        
        public function getDescricao(){
            return $this->descricao;
        }
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        
        public function getCategoria(){
            return $this->categoria;
        }
        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        public function getImagem(){
            return $this->imagem;
        }
        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

        public function getLink(){
            return $this->link;
        }
        public function setLink($link){
            $this->link = $link;
        }

        public function getAvaliacao(){
            return $this->avaliacao;
        }
        public function setAvaliacao($avaliacao){
            $this->avaliacao = $avaliacao;
        }


    }