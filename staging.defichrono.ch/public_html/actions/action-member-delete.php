<?php
require_once __DIR__ . "/../includes/MysqlConnect.php";	
 require_once __DIR__ . "/../includes/functions.php";
try
{
    $req = $pdo->prepare('DELETE FROM Membres WHERE ID = :id');

    $req->execute([
        ':id' => $_POST['ID']
    ]);

    header("Location: ../pages/member/index.php");
    exit;
}
catch (PDOException $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
