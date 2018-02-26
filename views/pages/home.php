<div id="container">
	<h2>This is the home page for a basic MVC app with registration and email confirmation. This is work in progress...</h2>
	<div id="left_container">
	<p>&nbsp;</p>
	</div>
	<div id="right_container">
	<?php echo '<p' .' '. $success=true?'class="success"':'class="failure"'?>><?=$register_message?></p>
		<div id="register_container">
			<div class="main">
				<form class="form" method="post" action="?controller=home&action=index">
					<label>Name :</label>
					<input type="text" name="name" id="name">
					<label>Email :</label>
					<input type="text" name="email" id="email1">
					<label>Password :</label>
					<input type="password" name="password1" id="password1">
					<label>Confirm Password :</label>
					<input type="password" name="password2" id="password2">
					<input type="submit" name="register" id="register" value="Register">
				</form>
			</div>
		</div>
		<div id="login_div">
		<div class="login_message"><?php if (isset($login_message)) echo $login_message ?></div>
		<form method="post" action="#">
			<label>Email :</label>
			<input type="text" name="email" id="email">
			<label>Password :</label>
			<input type="password" name="password" id="password">
			<input type="submit" name="login" id="login" value="Login">
		</form>
		</div>
	</div>
</div>
