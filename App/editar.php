<?php

require_once '../vendor/autoload.php';
include_once 'header.php';

$consulta= new \App\Model\ProdutoDAO();

if(isset($_GET['id'])){
    $consulta->readOne($_GET['id']);
}

?>
<div class='container p-5'>
<text class='d-flex justify-content-center h3 pb-5'>Editar Produto</text>
<form action='model/produtoDAO.php' method='POST' enctype="multipart/form-data">
  <?php foreach($consulta->readOne($_GET['id']) as $produto){ ?>
  <input type='hidden' name='id' value='<?php echo $produto['id']; ?>'>
  <label for="formFile" class="form-label">Imagem do produto:</label>
  <?php if(!$produto['imagem']){ ?> 
  <div class="mb-3">
    <input class="form-control" type="file" name='imagem' id="formFile" required>
  </div>
  <?php }else{ ?>
    <div class="mb-3">
      <img src="upload/<?php echo $produto['imagem']; ?>" class="card-img-top rounded" style='max-width: 290px;max-height: 290px'  alt="...">
      <br>
      <input class="form-control mt-3" type="file" name='imagem' id="formFile">
    </div>
    
  <?php }?>
  <div class="form-group col">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome do produto:</label>
    <div class="col-sm-10">
      <input type="name" class="form-control" name='nome' id="inputNome" placeholder="Nome" value="<?php echo $produto['nome']; ?>">
    </div>
  </div>
  <div class="form-group col pt-3">
  <label class="col-sm-2 col-form-label">* Nota de avaliação:</label>
  <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <select class='form-select form-select-md' name='avaliacao' id='aaaa' required>
    </select>
  </div>
  </div>
 <div class="form-group pt-3">
    <label for="exampleFormControlSelect1" class='pb-2'>* Categoria:</label>
    <select class="form-select" name='categoria' id="select" required>
    </select>
  </div>
  <div class="form-group pt-3">
    <label for="exampleFormControlSelect1" class='pb-2'>Link de acesso a loja:</label>
    <input type="link" class="form-control" name='link' id="inputNome" value='<?php echo $produto['link']; ?>'>
  </div>
  <div class="form-group pt-3">
    <label for="exampleFormControlTextarea1" class='pb-2'>Descrição:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="descricao" rows="3" placeholder='Descreva aqui'><?php echo $produto['descricao']; ?></textarea>
  </div>
  <input type='hidden' name='antiga-imagem' value='<?php echo $produto['imagem'];?>'>
  <?php } ?>
<div class='d-flex justify-content-end pt-3'>
  <div class="form-group row pr-3">
    <div class="col-sm-10 px-4">
      <button type="submit" name='btn-editar' class="btn btn-primary d-flex"><img src="../assets/diskette.png" style='padding-top:3px ;padding-right: 10px'>Atualizar</button>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <a href='index.php' class="btn btn-success">Lista de produtos</a>
    </div>
  </div>
</div>
  
</form>
</div>
<script>
  var elements=''
  var num = [1,2,3,4,5,6,7,8,9,10]
  var categorias = ['Computadores e Eletrônicos','Alimento','Eletrodomestico','Brinquedo','Roupa','Instrumento']
  var i
  for(i=0; i < categorias.length; i++){
    elements += "<option name='"+ categorias[i] +"' value='"+ categorias[i] + "'> " + categorias[i] + "</option>";
  }
  document.getElementById("select").innerHTML = elements;

  elements=''
  for(i=0; i < num.length; i++){
    elements += "<option value='"+ num[i] +"'> " + num[i] + "</option>";
  }
  document.getElementById("aaaa").innerHTML = elements;


</script>
<?php
include_once 'footer.php';
?>
