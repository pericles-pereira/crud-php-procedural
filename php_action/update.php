<?php
// Sessão
session_start();
// Conexão
require_once 'db_connect.php';
// Clear
function clear($input){
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// XSS (Cross Site Scripting - ataque hacker que insere scripts no script do seu site)
	$var = htmlspecialchars($var);
	return $var;
}

if (isset($_POST['btn-editar'])):
$nome = clear($_POST['nome']);
$sobrenome =  clear($_POST['sobrenome']);
$email = clear($_POST['email']);
$idade = clear($_POST['idade']);

$id = mysqli_escape_string($connect, $_POST['id']);

	if(!empty($_POST['nome']) and !empty($_POST['sobrenome']) and !empty($_POST['email']) and !empty($_POST['idade'])):

$sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', idade = '$idade' WHERE id = '$id'";

if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: ../index.php');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: ../index.php');
	endif;

	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: ../index.php');
endif;

endif;