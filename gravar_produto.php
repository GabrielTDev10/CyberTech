<?php

require_once("conexao.php");

$nome = $_POST['nome'];

$descricao = $_POST['descricao'];

$valor = $_POST['valor'];

if (!empty($_FILES["arquivo"]['name']))
    {
        $fileName     =  $_FILES["arquivo"]['name'];
        $fileTmp      =  $_FILES["arquivo"]['tmp_name'];
        $fileType     =  $_FILES["arquivo"]['type'];
        $fileSize     =  $_FILES["arquivo"]['size'];
        $fileExt      =  substr($fileName, -4, 5);
        $fileExt      =  str_replace(".", "", $fileExt);
        $extFile      =  $fileExt;
        $fileExt      =  ".".$fileExt;
        $maxSize      =  "800000";
        $hash       =  date("sm");


        $nomeSemExt   = preg_replace('/\.[^.]*$/', '', $fileName);
		$fileNamex = md5(date("Y-m-d H:i:s") . $nomeSemExt);

        $local        =  "uploads/";
        $novoNome     =  $fileNamex."".$fileExt;


        $arqEX = "uploads/$novoNome";

        if(file_exists($arqEX)) 
        {
            $novoNome     =  $fileNamex."_$hash".$fileExt;
        } 

		move_uploaded_file( $fileTmp, $local . $novoNome);
		$local = substr($local, 3, 120);
		$tipo = $fileExt; 

	}

$consulta = $conexao->prepare("INSERT INTO produto(nome,descricao, valor, url_arquivo) VALUES (?,?, ?, ?)");

$consulta->bind_param("ssds", $nome, $descricao, $valor, $arqEX);

$consulta->execute();

?>

<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5><i class="icon fas fa-check"></i> Atenção!</h5>
	Cadastro realizado com sucesso.
</div>