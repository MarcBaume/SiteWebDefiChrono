<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronom�trage, chrono, jura, franches-montagnes, Jura d�fi, course � pied, Sport, Jura d�fi chrono" />  
	<title>D�fi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV2.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<body>
<?php
  include("HeaderAdmin.php"); 
  ?>
</br>
<?	include("MenuMember.php"); 
	include("../MysqlConnect.php");

	 $sql = 'SELECT * FROM Course  WHERE Nom_Course=\''.$NOM_COURSE.  '\'';
	 
?>
<div id="corps">
		<form method="post" action="modification_info.php" name = "formEtape" >
				<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
				<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
				<input type="hidden" name="NomCourse" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
				<input type="input" name="NameFieldModif" id="NameFieldModif"  />
				<input type="input" name="ValueFieldModif" id="ValueFieldModif"  />		
		</form>
	 
	<h2>Modification informations  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>  </h2>
	<?
  	$result = mysqli_query($con,$sql);
    
	 if ($result && mysqli_num_rows($result) > 0) {
    // output data of each row
    while($val = mysqli_fetch_assoc($result)) {?>
	<div id="Information">
	<table>
	<tr>
	<!-- informations base de donn�e -->
		<td>
			 Lieu : 
		</td>
		<td>
			<input type="text" name="Lieu" id="Lieu" tabindex="10"  value= '<?php echo $val ["Lieu"] ?>'  />
		</td>
		<td onclick="modification(Lieu)">
			<i  style=" width: 50px; height: 50px; margin:5px;"  class="fa fa-edit"></i> </input>
		</td>
	</tr>
	<tr>
		<td>
			Emplacement : 
		</td>
		<td>
			<input type="text" name="Emplacement" id="Emplacement" tabindex="10"  value= '<?php echo $val ["Emplacement"] ?>'  />
		</td>
		<td    onclick="modification(Emplacement)">		
			<i  style="width: 50px; height: 50px  margin:5px;"  class="fa fa-edit"></i> 
		</td>
	</tr>
	<tr>
		<td> Organisateur :  </td>
		<td>
		<input type="text" name="Organisateur" id="Organisateur" tabindex="10"  value= '<?php echo $val ["Organisateur"] ?>'  />
		</td>
		<td onclick="modification(Organisateur)">
		<i  style="width: 50px; height: 50px;  margin:5px;"  class="fa fa-edit"></i> 
		</td>
  </tr>
  <tr>
		<td>  Site Web :   </td>
		<td>
		<input type="text" name="Site" id="Site" tabindex="10"  value= '<?php echo $val ["Site"] ?>'  />
		</td>
		<td  onclick="modification(Site)" > 
			<i  style=" width: 50px; height: 50px;  margin:5px;"  class="fa fa-edit"></i> 
		</td>
	</tr>
	<tr>
		<td >   Contact :   </td>
		<td>
			<input type="text" name="Coordonnee" id="Coordonnee" tabindex="10"  value= '<?php echo $val ["Coordonnee"] ?>'  />
		</td>
		
		<td   onclick="modification(Coordonnee)"> 
			<i  style=" width: 50px; height: 50px; margin:5px;"  class="fa fa-edit"></i> 
		</td>
	</tr>
	<tr>
		<label for="Email">   E-Mail :   </label>
		<input type="text" name="Email" id="Email" tabindex="10"  value= ' <?php echo $val ["Email"] ?>'  />
		<input type="button"   onclick="modification(Email)" style= " width: 50px; height: 50px";> 
		<i  style="  margin:5px;"  class="fa fa-edit"></i> </input>
	
</tr>
  <tr>
		<Td> Date d�but Inscriptions : </td>
		<td>
		<input type="text" name="DateStartInscription" id="DateStartInscription" tabindex="10"  
				value= '<?php echo  strftime('%d/%m/%Y %X',strtotime($val["DateStartInscription"]));?>'  />
		<td>
		<td   onclick="modification(DateStartInscription)"> 
			<i  style=" width: 50px; height: 50px  margin:5px;"  class="fa fa-edit"></i> </input>
	
  </tr>
  <tr>

		<td>  Date fin Inscriptions : </td>
		<td>
		<input type="text" name="DATE_END_INSCRIPTION" id="DATE_END_INSCRIPTION" tabindex="10"  
		value= '<?php echo  strftime('%d/%m/%Y %X',strtotime($val ["DATE_END_INSCRIPTION"]));?>'  />
		</td>
		<td   onclick="modification(DATE_END_INSCRIPTION)" > 
		<i  style=" width: 50px; height: 50px; margin:5px;"  class="fa fa-edit"></i> 
		</td>

 </tr>
 <tr>
	<td>  Description : </td>
	<td>
	<input type="text" name="Description" id="Description" tabindex="10"  value= '<?php echo  $val ["Description"]?>'  />
	</td>
	<td  onclick="modification(Description)"> 
		<i  style="  margin:5px; width: 50px; height: 50px"  class="fa fa-edit"></i> 
	</td>
		
</tr>
<tr>
 <p>
	<td>  Informations : </td>
	<td>
	<input type="text" name="Informations" id="Informations" tabindex="10"  
	value= '<?php echo  $val ["Informations"]?>'  />
	</td>
		<td   onclick="modification(Informations)" > 
		<i  style="  margin:5px;width: 50px; height: 50px"  class="fa fa-edit"></i> </input>
		</td>

 </tr>
 <tr>
	<td>  Informations Inscriptions: </td>
	<td>
	<input type="text" name="InformationInscription" id="InformationInscription" tabindex="10" 
	value= '<?php echo  $val ["InformationInscription"]?>'  />
	</td>
	<td   onclick="modification(InformationInscription)"> 
		<i  style="  margin:5px;width: 50px; height: 50px"  class="fa fa-edit"></i> </input>
	</td>
  
<?}
	 }
  
  ?>
   </p> 

</div>
</div>
</div>

</body>
</html>
