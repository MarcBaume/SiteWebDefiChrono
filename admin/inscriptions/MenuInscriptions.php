<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
 </script>
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
</script>
<?php
 
 if ( strlen($_POST['DateCourse'])>0)
 {
    $DateCourse =  $_POST['DateCourse'];
    $Date =  date_parse($_POST['DateCourse']);
    $ANNEE_COURSE = $Date['year']; 
    $Month = $Date['month']; 
    $Day = $Date['day']; 
    //$ANNEE_COURSE = $_POST['annee_course'];
    $NOM_COURSE = $_POST["NomCourse"];
    $Nbr_etape =  $_POST["NbrEtape"] ;
 
 }
 else if  ( strlen($_GET['DateCourse'])>0)
 {
 $DateCourse =  $_GET['DateCourse'];
 $Date =  date_parse($_GET['DateCourse']);
 $ANNEE_COURSE = $Date['year']; 
 $Month = $Date['month']; 
 $Day = $Date['day']; 
 
 //$ANNEE_COURSE = $_GET['annee_course'];
 $NOM_COURSE = $_GET["NomCourse"];
 $Nbr_etape =  $_GET["NbrEtape"] ;
 }



/*************************** CONNECTION AVEC LA BASE DE DONNEES ***********************************/
	include("../../MysqlConnect.php");
// ***************************************** AFFICHAGE BASE de Donnée ***************************************
	  // Create table de donnée du nom de parcours
//	mysqli_select_db($con,$row['Database']);
	$sql = 'SELECT * FROM Course  WHERE Nom_course=\''.$NOM_COURSE.'\'AND AnneeCourse=\''.$ANNEE_COURSE.'\'' ; 
	$result = mysqli_query($con,$sql);
    ?>
    <script>
console.log( <?php echo json_encode( $ANNEE_COURSE);?>);
</script>
    <?
    if ($result && mysqli_num_rows($result) > 0) 
    {
        // output data of each row
        while($val1 = mysqli_fetch_assoc($result)) 
        {
           
           ?>
            <script>
console.log( <?php echo json_encode( $val1);?>);
</script>
            <?
            $val = $val1;
        }
    }
    ?>
    

<script>

function getURL( ValueFind, IDElement) {

if (window.location.href.search(ValueFind)>-1)
    {
        document.getElementById(IDElement).classList.add("dotDisplayed");
        document.getElementById(IDElement).classList.remove("dot");

    }
    else
    {
        document.getElementById(IDElement).classList.add("dot");
        document.getElementById(IDElement).classList.remove("dotDisplayed");
    }
    
   
}
</script>
<form method="get"  id="FormMenu" name="FormMenu"  >

<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />

</form>

 <div id="menu_vertical" class="menu_vertical">

    <table style="Width : 100%">
        <tr>

        <td>
            <a href="../../index.php">
              <img src="../../images/LogoDefiChrono2023.svg" style="height:60px;" alt="" />
            </a>
        </td>
        <td>
            <div id="Title" style="margin: 10px;">
                 <h3> <? echo  $_GET["NomCourse"] .$ANNEE_COURSE ?></h3>	
            </div>
        </td>
        <td>
	       <li>
                <td style="Width : 25%" onClick="ClickColForm()" >
                    <span class="dot"  id="<?php echo "Rowinsc".$IdRace ?>"  >
                        <table>
                            <tr   style="Width : 100%">
                                <td>
                                    <i class="fa fa-wpforms" style= "font-size: 20px;margin:9px;"></i>
                                </td>
                                <td>
                                    Formulaire
                                </td>
                            </tr>
                        </table>
                    </span>
                </td>
                <script>
                    // Style si page active
	            	getURL( "formulaireInscriptionAdmin","<?php echo "Rowinsc".$IdRace ?>" ) ;
	            </script>
                <td  style="Width : 25%" onClick="ClickColListe()">
                    <span class="dot"  id="<?php echo "RowList".$IdRace ?>" >
                        <table>
                            <tr style="Width : 100%">
                                <td>
                                    <i class="fa fa-list" style= "font-size: 25px;margin:8px;"></i>
                                </td>
                                <td>
                                    Liste de départ
                                </td>
                            </tr>
                        </table>
                    </span>
                    <script>
                    // Style si page active
	            	getURL( "listeInscriptionOrganisateur","<?php echo "RowList".$IdRace ?>" ) ;
	            </script>
                </td>
            </li>
        </tr>
   </table>
</div>

<script>
 
function ClickColForm()
{
    f1 = 	document.getElementById("FormMenu");
    f1.action="formulaireInscriptionAdmin.php";
  
     f1.submit();

}
function ClickColListe()
{
    f1 = 	document.getElementById("FormMenu");
    f1.action="listeInscriptionOrganisateur.php";
     
     f1.submit();


}

</script>