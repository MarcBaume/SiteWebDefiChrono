


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
                    <title>Dossards BCJ Challenge 2026</title>
                     <style>
table, td, th {
  border: 1px solid;
  padding : 5px;
}

table {
  border-collapse: collapse;
}
        
    </style>
                    </head>
                    <body>
    <h2 style="background-color: #3D6CA4;padding : 10px ;color :#fff"  > BCJ CHALLENGE 2026 </h2></br></br>

                      <p><b>'.  strtoupper($data[1]) . ' '. strtoupper($data[2]).'</b></p>
                    </br>
                  <p>
            Le BCJ Challenge ça commence ce mercredi au Genevez!</br></br>
             On se réjouit de ta participation.</br>
             Voici ton numéro que tu vas annoncer lors de la remise des dossards !</p>
        </br>
                    <p>Tu auras le dossard : <b> '.  $data[0] .'</b></br></p>
                   <p> Ton départ : <b> '.  $data[13] .' </b></br></p>
        </br> 
       
                Défi chrono te souhaite déjà une bonne course<br/>
              <p>
    <img style="width:200px;"src="https://defichrono.ch/images/LogoDefiChrono2023.png"></img>
    </p></br></br>
                </body>
                    </html>';

                      $headers = array(
        'From' => 'Défi chrono<webmaster@defichrono.ch>',
        'Reply-To' => 'Défi chrono<webmaster@defichrono.ch>',
        'Content-Type' => 'text/html; charset=utf-8'
    );


              if (     mail( $data[10], 'BCJ CHALLENGE 2026 DOSSARDS',$message ,$headers))
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



	
