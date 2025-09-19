<script type="text/javascript">
function getURL( ValueFind, IDElement) {

	if (window.location.href.search(ValueFind)>-1)
		{
		//	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
			//document.getElementById(IDElement).style.color = "white";
			document.getElementById(IDElement).classList.add("dotDisplayed");
			document.getElementById(IDElement).classList.remove("dot");

		}
		else
		{
		//	document.getElementById(IDElement).style.backgroundColor = "transparent";
			//document.getElementById(IDElement).style.color = " #3d6ca4";
			document.getElementById(IDElement).classList.add("dot");
			document.getElementById(IDElement).classList.remove("dotDisplayed");
		}
		
       
    }
 </script>
 	<?php 
	 session_start();
     ?>
 <div id="menu_vertical" class="menu_vertical">
    <table style="Width : 100%">
        <tr>
	        <li>
            <?php
            if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
            {?>
                <td style="Width : 25%" onClick="ClickColProfil()"  >
                    <span class="dot" id="<?php echo "RowProfil".$IdRace ?>">
                        <table>
                            <tr style="Width : 100%">
                                <td>
                                    <i class="fa fa-building-o" style= "font-size: 25px;margin:8px;"></i>
                                </td>
                                <td>
                                    Entreprises 
                                </td>
                            </tr>
                        </table>
                    </span>
                </td>
                <script>
                    getURL( "ProfilEntreprise","<?php echo "RowProfil".$IdRace ?>" ) ;
                </script>
            <?
            }
            if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
            {?>
                <td style="Width : 25%" onClick="ClickColTeam()"  >
                    <span class="dot" id="<?php echo "RowTeam".$IdRace ?>">
                        <table>
                            <tr style="Width : 100%">
                                <td>
                                    <i class="fa fa-users" style= "font-size: 25px;margin:8px;"></i>
                                </td>
                                <td>
                                    équipes 
                                </td>
                            </tr>
                        </table>
                    </span>
                </td>
                <script>
                    getURL( "equipes_entreprise","<?php echo "RowTeam".$IdRace ?>" ) ;
                </script>
            <?
            }
            if  (isset($_SESSION['Login']))
            {?>
                <td style="Width : 25% " onClick="ClickColDeconnect()">
                    <span class="dot"  id="<?php echo "RowRace3".$IdRace ?>">
                        <table>
                            <tr  style="Width : 100%">
                                <td>
                                    <i class="fa fa-sign-in" style= "font-size: 25px;margin:8px;"></i>
                                </td>
                                <td>
                                    Déconnexion
                                </td>
                            </tr>
                        </table>
                    </span>
                </td>
            <?	
            }
            ?>
            </li>
        </tr>
    </table>
</div>
<script>
function ClickColTeam()
{
	 window.location.href = "equipes_entreprise.php";
}
function ClickColDeconnect()
{
	 window.location.href = "../../Deconnect.php";
}
function ClickColProfil()
{
	 window.location.href = "ProfilEntreprise.php";
}
</script>