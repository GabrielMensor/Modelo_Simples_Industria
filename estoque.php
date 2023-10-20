<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Pesquisa Estoque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <script>
        function obterDadosModal(valor) {
            var retorno = valor.split("*");
            document.getElementById('cod').value        = retorno[0];
            document.getElementById('nome').value       = retorno[1];
            document.getElementById('quantidade').value = retorno[2];
            document.getElementById('preco').value      = retorno[3];
        }

    </script>
    <div class="container">
        <div class="row">
            <h2>Estoque produtos:</h2><br>
            <form action="estoque.php" method="POST">
                <input type="text" name="nome" id="nome" placeholder="Nome Produto..." class="span4" style="margin-bottom: -2px; height: 25px;">
                <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Qtde Estoque</b></td>
                    <td><b>Qtde Minima</b></td>
                    <td><b>SALDO</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar'])) {
                   $nome   = strtoupper($_POST['nome']);
                   $consulta = "select cod,nome,quantidade from produtos
                                where UPPER(nome) like '%$nome%'";        
                   $resultado = mysql_query($consulta);
                }
                else {
                    $consulta = "select cod,nome,quantidade from produtos";
                    $resultado = mysql_query($consulta);
                }

                $totalestoque = 0;
                while ($dados = mysql_fetch_array($resultado)) {
                    $valor = $dados['cod'] . "*" . $dados['nome'] . "*" . $dados['quantidade'];
                    $minima = 20;
                    $totalestoque = $totalestoque + $dados['quantidade'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['quantidade']; ?></td>
                        <td><?php echo $minima; ?></td>                     <!-- definir uma quantidade mínima pro estoque -->
                        <td><?php $saldo=($dados['quantidade'] - $minima);
                                  if ($saldo < $minima) {
                                      echo "<font color='#FF0000'>".$saldo."</font>";
                                      }
                                  else
                                  {
                                      echo $saldo;
                                  }
                                  ?></td>
                    </tr>
                <?php
                }
                mysql_close($conectar);
                ?>
                <tr>
                    <td class="tdvazia"></td>
                    <td class="tdvazia"></td>
                    <td><b>Total Estoque: </b><?php echo $totalestoque ?></td>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>