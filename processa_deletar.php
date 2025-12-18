<?php
#Inicia sessão
session_start();

#Adicionar arquivo conexão
include_once("conexao.php");

#Coletar o ID pela URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

#Se ID existir
if(!empty($id)){

    #Busca pelo id na base e deleta
	$sql_delete = "DELETE FROM usuarios WHERE id='$id'";
	$resultado_delete = mysqli_query($conn, $sql_delete);
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "<p style='color:green;'>Usuário apagado com sucesso</p>";
		header("Location: index.php");
	}else{
		
		$_SESSION['msg'] = "<p style='color:red;'>Erro o usuário não foi apagado com sucesso</p>";
		header("Location: index.php");
	}

#Se ID não existir
}else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um usuário</p>";
	header("Location: index.php");
}
