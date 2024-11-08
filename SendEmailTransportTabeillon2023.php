


<?php
		// Ajout des Données de résultat
		// Création de la liste de toutes les Dossier = Depart 
        $pathFile   = 'SendEmail/listeDepart.csv';


        if (file_exists($pathFile)) 
        {
            if (($handle = fopen( $pathFile, "r")) !== FALSE) 
            {
                // Envoie d'un email a chaque ligne 
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
                {
                        
     
                    $infoID =  $data[1] .  $data[2] .  $data[6] ;
                    $message = '<html>
                    <head>
                    <title></title>
                    </head>
                    <body>

                       <p>INFORMATIONS &  TITRE DE TRANSPORT DE <b>'.  strtoupper($data[1]) . ' '. strtoupper($data[2]).'</b></p>
                    </br>
                  <p>
            Les Courses du Tabeillon approchent, on se réjouit de ta participation !</p>
</br>
</br>
</br>
                    <p>Tu auras le dossard : <b> '.  $data[0] .'</b></br></p>
                   <p> Ton départ : <b> '.  $data[13] .' </b></br></p>
                  <p>  Ton heure de départ : <b> '.  $data[14] .'</b> </br></p>
        </br>
        </br>
        </br>    
        <p>  Comme promis, avec le soutien de notre partenaire Raiffeisen, nous t’offrons les transports publics sur <b>tout le réseau Vagabond</b> (tout le Jura et un peu plus 😉).</br>
        </p>  <br/>Télécharge ton billet via le lien ci-dessous,  il fera office de titre de transport.</br></br>
        
        <p><a href="https://defichrono.ch/pdfMailingTabeillon/' . $infoID.'.pdf"> Télécharge ton billet ici </a></p> </br></br>
                
                On te souhaite déjà une bonne course, à dimanche !<br/>
                
                    <a href="http://www.letabeillon.ch" ></a>
                </body>
                    </html>';
                    $headers = 'From: Defi chrono <info@defichrono.ch>'."\r\n";
                    $headers = "Content-Type: text/html; charset=utf-8\r\n";

              if (     mail( $data[10], 'LE TABEILLON INFORMATIONS &  TITRE DE TRANSPORT',$message ,$headers))
              {
                echo  '<p>Envoie OK :'. $data[10].'</p>';
              }
              else
              {
                echo  '<p>Erreur  envoie :'. $data[10].'</p>';
              }
                
                                
        }
    }

}



?>



	
