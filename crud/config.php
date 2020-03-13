<?php

    $dsn            = "mysql:host=127.0.0.1;dbname=praticar_crud";
    $dbUser         = "root";
    $dbPasswd       = "";
    $options        = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try 
    {
        $pdo        = new PDO($dsn, $dbUser, $dbPasswd, $options);
    }
    catch (PDOException $e)
    {
        echo "Erro com o banco de dados: " + $e->getMessage();
        exit;
    }
    catch (Exception $e)
    {
        echo "Erro genérico: " . $e->getMessage();
        exit;
    }

?>