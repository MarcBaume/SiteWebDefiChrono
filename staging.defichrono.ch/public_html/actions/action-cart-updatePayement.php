
<?php
require_once __DIR__ . "/../includes/functions.php";
require_once __DIR__ . "/../includes/MysqlConnect.php";

if (strlen($_REQUEST["OrderIDPayrexx"] ?? "") < 3) {
    print(-3);
} else {

    if (strlen($_REQUEST["LoginUpdateRegister"] ?? "") > 4) {

        $Value = "True";

        $sql = "SELECT * FROM inscription
                WHERE Login = :login
                AND Payer != :paye
                AND Payer != :bon
                AND PayementOnLine = :value";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            "login" => $_REQUEST["LoginUpdateRegister"],
            "paye" => "Payé",
            "bon" => "Bon",
            "value" => $Value
        ]);

        $index = 0;

        while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $index++;

            if (
                $donnees["Payer"] == "En Attente" ||
                $donnees["Payer"] == "cancelled" ||
                $donnees["Payer"] == "declined" ||
                $donnees["Payer"] == "refunded"
            ) {

                $sqlUpdate = "UPDATE inscription
                              SET OrderPayement = :orderID
                              WHERE ID = :id";

                $stmtUpdate = $pdo->prepare($sqlUpdate);

                $resultUpdate = $stmtUpdate->execute([
                    "orderID" => $_REQUEST["OrderIDPayrexx"],
                    "id" => $donnees["ID"]
                ]);

                if (!$resultUpdate) {
                    print(-1);
                    exit;
                }
            }
        }

        print($index);

    } else {
        print(-4);
    }
}
?>
