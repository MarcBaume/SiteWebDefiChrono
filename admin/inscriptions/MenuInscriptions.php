 
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