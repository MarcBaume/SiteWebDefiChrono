


<?php
		// Ajout des Données de résultat
		// Création de la liste de toutes les Dossier = Depart 
        $pathFile   = 'SendEmail/ListeDepart.csv';


        if (file_exists($pathFile)) 
        {
            if (($handle = fopen( $pathFile, "r")) !== FALSE) 
            {
                // Envoie d'un email a chaque ligne 
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
                {
                        
     
                    $infoID =  $data[1] . ' ' . $data[2] . ' '. $data[6] ;
                    $message = '<html>
                    <head>
                    <title></title>
                    </head>
                    <body>

                       <p><b> TITRE DE TRANSPORT </b></p>
                    </br>
                    <p>
                      Les Courses du Tabeillon approchent, on se réjouit de ta participation !</p>
                    
                <p>  Comme promis, avec le soutien de notre partenaire Raiffeisen, nous t’offrons les transports publics sur <b>tout le réseau Vagabond</b> (tout le Jura et un peu plus 😉).<br/>
                </p> 
                <p> Voyage aller-retour le 8 octobre 2023 aux Courses du Tabeillon à Glovelier en transports publics dans toutes les zones Vagabond en 2ème classe inclus. <br/>
                    Cet e-mail fait office de titre de transport (valide uniquement le jour des courses), <b>conserve-le donc précieusement.</b>  <br/>
                    </p></br>
                    <p>
                    <b>'.$infoID.' <br/>
                    (2.)(SPEZ)(V)</b> 
                    </p>
                
                    Plus d’infos sur la zone couverte ici : <br/>
                <a href= https://www.levagabond.ch/fr/plan-de-zones-vagabond.html>https://www.levagabond.ch/fr/plan-de-zones-vagabond.html</a><br/>
                
                <p>
                <b> Important pour les VTT :</b> <br/>
                    Merci de prendre note que le réseau offre des possibilités limitées pour le transport de vélo.<br/>
                    Aucune disposition supplémentaire ne sera prise le jour de la course, nous ne pouvons donc pas garantir le transport de ton vélo.<br/>
            </p>    <br/> 
                    On te souhaite déjà une bonne course, à dimanche !<br/>
                
                    <a href="http://www.letabeillon.ch" > <img src="LogoTabeillon.jpg" alt="http://www.letabeillon.ch"></img> </a>
                </body>
                    </html>';

                    $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

                    mail( $data[10], 'Ton billet de train-bus pour le Tabeillon',$message ,$headers);
                
                                
        }
    }

}



?>



	
