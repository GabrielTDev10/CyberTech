<?php
require_once("conexao.php");

$sql = "SELECT codigo, nome, descricao,valor,url_arquivo FROM produto";

$consulta = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Lista de Usuários</title>
    <meta charset="UTF-8" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="styles2.css">

  
</head>
<style>
    body{
        background : black;
        color: white;   
        font-family: 'open_sansregular';
        font-size: 17px;
    }

 


    img{
        width: 100px;
    }


    table,td,th{
        border: 1px solid white;
        
    }
    
</style>

<body>
    <div id="page">
        <h1>Lista de Produtos</h1>

        <table id="produtos" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($linha = mysqli_fetch_array($consulta)) {
                    echo "<tr id='linha{$linha['codigo']}'>";
                    echo "<td>" . $linha['codigo'] . "</td>";
                    echo "<td>" . $linha['nome'] . "</td>";
                    echo "<td>" . $linha['descricao'] . "</td>";
                    echo "<td>" . $linha['valor'] . "</td>";
                    echo "<td> <img src='" . $linha['url_arquivo'] . "'/> </td>";       
                    echo "</tr>";
                }

             

               
               

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </tfoot>
        </table>

        <script>
            $(document).ready(function() {
                $('#produtos').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                    }
                });
            });
        </script>

    </div>
</body>

</html>