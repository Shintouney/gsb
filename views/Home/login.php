
<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>GSB<span>Login</span></div>
	</div>
		<br>
		<div class="login">
			<form action="" method="post">
			<input placeholder="username" type="text" name="login" id="login" required/>
			<input placeholder="password" type="password" name ="mdp" id="mdp" required/>
			<input type="submit" value="connexion"/>
			</form>
            <?= isset($_SESSION['login_error']) ?  '<h2>Une erreur c\'est produite  </h2><p>'.$_SESSION['login_error'].'</p>' : '';  ?>
		</div>
