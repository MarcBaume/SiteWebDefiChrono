<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../css/style.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
 </script>
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
</script>
<?php
    // Si une course est choisie
    if (isset($_GET['IdRace']))
    {
            // 1. Préparation de la requête avec un marqueur nommé
        $stmt = $pdo->prepare('SELECT * FROM Course WHERE ID = :idRace');

        // 2. Exécution en passant la variable sécurisée
        $stmt->execute([':idRace' => $_GET['IdRace']]);

        // 3. Récupération des résultats
        $allCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Si le tableau n'est pas vide
        if (!empty($allCourses)) 
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

