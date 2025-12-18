<?php 
#Inicia sessão
session_start();

#Importa o arquivo de conexão e cria a variavel $conn
include_once("conexao.php");

#Receber os dados do Form (HTML)
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST,"nome", FILTER_UNSAFE_RAW);
$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);

#Cria o usuario com os dados coletados do form e envia para o banco de dados
$editar_usuario = "UPDATE usuarios SET nome='$nome', email='$email', modificado= NOW() WHERE id='$id'";
$envia_usuario = mysqli_query($conn, $editar_usuario);

#Verifica se o usuario foi criado
if(mysqli_affected_rows($conn)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuário editado com sucesso</p>";
	header("Location: index.php");

#Verifica se o usuario não foi criado
}else{
    $_SESSION['msg'] = "<p style='color:red;'>Usuario não editado com sucesso</p>";
    header("Location: index.php");
}

?>