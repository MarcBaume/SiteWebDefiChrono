


<?php
		// Ajout des Données de résultat
		// Création de la liste de toutes les Dossier = Depart 
	// Afficher la liste des départ Dossier dans la course ;
	$pathfolder = 'pdfMailingTabeillon/';
	// Création de la liste de toutes les Dossier = Depart 
	$files1 = scandir($pathfolder);
	
	foreach ($files1  as $key => $value) 
	{ 
        $message = "";
        $arFile = explode("l_l", $value);

        $arFile[2] = str_replace(".pdf", "", $arFile[2], $count);

        
        // clé aléatoire de limite
        $boundary = md5(uniqid(microtime(), TRUE));

        $eol = "\r\n";

   
        // Headers
        $headers = 'From: Info defi chrono <info@defichrono.ch>'."\r\n";
        $headers .= 'Mime-Version: 1.0'."\r\n";
        $headers .= 'Content-Type: multipart/mixed;boundary='.$boundary."\r\n";
        
        $headers .= "\r\n";
 
        // Message
$msg = 'Texte affiché par des clients mail ne supportant pas le type MIME.'."\r\n\r\n";
 

        // Message HTML
        $message = '--'.$boundary."\r\n";
    //    $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
//     $headers = "Content-Type: multipart/mixed; charset=ISO-8859-1\r\n";

        $message .= "Content-Type: text/html; charset=utf-8".$eol;
 //       $message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
        $message .= '
        <div>

            <p><b> TITRE DE TRANSPORT '. $arFile[0]. ' '.  $arFile[1].'</b></p>
        </br>
        <p>
            Les Courses du Tabeillon approchent, on se réjouit de ta participation !</p>
        
        <p>  Comme promis, avec le soutien de notre partenaire Raiffeisen, nous t’offrons les transports publics sur <b>tout le réseau Vagabond</b> (tout le Jura et un peu plus 😉).</br>
        </p>  <br/> Ton billet est en pièce jointe, celui-ci devra être montré au contrôleur.</br></br>'.
        /*   <p> Voyage aller-retour le 8 octobre 2023 aux Courses du Tabeillon à Glovelier en transports publics dans toutes les zones Vagabond en 2ème classe inclus. <br/>
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
        </p>    <br/> */'
                On te souhaite déjà une bonne course, à dimanche !</br></br>
            
            </div>'."\r\n";


           
// Pièce jointe 1
$file_name = 	$pathfolder.  $value;
if (file_exists($file_name))
{
	$file_type = filetype($file_name);
	$file_size = filesize($file_name);
 
	$handle = fopen($file_name, 'r') or die('File '.$file_name.'can t be open');
	$content = fread($handle, $file_size);
	$content = chunk_split(base64_encode($content));
	$f = fclose($handle);
 
	$message .= '--'.$boundary."\r\n";
	$message .= 'Content-type:application/pdf;name=Billet_'.$arFile[0]. ' '.  $arFile[1].".pdf\n";
	$message .= 'Content-transfer-encoding:base64'."\r\n\r\n";
	$message .= $content."\r\n";
}
// Fin
$msg .= '--'.$boundary."\r\n";


                mail( $arFile[2],  $arFile[0]. ' '.  $arFile[1]. 'Ton billet de train-bus pour le Tabeillon',$message ,$headers);
            
                echo "v1.0.10.0".$eol ;             
                echo $count.$eol ;
                echo $arFile[2].$eol;  
                echo $arFile[0].$eol;
                echo  $arFile[1].$eol;       
        
    }



?>



	
