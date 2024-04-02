  <div id="menu_vertical">
<li>
   <a href="index.php">Accueil</a>
   </li>
        <li>
		<form method="post"action ="nouvel_course_step1.php">
		<input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
		<button type ="button" style="float:right; margin-right :10px;" onClick="checkForm(this.form)" >Ajout course</button>
		</form>
   </li>
</div>