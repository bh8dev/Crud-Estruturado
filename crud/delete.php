<?php

    //getting the connection
    require 'config.php';

    //verifies if theres any id
    if (isset($_GET['del_id']) && !empty($_GET['del_id']))
    {
        $id         = addslashes($_GET['del_id']);

        try
        {
            //deleting te record
            $sql        = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
            $sql        ->bindValue(":id", $id);
            $sql        ->execute();

            header("Location: ../index.php");
        }
        catch (PDOException $e)
        {
            echo "Erro ao processar esta operação: " . $e->getMessage();
            //exit;
        }
        catch (Exception $e)
        {
            echo "Erro: " . $e->getMessage();
            //exit;
        }
    }
    else
    {
        header("Location: ../index.php");
    }

?>