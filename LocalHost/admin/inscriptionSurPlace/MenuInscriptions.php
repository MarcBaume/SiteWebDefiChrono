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
                    <h3> <? echo  $NOM_COURSE .$ANNEE_COURSE ?></h3>	
                </div>
            </td>
        <td>
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
        </tr>
   </table>
</div>

<script>
 
function ClickColForm()
{
    f1 = 	document.getElementById("FormRace");
    f1.action="FormulaireInscriptionOrganisateur.php";
     f1.submit();

}
function ClickColListe()
{
    f1 = 	document.getElementById("FormRace");
    f1.action="ListeInscriptionOrganisateur.php";
     f1.submit();


}

</script>