<?php
session_start();
 $IdRace  = 0;
    // Si une course est choisie
    if (isset($_GET['IdRace']) || isset($_SESSION["IdRace"]))
    {
        if (isset($_GET['IdRace']))
        {
            $IdRace  = (int) $_GET['IdRace'];
            $_SESSION["IdRace"] = $IdRace;
        }
        else
        {
           $IdRace  =  (int) $_SESSION["IdRace"];
        }
            // 1. Préparation de la requête avec un marqueur nommé
        $stmt = $pdo->prepare('SELECT * FROM Course WHERE ID = :idRace');

        // 2. Exécution en passant la variable sécurisée
        $stmt->execute([':idRace' =>  $IdRace ]);

        // 3. Récupération des résultats
        $allCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Si le tableau n'est pas vide
        if (count($allCourses)> 0) 
        {
            foreach ($allCourses as $course) 
            {
                $DateCourse =  $course['Date'];
                $Date =  date_parse($course['Date']);
                $ANNEE_COURSE = $Date['year']; 
                $Month = $Date['month']; 
                $Day = $Date['day']; 
                $NOM_COURSE = $course["Nom_Course"];
                $Nbr_etape =  $course["nbr_etape"] ;
                $Site = $course['Site'];
                break;
            }
        }
        else
        {
            echo "No Find Race";
            http_response_code(404);
        }
    // Suive de l'événemnt
    ?>
        <form method="get"  id="FormRace" name="FormRace"  >
            <input type="hidden" name="IdRace" id="IdRace"  value= '<?php echo $_GET["IdRace"] ?>' />
        </form>
    <?php
    }
    else
    {
        http_response_code(404);
    }
?>

