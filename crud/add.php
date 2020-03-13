<?php

    require 'config.php';

    //button was clicked
    if (isset($_POST['nome']) && !empty($_POST['nome']))
    {
        $nome           = addslashes($_POST['nome']);
        $email          = addslashes($_POST['email']);
        $senha          = md5(addslashes($_POST['pwd']));
    }
    if (!empty($email) && !empty($senha))
    {
        try
        {
            $sql        = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
            $sql        ->bindValue(":e", $email, PDO::PARAM_STR);
            $sql        ->execute();
            
            //verifies if theres already registered data
            if ($sql->rowCount() > 0)
            {
                $error  = 
                '
                    <div class="mt-3 text-center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Usuário já <strong>cadastrado</strong> anteriormente.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                ';
                
            }
            else
            {
                $sql       = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
                $sql       ->bindValue(":n", $nome, PDO::PARAM_STR);
                $sql       ->bindValue(":e", $email, PDO::PARAM_STR);
                $sql       ->bindValue(":s",$senha, PDO::PARAM_STR);
                $sql       ->execute();
                
                header("Location: ../index.php");
            }
        }
        catch (PDOException $ex)
        {
            echo "Ocorreu um erro: " . $ex->getMessage();
            exit;
        }
        catch (Exception $ex)
        {
            echo "Erro: " . $ex->getMessage();
            exit;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Cadastrar novo Usuário</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
            crossorigin="anonymous">
</head>
<body>
    <!-- container -->
    <div class="container">
        <!--- row -->
        <div class="row justify-content-center mt-5">
            <!-- col -->
            <div class="col-md-6">
                <!-- Form -->
                <form method="POST">
                    <!--- nome -->
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input class="form-control" type="text" name="nome" id="nome" maxlength="100" placeholder="Seu nome" autofocus required>
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input class="form-control" type="email" name="email" id="email" maxlength="150" placeholder="email@exmaple.com" required>
                    </div>
                    <!-- password -->
                    <div class="form-group">
                        <label for="pwd">Senha:</label>
                        <input class="form-control" type="password" name="pwd" id="pwd" maxlength="32" placeholder="Senha" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                    </div>
                    <?php
                        if(isset($error) ? $error : '');
                    ?>
                </form>
                <!-- ./form -->
            </div>
            <!-- ./col-6 -->
        </div>
        <!-- ./row -->
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