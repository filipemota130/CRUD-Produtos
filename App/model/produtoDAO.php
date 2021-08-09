<?php

namespace App\Model;
require_once 'produto.php';
require_once 'conexao.php';

global $i;
    class produtoDAO{
        public function create(Produto $produto){
            session_start();
            try{
                $sql="INSERT INTO produtos (nome, descricao, categoria, imagem, link, avaliacao) VALUES (?,?,?,?,?,?)";

            $stmt=Conexao::getConexao()->prepare($sql);

            $stmt->bindValue(1,$produto->getNome());
            $stmt->bindValue(2, $produto->getDescricao());
            $stmt->bindValue(3, $produto->getCategoria());
            $stmt->bindValue(4, $produto->getImagem());
            $stmt->bindValue(5, $produto->getLink());
            $stmt->bindValue(6, $produto->getAvaliacao());

            $stmt->execute();
            $_SESSION['mensagem'] = 'Produto cadastrado com sucesso!';
            header('Location: ../index.php');
            }
            catch (\PDOException $e){
               echo 'Algo deu errado'.$e;
               $_SESSION['mensagem'] = 'Erro ao cadastrar o produto';
                header('Location: ../index.php');   
            }
        
        }
        public function read(){

            $sql="SELECT * FROM produtos";

            $stmt=Conexao::getConexao()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $query= $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $query;
            }else{
                return [];
            }

        }
        
        public function readOne($id){
            $sql="SELECT * FROM produtos WHERE id='$id'";

            $stmt=Conexao::getConexao()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $query= $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $query;
            }else{
                return [];
            }

        }
        public function update(Produto $produto, $imagem){
            session_start();
            if($imagem!=''){
                unlink("../upload/".$imagem);
            }
            try{
                $sql = 'UPDATE produtos SET nome= ?, descricao= ?, categoria= ?, imagem=?, link=?, avaliacao=? WHERE id=?';
                $stmt=Conexao::getConexao()->prepare($sql);
                
                $stmt->bindValue(1,$produto->getNome());
                $stmt->bindValue(2, $produto->getDescricao());
                $stmt->bindValue(3, $produto->getCategoria());
                $stmt->bindValue(4, $produto->getImagem());
                $stmt->bindValue(5, $produto->getLink());
                $stmt->bindValue(6, $produto->getAvaliacao());
                $stmt->bindValue(7,$produto->getId());
                
                $stmt->execute();
                $_SESSION['mensagem'] = 'Produto atualizado com sucesso!';
                header('Location: ../index.php'); 
            }catch(\PDOException $e){
                echo $e;
                $_SESSION['mensagem'] = 'Erro ao atualizar o produto';
                header('Location: ../index.php'); 
            }
            
        }


        public function delete($id, $imagem){
            session_start();
            try{
                if($imagem!='image.jpg'){
                    unlink("../upload/".$imagem);
                }
                $sql = 'DELETE FROM produtos WHERE id=?';
                $stmt=Conexao::getConexao()->prepare($sql);
                $stmt->bindValue(1,$id);
                $stmt->execute();
                $_SESSION['mensagem'] = 'Produto deletado com sucesso!';
                header('Location: ../index.php'); 
            }catch(\PDOException $e){
                echo $e;
                $_SESSION['mensagem'] = 'Erro ao deletar o produto';
                header('Location: ../index.php'); 
            }
            

        }
        

    }
    $DAO= new ProdutoDAO();
    if(isset($_POST['btn-cadastro'])){
        if($_FILES['imagem']['size'] != 0){
            $extensao= strtolower(substr($_FILES['imagem']['name'],-4));
            if(($extensao!='.jpg') and ($extensao!='.png') and ($extensao!='.gif') and ($extensao!='.jpeg')){
                session_start();
                $_SESSION['mensagem'] = 'Formato de imagem inválido!';
                header("Location: ../cadastro.php");
                exit;
            }
            if($_FILES['imagem']['size'] > 1024*1024*100){
                session_start();
                $_SESSION['mensagem'] = 'Tamanho da imagem excedente!';
                header("Location: ../cadastro.php");
                exit;
            }
            $nomefinal= md5(time()).$extensao;
            $diretorio= '../upload/';
            move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$nomefinal);
        }
        
        else{
            $nomefinal= 'image.jpg';
        }
        $produto= new Produto();
        $produto->setNome(htmlspecialchars($_POST['nome']));
        $produto->setDescricao(htmlspecialchars($_POST['descricao']));
        $produto->setCategoria(htmlspecialchars($_POST['categoria']));
        $produto->setImagem(htmlspecialchars($nomefinal));
        $produto->setLink(htmlspecialchars($_POST['link']));
        $produto->setAvaliacao(htmlspecialchars($_POST['avaliacao']));
        $DAO->create($produto);
    };

    if(isset($_POST['btn-editar'])){
        
        $produto= new Produto();
        
        if($_FILES['imagem']['size'] != 0){
            $extensao= strtolower(substr($_FILES['imagem']['name'],-4));
            $id=$_POST['id'];
            if(($extensao!='.jpg') and ($extensao!='.png') and ($extensao!='.gif') and ($extensao!='.jpeg')){
                session_start();
                $_SESSION['mensagem'] = 'Formato de imagem inválido!';
                header("Location: ../editar.php?id=$id");
                exit;
            }
            if($_FILES['imagem']['size'] > 1024*1024*100){
                session_start();
                $_SESSION['mensagem'] = 'Tamanho da imagem excedente!';
                header("Location: ../editar.php?id=$id");
                exit;
            }
            $nomefinal= md5(time()).$extensao;
            $diretorio= '../upload/';

            move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$nomefinal);
            $produto->setImagem(htmlspecialchars($nomefinal));
            $produto->setId(htmlspecialchars($_POST['id']));
            $produto->setNome(htmlspecialchars($_POST['nome']));
            $produto->setDescricao(htmlspecialchars($_POST['descricao']));
            $produto->setCategoria(htmlspecialchars($_POST['categoria']));
            $produto->setLink(htmlspecialchars($_POST['link']));
            $produto->setAvaliacao(htmlspecialchars($_POST['avaliacao']));
            $DAO->update($produto, $_POST['antiga-imagem']);
        }
        else{
            $nomefinal= $_POST['antiga-imagem'];
            $produto->setImagem(htmlspecialchars($nomefinal));
            $produto->setId(htmlspecialchars($_POST['id']));
            $produto->setNome(htmlspecialchars($_POST['nome']));
            $produto->setDescricao(htmlspecialchars($_POST['descricao']));
            $produto->setCategoria(htmlspecialchars($_POST['categoria']));
            $produto->setLink(htmlspecialchars($_POST['link']));
            $produto->setAvaliacao(htmlspecialchars($_POST['avaliacao']));
            $DAO->update($produto, '');
        }
        
    };

    if(isset($_POST['btn-excluir'])){
        $DAO->delete($_POST['id'],$_POST['imagem']);
    };