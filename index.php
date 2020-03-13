<?php

    require 'crud/config.php';
    $sql        = $pdo->query("SELECT * FROM usuarios");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Crud - Listagem de Usuários</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
            crossorigin="anonymous">
</head>
<body>
    <!-- container -->
    <div class="container">
        <section class="mt-3 mb-3">
            <a class="btn btn-outline-info" href="crud/add.php">Adicionar novo usuário</a>
        </section>
        <!-- table -->
        <table class="table text-center table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    if ($sql->rowCount() > 0)
                    {
                        foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $usuario)
                        {
                            echo '<tr>';
                            echo '<th>' . $usuario['id'] . '</th>';
                            echo '<td>' . $usuario['nome'] . '</td>';
                            echo '<td>' . $usuario['email'] . '</td>';
                            echo '
                                <td>
                                    <a class="text-primary" href="crud/edit.php?updt_id='.$usuario['id'].'">Editar</a>
                                    - 
                                    <a class="text-danger" href="crud/delete.php?del_id='.$usuario['id'].'">Excluir</a>
                                </td>
                            ';
                            echo '</tr>';
                        }
                    }
                    else
                    {
                        echo '<td colspan="4" class="text-center">Não há usuários cadastrados.</td>';
                    }

                ?>
            </tbody>
        </table>
        <!-- ./table -->
    </div>
    <!-- ./container -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" 
            crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
        crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" 
            crossorigin="anonymous">
    </script>
</body>
</html>