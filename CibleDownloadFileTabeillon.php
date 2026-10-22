                       <head>
                     	<?php
  include("Header.php"); 
  ?>
                        </head>
                        <body>
                            <?php 
                            $nom = $_POST['nom'];
                              $prenom = $_POST['prenom'];
                                $date = $_POST['date'];
                                $pdf = "/pdfMailingTabeillon/" .$nom ."_".$prenom ."_".$date.".pdf"?>
                        <br/>
                            <p>Les Courses du Tabeillon approchent, on se réjouit de ta participation !</p>
                            <br/>
                            <br/>
                                <p> La remise de votre dossard se fera au plus tard 30 minutes avant ton départ</p>
                            <br/>
                            
                            <br/>
                            <br/>
                            <br/>    
                            <p>  Comme promis, avec le soutien de notre partenaire Raiffeisen, nous t’offrons les transports publics sur <b>tout le réseau Vagabond</b> (tout le Jura et un peu plus 😉).<br/>
                            </p>  <br/>Télécharge ton billet via le lien ci-dessous,  il fera office de titre de transport.<br/><br/>
                            
                            <p><a href="https://defichrono.ch/<?php echo $pdf ?>"> Télécharge ton billet ici </a></p> <br/><br/>
                        
                        On te souhaite déjà une bonne course, à dimanche !<br/>
                        
                            <a href="http://www.letabeillon.ch" >www.letabeillon.ch</a>
                        </body>
                        </html>';