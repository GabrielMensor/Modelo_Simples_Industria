<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Controle de Comissão</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <script>
        function obterDadosModal(valor) {
            var retorno = valor.split("*");
            document.getElementById('cod').value      = retorno[0];
            document.getElementById('nome').value     = retorno[1];
            document.getElementById('vendas').value   = retorno[2];
            document.getElementById('comissao').value = retorno[2];
        }
    </script>
    <div class="container">
        <div class="row">
            <h2>Controle comissão dos funcionários:</h2><br>
            <form action="comissao.php" method="POST">
                <input type="text" name="nome" id="nome" placeholder="Nome Funcionário" class="span4" style="margin-bottom: -2px; height: 25px;">
                <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod Funcionário</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Total de Vendas</b></td>
                    <td><b>Comissão de 10%</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar'])) {
                    $nome   = strtoupper($_POST['nome']);
                    $consulta = "select funcionarios.cod, funcionarios.nome, sum(pedidos.preco*pedidos.quantidade) as vendas, sum(pedidos.preco*pedidos.quantidade)*0.1 as comissao
                                    from funcionarios, pedidos
                                    where UPPER(funcionarios.nome) like '%$nome%'
                                    and pedidos.codfunc = funcionarios.cod";        
                    $resultado = mysql_query($consulta);
                }
                else {
                    $consulta = "select funcionarios.cod, funcionarios.nome, sum(pedidos.preco*pedidos.quantidade) as vendas, sum(pedidos.preco*pedidos.quantidade)*0.1 as comissao
                                    from funcionarios, pedidos
                                    where pedidos.codfunc = funcionarios.cod
                                    group by funcionarios.nome
                                    order by cod";
                    $resultado = mysql_query($consulta);
                }

                $totalfinal = 0;
                $totalcomissao = 0;
                while ($dados = mysql_fetch_array($resultado)) {
                    $valor = $dados['cod'] . "*" . $dados['nome'] . "*" . $dados['vendas'] . "*" . $dados['comissao'];
                    $totalfinal = $totalfinal + $dados['vendas'];
                    $totalcomissao = $totalcomissao + $dados['comissao'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['vendas']; ?></td>
                        <td><?php echo $dados['comissao']; ?></td>
                    </tr>
                <?php
                }
                mysql_close($conectar);
                $totalfinal = number_format($totalfinal,2,',','');
                $totalcomissao = number_format($totalcomissao,2,',','');
                ?>
                <tr>
                    <td class='tdvazia'></td>
                    <td class='tdvazia'></td>
                    <td><b>Total de vendas:</b> R$ <?php echo $totalfinal; ?></td>
                    <td><b>Total da comissão:</b> R$ <?php echo $totalcomissao; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>