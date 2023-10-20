<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Menu Inicial</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div id='container'>
        <header>
            <h1>Sistema de Vendas</h1>
        </header>
        <div id='colunas'>
            <div id="cadastros">
                <h4 class='column-title'>Cadastros</h4>
                <a href="./funcionarios.php">
                    <div id="funcs" class='quadrado'>

                            <img src="./assets/img/funcionario.png" alt="Imagem de Icone de Funcionario" class='image-icon'>
                            <p class='legenda'>Funcionarios</p>

                    </div>
                </a>
                <a href="./clientes.php">
                <div id="client" class='quadrado'>
                        <img src="./assets/img/cliente.png" alt="Imagem de Icone de Cliente" class='image-icon'>
                        <p id='legenda'>Clientes</p>
                </div>
                <a href="./produtos.php">
                <div id="produ" class='quadrado'>
                        <img src="./assets/img/produto.png" alt="Imagem de Icone de Funcionario" class='image-icon'>
                        <p class='legenda'>Produtos</p>
                </div>
            </div>
            <div id="movimentacao">
                <h4 class='column-title'>Movimentação</h4>
                <a href="./pedidos.php">
                <div id="pedido" class='quadrado'>
                        <img src="./assets/img/pedido.png" alt="Imagem de Icone de Pedido" class='image-icon'>
                        <p class='legenda'>Pedidos</p>
                </div>
                <a href="./estoque.php">
                <div id="estoque" class='quadrado'>
                        <img src="./assets/img/estoque.png" alt="Imagem de Icone de Estoque" class='image-icon'>
                        <p class='legenda'>Estoque</p>
                </div>
            </div>
            <div id="financeiro">
                <h4 class='column-title'>Financeiro</h4>
                <a href="./financeiro.php">
                <div id="faturamento" class='quadrado'>
                        <img src="./assets/img/faturamento.png" alt="Imagem de Icone de Faturamento" class='image-icon'>
                        <p class='legenda'>Faturamento</p>
                </div>
                <a href="./comissao.php">
                <div id="comissao-vendas" class='quadrado'>
                        <img src="./assets/img/comissao.png" alt="Imagem de Icone de Comissao Vendas" class='image-icon'>
                        <p class='legenda'>Comissão Vendas</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>