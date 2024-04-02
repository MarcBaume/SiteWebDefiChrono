<?php $today = date("Y-m-d H:i:s"); 
date_default_timezone_set('Europe/Paris');
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK ?>
     <div id="logo">

	<img src="images/logoBanderole.png" alt=""  align="right"  />
   </div>
