                       <head>
                     	<?php
  include("Header.php"); 
  ?>
                        </head>
                        <?php include("Header2023.php");?>

                       <form style="padding: 10px" id="formAddMember" name="formAddMember" method="post" action="CibleDownloadFileTabeillon.php"  >
			<p> Nom:<input type="text" name="nom" id="nom"   /></p>
<p> Prénom:<input type="text" name="prenom" id="prenom"   />
</p><p> Année de naissance exemple 1988:<input type="text" name="date" id="date"   /></p>
<button type="submit">Envoyer</button>
                    </form>
                        </html>';