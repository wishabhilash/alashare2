<?php include('base.php') ?>


<?php startblock('extrahead') ?>
	<link type="text/css" rel="stylesheet" href="media/css/login.css" />
	<script src="media/js/jquery-1.6.2.js"></script>
	<script type="javascript">
		$(function(){
			$("#id-login-username").focus(function(){
				$(this).val('');
			});
		});
	</script>
	<style type="text/css">
		.errorlist { font-size:12px; color:#ADD8E6; text-align:center;}
		.input-label { font-size:16px; color:#ADD8E6;}
	</style>
<?php endblock() ?>



<?php startblock('body') ?>

<div id="id_body_header">
	<div id="id-logo">
		<img src="media/images/logo.png" />
	</div>
	
	<div id="id_signin_block">
		<form action="" method="POST">
			<table summary="signin_table">
				<tr>
					<td><input id="id-login-username" class="login-input" type="text" maxlength="200" name="username_login" value="username"/></td>
					<td><input id="id-login-password" class="login-input" type="password" maxlength="200" name="password_login" value="password" /></td>
					<td><input id="login-submit" type="submit" src="media/images/login.png" value="Log In" name="submit_login"></td>
				</tr>
			</table>
		</form>
		<div id="id-signin-error"><?php echo $message; ?></div>
	</div>
	
</div>
<div id="id_body_content">
	
	
	
	<div id="id-signup-block">
		<div class="clearer" align="center">
			<span>Register</span>
		</div>
		<br>
		<form action="" method="POST">
			<table summary="signup" >
				<tr>
					<td class="input-label">Username:</td><td><input class="signup-input" type="text" maxlength="200" name="username_signup" value="<?php if(isset($_POST['username_signup'])) echo $_POST['username_signup']; ?>" /></td>
				</tr>
				<tr class="errorlist">
					<td></td>
					<td class="errorlist"><?php if(isset($errorlist[0])) echo $errorlist[0]; ?></td>
				</tr>
				<tr>
					<td class="input-label">Password:</td><td><input class="signup-input" type="password" maxlength="200" name="password_signup" /></td>
				</tr>
				<tr class="errorlist">
					<td></td>
					<td class="errorlist"><?php if(isset($errorlist[1])) echo $errorlist[1]; ?></td>
				</tr>
				<tr>
					<td class="input-label">Confirm password:</td><td><input class="signup-input" type="password" maxlength="200" name="repassword_signup" /></td>
				</tr>
				<tr class="errorlist">
					<td></td>
					<td class="errorlist"><?php if(isset($errorlist[2])) echo $errorlist[2]; ?></td>
				</tr>
				<tr>
					<td class="input-label">E-mail:</td><td><input class="signup-input" type="text" maxlength="200" name="e-mail_signup"  value="<?php if(isset($_POST['e-mail_signup'])) echo $_POST['e-mail_signup'];?>" /></td>
				</tr>
				<tr>
					<td></td>
					<td class="errorlist" ><?php if(isset($errorlist[3])) echo $errorlist[3]; ?></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input id="id-signup-btn" class="signup-input" type="submit" value="Accept and Sign Up" name="submit_signup"/></td>
				</tr>
				
			</table>
		</form>
		<div class="clearer"></div>
	</div>

<!--<div id="id_vertical_ruler"></div>	-->
</div>

<div style="clear:both"></div>
<div id="id-footer" style="height:150px;"></div>
	
<?php endblock() ?>
