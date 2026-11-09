<?php
include("../includes/MysqlConnect.php");
try {
    $sql = 'DELETE FROM inscription WHERE ID = :id';
    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute([
        'id' => (int) $_REQUEST['idFormDeletePanier']
    ]);

    if ($result) {
        print(10);
    } else {
        print(-2);
    }

} catch (PDOException $e) {
    print(-2);
}



?>
