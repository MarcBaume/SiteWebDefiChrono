<?php 
$today = date("Y-m-d H:i:s"); 
date_default_timezone_set('Europe/Paris');
if (session_status() !== PHP_SESSION_ACTIVE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK 
 /*************************** CONNECTION AVEC LA BASE DE DONNEES ***********************************/
require_once __DIR__ . "/MysqlConnect.php";
require_once   "functions.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
	
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" href="../css/style.css" type="text/css"/>
	<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
	<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
	<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->

<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../js/prototype.js" ></script>
	<script src="../js/FonctionDefiChrono3.js?v=1"></script>
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.2/d3.min.js" charset="utf-8"></script>

	<script>
	function getURLHeader( ValueFind, IDElement) 
	{
		if (window.location.href.search(ValueFind)>-1)
		{
			document.getElementById(IDElement).classList.add("dotDisplayedHeader");
			document.getElementById(IDElement).classList.remove("dotHeader");
		}
		else
		{
			document.getElementById(IDElement).classList.add("dotHeader");
			document.getElementById(IDElement).classList.remove("dotDisplayedHeader");
		}
	}
	function getURLHeader4( ValueFind,  ValueFind2,ValueFind3,ValueFind4,IDElement) 
	{
		if (window.location.href.search(ValueFind)>-1 || window.location.href.search(ValueFind2)>-1|| window.location.href.search(ValueFind3)>-1|| window.location.href.search(ValueFind4)>-1)
		{
			document.getElementById(IDElement).classList.add("dotDisplayedHeader");
			document.getElementById(IDElement).classList.remove("dotHeader");

		}
		else
		{
			document.getElementById(IDElement).classList.add("dotHeader");
			document.getElementById(IDElement).classList.remove("dotDisplayedHeader");
		}
	}
</script>
<Div id= "Header" style="  z-index:1035;">
<table style= "width: 100%;">
<tr>
<td>
<Div id = "logo">
<a href="/index.php">
<img src="../images/LogoDefiChrono.svg" style="height:90px;" alt="" />
</a>
</div>
</td>
<td>
<Div id = "User">
<table>	
	<tr>	
		<td> 	
			<a href="/index.php">
				<span class="dotHeader"  id="ButtonIndex" >
					<i class="fa fa-home" style= "font-size: 28px;margin:7px;margin-top:5px ; "></i>
				</span>
				<script>
							getURLHeader( "index", "ButtonIndex" ) ;
				</script>
			</a>
		</td> 		
		<td> 
			<?php
			if ( ! isset($_SESSION['user']['login']))
			{?>
		<a href="https://staging.defichrono.ch/auth/oidc-login.php?destination=/pages/membres/index.php">
			<?php
			}
			else{
				?>
				<a href="/pages/member/index.php">
				<?php
			}?>
			<table>
				<tr>
					<td>
						<span class="dotHeader"  id="ButtonUser">
							<i class="fa fa-user-circle" style= "font-size: 25px;margin:8px; margin-top: 8px; "></i>
							<a style="vertical-align :center;">
							<?php
								if (  isset($_SESSION['user']['login']))
								{
									$pos = strpos($_SESSION['user']['login'],'@');
									$login = substr($_SESSION['user']['login'], 0, $pos) ;
									 echo  	$login ;
								
								}
								?>
								</A>
						</span>
						<script>
							getURLHeader4( "login","membres","ListResultat","Pannier", "ButtonUser" ) ;
						</script>
					</td>
				</tr>
					
			
			</table>
		</a>
		</td> 
		<td> 	
			<a href="Contact.php">
				<span class="dotHeader" id="ButtonContact">
					<i class="fa fa-info-circle" style= "font-size: 28px;margin:8px; margin-top: 6px; "></i>
				</span>
			</a>
			<script>
							getURLHeader( "contact", "ButtonContact" ) ;
				</script>
		</td> 

		<td>
		
		</td>
	</tr>

</table >

</div>
</td>
</table>
</div>
