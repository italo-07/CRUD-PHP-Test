<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crudteste') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nome = '';
$preco = '';
$descricao = '';
$imagem = '';

if (isset($_POST['save'])){

	$nome = $_POST['nome'];
	$preco = $_POST['preco'];
	$descricao = $_POST['descricao'];
	$imagem = $_POST['imagem'];

	$mysqli->query("INSERT INTO produtos (nome, preco, descricao, imagem) VALUES ('$nome', '$preco', '$descricao', '$imagem')") or die ($mysqli->error);

	$_SESSION['message'] = "Registro salvo com sucesso";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

if (isset($_GET['delete'])){
	$id = $_GET['delete'];

	$mysqli->query("DELETE FROM produtos WHERE id=$id") or die ($mysqli->error);

	$_SESSION['message'] = "Registro deletado com sucesso";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

if (isset($_GET['edit'])){
	$id = $_GET['edit'];

	$result = $mysqli->query("SELECT * FROM produtos WHERE id=$id") or die ($mysqli->error);

	$update = true;
	if(count($result)==1){
		$row = $result->fetch_array();
		$nome = $row['nome'];
		$preco = $row['preco'];
		$descricao = $row['descricao'];
		$imagem = $row['imagem'];
	}
}

if (isset($_POST['update'])){

	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$preco = $_POST['preco'];
	$descricao = $_POST['descricao'];
	$imagem = $_POST['imagem'];

	$mysqli->query("UPDATE produtos SET nome='$nome', preco='$preco', descricao='$descricao', imagem='$imagem' WHERE id=$id") or die ($mysqli->error);

	$_SESSION['message'] = "Registro atualizado com sucesso";
	$_SESSION['msg_type'] = "warning";

	header("location: index.php");
}