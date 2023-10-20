<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

$sql_func = "SELECT cod,nome FROM funcionarios";
$pesquisar_func = mysql_query($sql_func);

$sql_cli = "SELECT cod,nome FROM clientes";
$pesquisar_cli = mysql_query($sql_cli);

$res_produtos = "SELECT cod,nome FROM produtos";
$pesquisar_prod = mysql_query($res_produtos);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesquisa Pedidos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <script>
        function obterDadosModal(valor) {
            var retorno = valor.split("*");
            document.getElementById('cod').value        = retorno[0];
            document.getElementById('datapedido').value = retorno[1];
            document.getElementById('codfunc').value    = retorno[2];
            document.getElementById('codcli').value     = retorno[3];
            document.getElementById('codprod').value    = retorno[4];
            document.getElementById('quantidade').value = retorno[5];
            document.getElementById('preco').value      = retorno[6];
        }
    </script>
    
    <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Cadastrar um registro</h1>
                </div>
                <div class="modal-body">
                    <form class="form-group well" action="pedidos.php" method="POST">
                        <input type="text" name="cod" class="span3" value="" required placeholder="Cod" style=" margin-bottom: -2px; height: 25px;">
                        Data pedido<input type="date" name="datapedido" class="span3" value="" required style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <select name="codfunc" id="codfunc" style="width: 178px; height: 25px;">
                            <option value=0 selected="selected">Selecione funcionario</option>
                            <?php
                                $sql_func = "SELECT cod,nome FROM funcionarios";
                                $pesquisar_func = mysql_query($sql_func);
                                if(mysql_num_rows($pesquisar_func) == 0) {
                                    echo '<h1>Sua busca por funcionários NÃO RETORNOU resultados</h1>';
                                }
                                else {
                                while($resultado = mysql_fetch_array($pesquisar_func)) {
                                    echo '<option value="'.$resultado['cod'].'">'.
                                                            utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                            ?>
                        </select>
                        <select name="codcli" id="codcliente" style="width: 178px; height: 25px;">
                            <option value=0 selected="selected">Selecione cliente</option>
                            <?php
                                if(mysql_num_rows($pesquisar_cli) == 0) {
                                    echo '<h1>Sua busca por cliente NÃO RETORNOU resultados</h1>';
                                }
                                else {
                                while($resultado = mysql_fetch_array($pesquisar_cli)) {
                                    echo '<option value="'.$resultado['cod'].'">'.
                                                            utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                            ?>
                        </select>
                        <br><br>
                        <select name="codprod" id="codproduto" style="width: 178px; height: 25px;">
                            <option value=0 selected="selected">Selecione produto</option>
                            <?php
                                if(mysql_num_rows($pesquisar_prod) == 0) {
                                    echo '<h1>Sua busca por produto NÃO RETORNOU resultados</h1>';
                                }
                                else {
                                while($resultado = mysql_fetch_array($pesquisar_prod)) {
                                    echo '<option value="'.$resultado['cod'].'">'.
                                                            utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                            ?>
                        </select>
                        <input type="text" name="quantidade" class="span3" value="" required placeholder="Quantidade" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <input type="text" name="preco" class="span3" value="" required placeholder="Preço" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large" name="cadastrar" style="height: 35px">Cadastrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModalAlterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Alterar Pedido...</h1>
                </div>
                <div class="modal-body">
                    <form class="form-group well" action="pedidos.php" method="POST">
                        Cod   <input type="text" name="cod" id="cod" value="" required size=10>
                        Data  <input type="date" name="datapedido" id="datapedido" class="span3" value="" required placeholder="Data" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Funcionário <select name="codfunc" id="codfunc" style=" margin-bottom: -2px; height: 25px;">
                                    <option value=0 selected="selected">Selecione funcionario</option>
                                    <?php
                                    $sql_func = "SELECT cod,nome FROM funcionarios";
                                    $pesquisar_func = mysql_query($sql_func);

                                    while($resultado = mysql_fetch_array($pesquisar_func)) {
                                        echo '<option value="'.$resultado['cod'].'">'.
                                                        utf8_encode($resultado['nome']).'</option>';
                                        }
                                    ?>
                                    </select>
                        Cliente <select name="codcli" id="codcli" style="width: 178px; height: 25px;">
                            <option value=0 selected="selected">Selecione cliente</option>
                                    <?php
                                    $sql_cli = "SELECT cod,nome FROM clientes";
                                    $pesquisar_cli = mysql_query($sql_cli);

                                    while($resultado = mysql_fetch_array($pesquisar_cli)) {
                                        echo '<option value="'.$resultado['cod'].'">'.
                                                        utf8_encode($resultado['nome']).'</option>';
                                    }
                                    ?>
                                    </select><br><br>
                        Produto <select name="codprod" id="codprod" style="width: 178px; height: 25px;">
                            <option value=0 selected="selected">Selecione produto</option>
                                     <?php
                                     $sql_produtos = "SELECT cod,nome FROM produtos";
                                     $res_produtos = mysql_query($sql_produtos);

                                        while($resultado = mysql_fetch_array($res_produtos)) {
                                                 echo '<option value="'.$resultado['cod'].'">'.
                                                            utf8_encode($resultado['nome']).'</option>';
                                        }
                                     ?>
                                     </select><br><br>
                        Quantidade <input type="text" name="quantidade" id="quantidade" class="span3" value="" required placeholder="Quantidade" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Preco <input type="text" name="preco" id="preco" class="span3" value="" required placeholder="Preco" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large" name="alterar" style="height: 35px">Alterar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="myModalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Excluir Pedido...</h1>
                </div>
                <div class="modal-body">
                    <form class="form-group well" action="pedidos.php" method="POST">
                        Cod   <input id="cod" type="text" name="cod" value="" placeholder="Codigo" required size=10>
                        Data  <input type="date" name="datapedido" id="datapedido" class="span3" value=""  placeholder="Data" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Funcionario  <input type="text" name="codfunc" id="codfunc" class="span3" value=""  placeholder="Funcionario" style=" margin-bottom: -2px; height: 25px;">
                        Cliente <input type="text" name="codcli" id="codcli" class="span3" value=""  placeholder="Cliente" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Produto <input type="text" name="codprod" id="codprod" class="span3" value=""  placeholder="Produto" style=" margin-bottom: -2px; height: 25px;">
                        Quantidade <input type="text" name="quantidade" id="quantidade" class="span3" value=""  placeholder="Quantidade" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Preco <input type="text" name="preco" id="preco" class="span3" value=""  placeholder="Preco" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large" name="excluir" style="height: 35px">Excluir</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Pesquisa Pedidos: </h2><br>
            <form action="pedidos.php" method="post">
                <input type="text" name="cod" placeholder="Cod pedido" class="span4" style="margin-bottom: -2px; height: 25px; margin-right: 9px;" required>
                Data pedido<input type="date" name="datapedido" style="margin-right: 9px; margin-left: 3px;" required>
                <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                <a href="#myModalCadastrar">
                    <button type="button" name="cadastrar" class="btn btn-primary" data-toggle="modal" data-target="#myModalCadastrar">Cadastrar</button></a>
            </form>
            <br>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                <td><b>Cod</b></td>
                <td><b>Data</b></td>
                <td><b>Funcionário</b></td>
                <td><b>Cliente</b></td>
                <td><b>Produto</b></td>
                <td><b>Quantidade</b></td>
                <td><b>Preço</b></td>
                <td><b>Operação</b></td>
                </tr>
                <?php
                if(isset($_POST['cadastrar'])) {
                    $cod        = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
                    $codfunc    = $_POST['codfunc'];
                    $codcli     = $_POST['codcli'];
                    $codprod    = $_POST['codprod'];
                    $quantidade = $_POST['quantidade'];
                    $preco      = $_POST['preco'];

                    $sql = "insert into pedidos (cod, datapedido, codfunc, codcli, codprod, quantidade, preco)
                            values ('$cod','$datapedido','$codfunc','$codcli','$codprod','$quantidade','$preco')";
                    $resultado = mysql_query($sql);
                }
                if(isset($_POST['alterar'])) {
                    $cod        = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
                    $codfunc    = $_POST['codfunc'];
                    $codcli     = $_POST['codcli'];
                    $codprod    = $_POST['codprod'];
                    $quantidade = $_POST['quantidade'];
                    $preco      = $_POST['preco'];

                    $sql = "update pedidos set datapedido = '$datapedido'
                            where cod = '$cod'";    //o usuário do software só pode alterar a data do pedido, porque é um fator que é mais plausível de ser alterado
                    $resultado = mysql_query($sql);
                }
                if(isset($_POST['excluir'])) {
                    $cod        = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
                    $codfunc    = $_POST['codfunc'];
                    $codcli     = $_POST['codcli'];
                    $codprod    = $_POST['codprod'];
                    $quantidade = $_POST['quantidade'];
                    $preco      = $_POST['preco'];

                    $sql = "delete from pedidos where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }
                if(isset($_POST['pesquisar'])) {
                    $cod        = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
 
                    $consulta = "select pedidos.cod,pedidos.datapedido,funcionarios.nome as nomefunc,clientes.nome as nomecli,produtos.nome as nomeprod,pedidos.quantidade,pedidos.preco
                                    from pedidos, funcionarios, clientes, produtos
                                    where pedidos.codfunc = funcionarios.cod
                                    and pedidos.codcli = clientes.cod
                                    and pedidos.codprod = produtos.cod
                                    and pedidos.cod = '$cod'
                                    and datapedido = '$datapedido'";
                    $resultado = mysql_query($consulta);
                }
                else {
                    $consulta = "select pedidos.cod,pedidos.datapedido,funcionarios.nome as nomefunc,clientes.nome as nomecli,produtos.nome as nomeprod,pedidos.quantidade,pedidos.preco
                                from pedidos, funcionarios, clientes, produtos
                                where pedidos.codfunc = funcionarios.cod
                                and pedidos.codcli = clientes.cod
                                and pedidos.codprod = produtos.cod";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado)) {
                    $strdados = $dados['cod'] . "*" . $dados['datapedido'] . "*" . $dados['nomefunc'] . "*" . $dados['nomecli'] . "*" . $dados['nomeprod'] . "*" . $dados['quantidade'] . "*" . $dados['preco'];
                ?><tr>
                <td><?php echo $dados['cod']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($dados['datapedido']));?></td>
                <td><?php echo $dados['nomefunc']; ?></td>
                <td><?php echo $dados['nomecli']; ?></td>
                <td><?php echo $dados['nomeprod']; ?></td>
                <td><?php echo $dados['quantidade']; ?></td>
                <td><?php echo $dados['preco']; ?></td>
                <td>
                    <a href="#myModalExcluir" onclick="obterDadosModal('<?php echo $strdados ?>')">
                        <button type='button' id='excluir' name='excluir' class='btn btn-danger' data-toggle='modal' data-target='#myModalExcluir'>Excluir</button>

                    <a href="#myModalAlterar" onclick="obterDadosModal('<?php echo $strdados ?>')">
                        <button type='button' id='alterar' name='alterar' class='btn btn-primary' data-toggle='modal' data-target='#myModalAlterar'>Alterar</button>
                    </a>
                </td>
            </tr>
        <?php
        }
        mysql_close($conectar);
        ?>
        </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>