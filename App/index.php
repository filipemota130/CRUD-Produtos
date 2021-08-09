<?php

require_once '../vendor/autoload.php';

session_start();

$produtoDAO= new App\model\produtoDAO();
$produtoDAO->read();


if(isset($_SESSION['mensagem'])){ ?>
<script>
  window.onload = function(){
    <?php if ($_SESSION['mensagem']=='Produto cadastrado com sucesso!' or $_SESSION['mensagem']=='Produto atualizado com sucesso!' or $_SESSION['mensagem']=='Produto deletado com sucesso!'){ ?>
    Swal.fire({
        icon: 'success',
        title: '<?php echo $_SESSION['mensagem']; ?>',
    })
    <?php }else{ ?>
        Swal.fire({
        icon: 'error',
        title: '<?php echo $_SESSION['mensagem']; ?>',
    })
    <?php 
    }
    ?>
} 
</script>
<?php
}
session_unset();
include_once 'header.php';
include_once './model/conexao.php';
?>

<div class='container pt-5 div-prin'>
    <table class='table'>
        <thead>
            <tr>
                <th>

                </th>
                <th>
                    Nome do produto
                </th>
                <th class='encurt'>
                    Avaliação
                </th>
                <th class='encurt'>
                    Categoria
                </th>
                <th class='ps-5 alinha'>
                    Detalhes
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($produtoDAO->read() != []){
                foreach($produtoDAO->read() as $produto){
            ?>  
                <th>
                <img src="upload/<?php echo $produto['imagem']; ?>" class='rounded image-out' style='width:70px; height: 70px;'>
                </th>
                <th class='pt-4'>
                <?php echo $produto['nome']; ?>
                </th>
                <th class='pt-4 encurt'>
                <?php echo $produto['avaliacao']; ?>/10
                </th >
                <th class='pt-4 encurt'>
                <?php echo $produto['categoria']; ?>
                </th>
                <th class='d-flex justify-content-center py-4 ajust'>
                    <a href="detalhes.php?id=<?php echo $produto['id']; ?>" class='px-2'><button class='d-flex btn btn-light justify-content-center' style='width: 40px'><img src='../assets/lupa.png'></button></a>
                    <a href="editar.php?id=<?php echo $produto['id']; ?>" class='px-2'><button class='d-flex btn btn-warning justify-content-center' style='width: 40px'><img src='../assets/pencil.svg'></button></a>
                    <button type='button' class='d-flex btn btn-danger justify-content-center' data-bs-toggle="modal" data-bs-target="#modal<?php echo $produto['id']; ?>a" ><img src='../assets/trash.svg'></button>
                    <div class="modal fade" id="modal<?php echo $produto['id'];?>a" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <img class='px-2' src='../assets/stop.svg'>
                            <h5 class="modal-title" id="exampleModalLabel">Excluir produto: <?php echo $produto['nome']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza disso?
                        </div>
                        <div class="modal-footer">
                            <form action='model/produtoDAO.php?' method='POST' enctype="multipart/form-data">
                                <input type='hidden' name='id' value='<?php echo $produto['id'];?>'>
                                <input type='hidden' name='imagem' value='<?php echo $produto['imagem'];?>'>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name='btn-excluir'class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </th>
            </tr>
            <?php
                }
            }
            else{
            ?>
                <th>
                -
                </th>
                <th class='encurt'>
                -
                </th>
                <th class='encurt'>
                -
                </th>
                <th>
                -
                </th>
                <th>
                -
                </th>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a class='btn btn-primary' href='cadastro.php'>+ Novo produto</a>
</div>
<style>
    @media screen and (max-width: 800px){
        .encurt{
            opacity:0;
            visibility: hidden;
            display:none;
        }
        .alinha{
            padding-left:0 !important;
        }
    }
    @media screen and (max-width:391px){
        .ajust{
            padding-bottom: 50px !important;   
        }
        .image-out{
            opacity:0 !important;
            visibility: hidden !important;
            display:none !important;
        }
    }
</style>
<?php
    include_once 'footer.php';
?>