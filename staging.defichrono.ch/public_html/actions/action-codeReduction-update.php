
<?php
/*____________________________________________________________________

    CodeReduction
    - Recherche du bon de réduction
    - Vérification de sa date limite
    - Vérification du nom et prénom
    - Vérification de sa disponibilité

____________________________________________________________________*/

if (strlen($_REQUEST['Code'] ?? '') > 2)
{
    $ArrCourse = explode(';', $_REQUEST['strListCourse'] ?? '');

    require_once __DIR__ . "/../includes/functions.php";
    require_once __DIR__ . "/../includes/MysqlConnect.php";

    $sql = "SELECT * FROM CodeReduction WHERE Code = :code";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':code' => $_REQUEST['Code']
    ]);

    $trouve = false;
    $today = date("Y-m-d H:i:s");

    while ($val = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $trouve = true;

        // Vérification de la date limite
        if (
            $today < $val["DateLimit"] ||
            $val["DateLimit"] == '0000-00-00 00:00:00'
        )
        {
            // Vérification de la disponibilité
            if (strlen($val["LoginValid"]) == 0)
            {
                $NOM = string2url($val['Nom']);
                $PRENOM = string2url($val['Prenom']);

                $NOMREQUEST = string2url($_REQUEST['NomCode'] ?? '');
                $PRENOMREQUEST = string2url($_REQUEST['PrenomCode'] ?? '');

                if (
                    ($NOM == $NOMREQUEST && $PRENOM == $PRENOMREQUEST)
                    ||
                    (strlen($val['Nom']) == 0 && strlen($val['Prenom']) == 0)
                )
                {
                    // Réduction par étape et non en francs
                    print(json_encode($val["ReductionCHF"]));
                    exit;
                }
            }
            else
            {
                print(-8); // Bon déjà utilisé
                exit;
            }
        }
        else
        {
            print(-16); // Bon expiré
            exit;
        }
    }

    if (!$trouve)
    {
        print(-5); // Aucun bon trouvé
    }
    else
    {
        print(-16); // Aucun bon libre correspondant
    }
}
else
{
    print(-10); // Aucun numéro de bon saisi
}
