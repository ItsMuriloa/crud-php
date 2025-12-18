<?php 
#Crio uma ponte entre meu processa.php, para a verificação do criamento do usuario e exibição da mensagem
session_start();
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Crud - Listar</title>
</head>
<body>
    <!-- Paginas -->
    <a href="criar.php">Cadastrar</a><br>
	<a href="index.php">Listar</a><br>
    <h1>Listar Cadastros</h1>


    <?php 
    # Mensagem que informa se o cadastro deu certo ou errado (Vem da SESSION) 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    };
    #Configurando Paginação:
    #Receber o numero da pagina
    $pagina_atual = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    #Numero de itens por pagina
    $qtd_itens = 3;
    #Calcular o Inicio vizual
    $inicio = ($qtd_itens * $pagina) - $qtd_itens;
    

    #BD cadastrados
    $sql_cadastros = "SELECT * FROM Usuarios LIMIT $inicio, $qtd_itens";
    #Buscar dados
    $resultado_usuarios = mysqli_query($conn, $sql_cadastros);
    #Imprimir resutltado, <br> separar linhas, <hr> colocar linha para separar
    while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
        echo "ID: " . $row_usuario ['id'] . "<br>";
        echo "Nome: " . $row_usuario ['nome'] . "<br>";
        echo "Email: " . $row_usuario ['email'] . "<br>";
        echo "Criado: " . $row_usuario ['criado'] . "<br>";
        echo "<a href='editar.php?id=" . $row_usuario['id'] . "'>Editar</a><br>";
        echo "<a href='processa_deletar.php?id=" . $row_usuario['id'] . "'>Apagar</a><br><hr>";
    };


    #Paginação:
    #Selecionar Pagina: Busca no bando, retorno resultado, le o resultado
    $sql_pg = "SELECT COUNT(id) AS num_result FROM Usuarios";
    $resultados_pg = mysqli_query($conn, $sql_pg);
    $row_pg = mysqli_fetch_assoc($resultados_pg);

    #Quantidade de pagina
    $qtd_paginas = ceil($row_pg['num_result'] / $qtd_itens);
    #Limitar Antes e Depois
    $max_links = 2;
    #Imprimindo Paginas
    echo "<a href='index.php?pagina=1'>Primeira</a> ";	
    
    #Outas Inicio
	for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a href='index.php?pagina=$pag_ant'>$pag_ant</a> ";
			}
		}

	#Pagina atual
	echo "$pagina ";
    
    #Outras final
	for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $qtd_paginas){
				echo "<a href='index.php?pagina=$pag_dep'>$pag_dep</a> ";
			}
		}
		
    #Pagina Final
	echo "<a href='index.php?pagina=$qtd_paginas'>Ultima</a>";
		
    ?>
    
    </form>
    
</body>
</html>