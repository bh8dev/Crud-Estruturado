<?php

    require 'config.php';

    if (isset($_GET['updt_id']) &&  !empty($_GET['updt_id']))
    {
        $id                 = addslashes($_GET['updt_id']);

        //recover data before doing the update
        try
        {
            $sql            = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $sql            ->bindValue(":id", $id);
            $sql            ->execute();

            if ($sql->rowCount() > 0)
            {
                $data       = $sql->fetch(PDO::FETCH_ASSOC);
                $nome       = $data['nome'];
                $email      = $data['email'];
            }
            else
            {
                header("Location: ../index.php");
            }
        }
        catch (PDOException $ex)
        {
            echo "Erro ao executar esta operação: " . $ex->getMessage();
        }
        catch (Exception $ex)
        {
            echo "Erro: " . $ex->getMessage();
        }
    }
    else
    {
        header("Location: ../index.php");
    }

    //edit button was clicked
    if (isset($_POST['nome']) && !empty($_POST['nome']))
    {
        $nome               = addslashes($_POST['nome']);

        if (!empty($_POST['email']) && !empty($_POST['pwd']))
        {
            $email          = addslashes($_POST['email']);
            $senha          = md5(addslashes($_POST['pwd']));
        }
        try
        {
            $sql            = $pdo->prepare("UPDATE usuarios SET nome = :n, email = :e , senha = :s WHERE   id = :id");
            $sql            ->bindValue(":n", $nome);
            $sql            ->bindValue(":e", $email);
            $sql            ->bindValue(":s", $senha);
            $sql            ->bindValue(":id", $id);
            $sql            ->execute();

            header("Location: ../index.php");
        }
        catch (PDOException $ex)
        {
            echo "Erro ao processar esta operação: " . $ex->getMessage();
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
    <title>Editar usuário</title>
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
                        <input class="form-control" type="text" value="<?php echo $nome; ?>" name="nome" id="nome" maxlength="100" placeholder="Novo nome" autofocus required>
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input class="form-control" type="email" value="<?php echo $email; ?>" name="email" id="email" maxlength="150" placeholder="email@exmaple.com" required>
                    </div>
                    <!-- password -->
                    <div class="form-group">
                        <label for="pwd">Senha:</label>
                        <input class="form-control" type="password" name="pwd" id="pwd" maxlength="32" placeholder="Nova senha" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Atualizar</button>
                    </div>
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