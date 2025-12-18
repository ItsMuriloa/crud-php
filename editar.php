<?php 
#Crio uma ponte entre meu processa.php, para a verificação do criamento do usuario e exibição da mensagem
session_start();
#Adicona a conexão com o php
include_once("conexao.php");
#Recebe o ID e Buscar o cadastro pelo id no banco de dados
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$sql_usuario = "SELECT * FROM Usuarios WHERE id = '$id' ";
$resultados_usr = mysqli_query($conn, $sql_usuario);
$row_usr = mysqli_fetch_assoc($resultados_usr);
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Editar</title>
</head>
<body>
    <!-- Links -->
    <a href="criar.php">Cadastrar</a><br>
	<a href="index.php">Listar</a><br>
    <h1>Editar Cadastro</h1>
    <?php  
    # Mensagem que informa se o cadastro deu certo ou errado (Vem da SESSION) 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    };
    ?>
    <!-- Formulario para envio de dados -->
    <form action="processa_editar.php" method="post">
        
        <!-- Campo Oculto pelo type, coleta o ID do usuario  -->
        <input type="hidden" name="id" value="<?php echo $row_usr['id']; ?>">

        <!-- Campo01 (value = mostra o valor o cadastro escolhido, $row_urs[coluna]) -->
        <label for="idnome">Nome: </label>
        <input type="text" name="nome" id="idnome" placeholder="Digite o seu nome: " value="<?php echo $row_usr['nome']; ?>"><br><br>

        <!-- Campo02 (value = mostra o valor o cadastro escolhido, $row_urs[coluna]) -->
        <label for="idemail">Email: </label>
        <input type="email" name="email" id="idemail" placeholder="Digite o seu melhor email: " value="<?php echo $row_usr['email']; ?>"><br><br>


        <!-- Botão de Envio -->
        <input type="submit" value="Editar">
    </form>
    
</body>
</html>