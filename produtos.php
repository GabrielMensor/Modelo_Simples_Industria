<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Pesquisa Produtos </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <script>
        function obterDadosModal(valor) {
            var retorno = valor.split("*");
            document.getElementById('cod').value   = retorno[0];
            document.getElementById('nome').value  = retorno[1];
            document.getElementById('quantidade').value = retorno[2];
            document.getElementById('preco').value = retorno[3];
        }
    </script>
    <!--Modal Cadastrar-->
    <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Cadastrar um registro ...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer cadastro  -->
                    <form class="form-group well" action="produtos.php" method="POST">
                        <input type="text" name="cod" class="span3" value="" required placeholder="Cod" style=" margin-bottom: -2px; height: 25px;">
                        <input type="text" name="nome" class="span3" value="" required placeholder="Nome" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <input type="text" name="quantidade" class="span3" value="" required placeholder="Quantidade" style=" margin-bottom: -2px; height: 25px;">
                        <input type="text" name="preco" class="span3" value="" required placeholder="Preco" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large" name="cadastrar" style="height: 35px">Cadastrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Alterar-->
    <div class="modal fade" id="myModalAlterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h1>Alterar Registro...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer alteracao -->
                    <form class="form-group well" action="produtos.php" method="POST">
                        Cod   <input id="cod" type="text" name="cod" value="" required>
                        Nome  <input id="nome" type="text" name="nome" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Quantidade <input id="quantidade" type="text" name="quantidade" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;">
                        Preco <input id="preco" type="text" name="preco" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large" name="alterar" style="height: 35px">Alterar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--Modal Excluir-->
    <div class="modal fade" id="myModalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h1>Excluir Registro...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para excluir -->
                    <form class="form-group well" action="produtos.php" method="POST">
                        Cod   <input id="cod" type="text" name="cod" value="" required>
                        Nome  <input id="nome" type="text" name="nome" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Quantidade <input id="quantidade" type="text" name="quantidade" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;">
                        Preco <input id="preco" type="text" name="preco" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
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
            <h2>Pesquisa produtos: </h2><br>
            <form action="produtos.php" method="POST">
                <input type="text" name="nome" placeholder="Nome Produto..." class="span4" style="margin-bottom: -2px; height: 25px;">
                <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                <a href="#myModalCadastrar">
                <button type="button" name="cadastrar" class="btn btn-primary" data-toggle="modal" data-target="#myModalCadastrar">Cadastrar</button></a>
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Quantidade</b></td>
                    <td><b>Preco</b></td>
                    <td><b>Operacao</b></td>
                </tr>
                  <?php
                  if (isset($_POST['cadastrar']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "insert into produtos (cod, nome, quantidade, preco)
                            values ('$cod','$nome','$quantidade','$preco')";
                     $resultado = mysql_query($sql);
                }
                if (isset($_POST['alterar']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "update produtos set nome = '$nome', quantidade = '$quantidade', preco = '$preco'
                            where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }
                if (isset($_POST['excluir']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "delete from produtos where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }
                if (isset($_POST['pesquisar']))
                {
                   $nome   = strtoupper($_POST['nome']);    // converter maiuscula
                   $consulta = "select cod,nome,quantidade,preco from produtos
                                where UPPER(nome) like '%$nome%'";
                   $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select cod,nome,quantidade,preco from produtos";
                    $resultado = mysql_query($consulta);
                }
                while ($dados = mysql_fetch_array($resultado))
                {
                    $strdados = $dados['cod'] . "*" .  $dados['nome'] . "*" . $dados['quantidade'] . "*" . $dados['preco'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
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
    <!-- Biblioteca requerida -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>