<?php

session_start();

if(isset($_SESSION['mensagem'])){ ?>
<script>
  window.onload = function(){
        <?php if ($_SESSION['mensagem']=='Formato de imagem inválido!' or $_SESSION['mensagem']=='Tamanho da imagem excedente!'){ ?>
        Swal.fire({
            icon: 'error',
            title: '<?php echo $_SESSION['mensagem']; ?>',
        })
        <?php }?>
    } 
</script>
<?php
}
session_unset();
include_once 'header.php';
?>
<div class='container p-5'>
<text class='d-flex justify-content-center h3 pb-3'>Cadastro de produto</text>
<form action='model/produtoDAO.php' method='POST' enctype="multipart/form-data">
  <div class="mb-3">
    <label for="formFile" class="form-label">Imagem do produto:</label>
    <input class="form-control" type="file" name='imagem' id="formFile">
    <text class="form-label">*tamanho maximo 5MB*</text>
  </div>
  <div class="form-group col pt-3">
    <label class="col-sm-2 col-form-label">Nome do item:</label>
    <div class="col-sm-10">
      <input type="name" class="form-control" name='nome' id="inputNome" placeholder="Nome">
    </div>
  </div>
  <div class="form-group col pt-3">
  <label class="col-sm-2 col-form-label">Nota de avaliação:</label>
  <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <select class='form-select form-select-md' name='avaliacao' id='rate'>
    </select>
  </div>
  </div>
  <div class="form-group pt-3">
    <label for="exampleFormControlSelect1" class='pb-2'>Categoria:</label>
    <select class="form-select" name='categoria' id="Select" >
    </select>
  </div>
  <div class="form-group pt-3">
    <label for="exampleFormControlSelect1" class='pb-2'>Link de acesso a loja:</label>
    <input type="name" class="form-control" name='link' id="inputNome" placeholder="https://loja.com">
  </div>
  <div class="form-group pt-3">
    <label for="exampleFormControlTextarea1" class='pb-2'>Descrição:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="descricao" rows="3" placeholder='Descreva o produto aqui'></textarea>
  </div>
<div class='d-flex justify-content-end pt-3'>
  <div class="form-group row">
    <div class="col-sm-12">
      <a href='index.php' class="btn btn-link" style='text-decoration: none !important;'>Lista de produtos</a>
    </div>
  </div>
  <div class="form-group row pr-3">
    <div class="col-sm-10 px-4">
      <button type="submit" name='btn-cadastro' class="btn btn-primary">Cadastrar</button>
    </div>
  </div>
  
</div>
</form>
</div>
<script>
  var elements=''
  var num = [1,2,3,4,5,6,7,8,9,10]
  var categorias = ['Computadores e Eletrônicos','Alimento','Eletrodoméstico','Brinquedo','Roupa','Instrumento']
  var i
  for(i= 0; i < categorias.length; i++){
    elements += "<option name='"+ categorias[i] +"' value='"+ categorias[i] + "'> " + categorias[i] + "</option>";
  }
  document.getElementById("Select").innerHTML = elements;
  elements=''
  for(i=0; i < num.length; i++){
    elements += "<option value='"+ num[i] + "'> " + num[i] + "</option>";
  }
  document.getElementById("rate").innerHTML = elements;
</script>
<?php
include_once 'footer.php';
?>
