<?php

require_once '../vendor/autoload.php';
include_once 'header.php';

$consulta= new App\model\produtoDAO();

if(isset($_GET['id'])){
    $consulta->readOne($_GET['id']);
}

?>
<?php
    foreach($consulta->readOne($_GET['id']) as $produto){
?>
<div class='d-flex justify-content-center align-center p-4 div-prin'>
    <div class="card" style="width: 40rem;">
    <?php if($produto['imagem']){ ?>
        <img src="upload/<?php echo $produto['imagem']; ?>" class="card-img-top" style='max-height: 290px'  alt="...">
    <?php }else{ ?>
        <img src="../assets/image.jpg" class="card-img-top" style='max-height: 290px'  alt="imagem default">
    <?php }?>
    <div class="card-body bg-dark text-light">
        <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
        <p class="card-text"><?php echo $produto['descricao']; ?></p>
    </div>
    <ul class="list-group list-group-flush bg-dark text-light">
        <li class="list-group-item bg-dark text-light">Avaliação: <?php echo $produto['avaliacao']; ?>/10</li>
        <li class='list-group-item bg-dark text-light'><a href="<?php echo $produto['link']; ?>" class="card-link">Link para a loja</a></li>
    </ul>
    <div class="card-body bg-dark text-light">
        <a href='index.php' class="btn btn-primary me-3">Voltar</a>
    </div>
        
    </div>
    </div>
</div>

<?php
    }
    include_once 'footer.php';
?>
