<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Controle Financeiro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <script>
        function obterDadosModal(valor) {
            var retorno = valor.split("*");
            document.getElementById('cod').value    = retorno[0];
            document.getElementById('nome').value   = retorno[1];
            document.getElementById('vendas').value = retorno[2];
            /* adicionar mais */
        }
    </script>
    <div class="container">
        <div class="row">
            <h2>Controle Financeiro:</h2><br><!-- 
            <form action="financeiro.php" method="POST">
                <input type="text" name="funcionome" id="funcionome" placeholder="Nome Funcionário" class="span4" style="margin-bottom: -2px; height: 25px;" required>
                <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
            </form> -->
            <form action="financeiro.php" method="POST">
                <input type="text" name="funcionome" id="funcionome" placeholder="Nome Funcionário" class="span4" style="margin-bottom: -2px; height: 25px;" required>
                <input type="text" name="clientnome" id="clientnome" placeholder="Nome Cliente" class="span4" style="margin-bottom: -2px; height: 25px;" required>
                <br><br>
                Data Início <input type="date" name="datainicio" id="datainicio" style="margin-bottom: -2px; height: 25px;" required>
                Data Final <input type="date" name="datafinal" id="datafinal" style="margin-bottom: -2px; height: 25px;" required>
                <br><br>
                <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Data Pedido</b></td>
                    <td><b>Funcionário</b></td>
                    <td><b>Cliente</b></td>
                    <td><b>Total pedido R$</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar']))
                {
                    $funcionome   = strtoupper($_POST['funcionome']);
                    $clientnome   = strtoupper($_POST['clientnome']);
                    $datainicio   = $_POST['datainicio'];
                    $datafinal    = $_POST['datafinal'];
                    $consulta = "select pedidos.cod, pedidos.datapedido, funcionarios.nome as nomefunc, clientes.nome as nomecli, (pedidos.quantidade * pedidos.preco) as total
                                    from pedidos, funcionarios, clientes
                                    where UPPER(funcionarios.nome) like '%$funcionome%'
                                    and UPPER(clientes.nome) like '%$clientnome%'
                                    and '$datainicio' <= pedidos.datapedido
                                    and pedidos.datapedido <= '$datafinal'
                                    and pedidos.codfunc = funcionarios.cod
                                    and pedidos.codcli = clientes.cod
                                    order by pedidos.cod";        
                    $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select pedidos.cod, pedidos.datapedido, funcionarios.nome as nomefunc, clientes.nome as nomecli, (pedidos.quantidade * pedidos.preco) as total
                                    from pedidos, funcionarios, clientes
                                    where pedidos.codfunc = funcionarios.cod
                                    and pedidos.codcli = clientes.cod
                                    order by pedidos.cod";
                    $resultado = mysql_query($consulta);
                }

                $totalpedidos = 0;
                while ($dados = mysql_fetch_array($resultado))
                {
                    $valor = $dados['cod'] . "*" . $dados['datapedido'] . "*" . $dados['nomefunc'] . "*" . $dados['nomecli']. "*" . $dados['total'];
                    $totalpedidos = $totalpedidos + $dados['total'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['datapedido']; ?></td>
                        <td><?php echo $dados['nomefunc']; ?></td>
                        <td><?php echo $dados['nomecli']; ?></td>
                        <td><?php echo $dados['total']; ?></td>
                    </tr>
                <?php
                }
                mysql_close($conectar);
                $totalpedidos = number_format($totalpedidos,2,',','');
                ?>
                <tr>
                    <td class='tdvazia'></td>
                    <td class='tdvazia'></td>
                    <td class='tdvazia'></td>
                    <td class='tdvazia'></td>
                    <td><b>Total de vendas:</b> R$ <?php echo $totalpedidos; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>