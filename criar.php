<?php 
#Crio uma ponte entre meu processa.php, para a verificação do criamento do usuario e exibição da mensagem
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Criar</title>
</head>
<body>
    <a href="criar.php">Cadastrar</a><br>
	<a href="index.php">Listar</a><br>
    <h1>Criar Cadastro</h1>
    <?php  
    # Mensagem que informa se o cadastro deu certo ou errado (Vem da SESSION) 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    };
    ?>
    <!-- Formulario para envio de dados -->
    <form action="processa_criar.php" method="post">
        <!-- Campo01 -->
        <label for="idnome">Nome: </label>
        <input type="text" name="nome" id="idnome" placeholder="Digite o seu nome">
        <br>
        <!-- Campo02 -->
        <label for="idemail">Email: </label>
        <input type="email" name="email" id="idemail" placeholder="Digite o seu melhor email">
        <br>
        <!-- Botão de Envio -->
        <input type="submit" value="Cadastrar">
    </form>
    
</body>
</html>