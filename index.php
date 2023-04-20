 <!DOCTYPE html>
 <html lang="en">
 <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

 </head>

 <style>

body{
	background: black;
}


form{
		width: 1020px;
  		margin: auto;
  		background-color: #0b0a0a;
 		border-radius: 4px;
  		box-sizing: border-box;
  		height: 464px;
  		padding: 15px;
		color: white;
}

.title {
    font-family: 'open_sansregular';
    font-size: 2em;
    color: #dfb127;
    margin-bottom: 30px;
    border-bottom: 1px #202020 solid;
    padding-bottom: 10px;
}

.form-group{
		width: 100%;
 		height: 50px;
 		position: relative;
  		margin-top: 20px;
}

	
.form-control{
			width: 100%;
			background-color: #131313;
			border-radius: 8px;
			border: 0;
			box-sizing: border-box;
			color: #eee;
			font-size: 18px;
			font-family: 'open_sansregular';
			height: 100%;
			outline: 0;
			padding: 4px 20px 0;
			
}



label{
	color: gray;
  font-family: 'open_sansregular';
  left: 15px;
  line-height: 14px;
  pointer-events: none;
  position: absolute;
  transform-origin: 0 50%;
  transition: transform 200ms, color 200ms;

}

input[type="file"]{
	position: relative;
	top: 40px;
}


button{
	position: relative;
	top: 60px;
	background-color: black; 
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

</style>



 <body>
	
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
	
		<div class="container-fluid">
			<div class="row">
			  <!-- left column -->
			  <div class="col-md-6">
				<!-- general form elements -->
				<div class="card card-primary">
				  <div class="card-header">
					
				  </div>
				  <!-- /.card-header -->
				  <!-- form start -->
				  
				  <form id="ajaxform" action="gravar_produto.php" method="post">
				  <div class="title icon icon-forward-1"> Cadastro Do Produtos</div>
					<div class="card-body">
					<div class="form-group">
						<label for="nome">Nome do Produto</label>
						<input type="text" name="nome" class="form-control" id="nome" >
					  </div>
					  <div class="form-group">
						<label for="descricao">Descrição do Produto</label>
						<input type="text" name="descricao" class="form-control" id="descricao" >
					  </div>
					  <div class="form-group">
						<label for="valor">Valor (R$ 0,00)</label>
						<input type="text" name="valor" class="form-control" id="valor"  data-inputmask="'mask': '[9][9][9][9][9][9]9,[99]'" data-mask>
					  </div>
					  <div class="form-group">
						<label for="arquivo">Imagem do Produto</label>
						<input type="file" name="arquivo" class="form-control" id="arquivo">
					  </div>
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
					  <button type="submit" class="btn btn-primary">Cadastrar</button>
					</div>
				  </form>
				  
				 <div id="loading" class="overlay" style="visibility: hidden">
				  <i class="fa fa-refresh fa-spin"></i>
				 </div>
				 
				 <div id="simple-msg"></div>
				  
				</div>
				<!-- /.card -->	
				
			</div>
			
		  </div>
		 			
		</div>
	
    </section>
    <!-- /.content -->
  </div>

	
 </body>
 </html>
 
 
 <!-- Content Wrapper. Contains page content -->
  
  <!-- /.content-wrapper -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  
  <script type="text/javascript">
  $(function () { 
	  
	$("#ajaxform").submit(function(e)
	{
		$("#loading").css("visibility", "visible");

		//forma especial de envio de dados por upload de arquivo
		var formData = new FormData(this);
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : formData,
			success:function(data, textStatus, jqXHR) 
			{				
				$("#loading").css("visibility", "hidden");
				$("#simple-msg").html(data);
				window.location.replace("lista_produtos.php");
			},
			cache: false,
			contentType:false,
			processData:false,
			xhr: function()
			{
				var myXhr = $.ajaxSettings.xhr();
				//verifica se a propriedade de upload está ativa
				if (myXhr.upload){
					//define o que aparecerá quando o envio estiver sendo realizado
					myXhr.upload.addEventListener('progress', function(){
						$("#loading").css("visibility", "visible");
					}, false);
					
					$("#loading").css("visibility", "hidden");
				}
				return myXhr;
			},			
			error: function(jqXHR, textStatus, errorThrown) 
			{
				$("#loading").css("visibility", "hidden");
				
				var error = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> '+textStatus+'</h4>'+errorThrown+'</div>';
				$("#simple-msg").html(error);
			}
		});
	
		e.preventDefault();	//STOP default action
		e.unbind();
	});
  
  });

  </script>
