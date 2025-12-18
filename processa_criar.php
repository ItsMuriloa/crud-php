<?php 
#Inicia sessão
session_start();

#Importa o arquivo de conexão e cria a variavel $conn
include_once("conexão.php");

#Receber os dados do Form (HTML)
$nome = filter_input(INPUT_POST,"nome", FILTER_UNSAFE_RAW);
$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);

#Cria o usuario com os dados coletados do form e envia para o banco de dados
$cria_usuario = "INSERT INTO Usuarios (nome, email, criado) VALUES ('$nome', '$email', NOW())";
$envia_usuario = mysqli_query($conn, $cria_usuario);

#Verifica se o usuario foi criado
if(mysqli_insert_id($conn)){
    $_SESSION['msg'] = "<p style='color:green;'>Usuario cadastrado com sucesso</p>";
    header("Location: index.php");

#Verifica se o usuario não foi criado
}else{
    $_SESSION['msg'] = "<p style='color:red;'>Usuario não cadastrado com sucesso</p>";
    header("Location: index.php");
}

?>