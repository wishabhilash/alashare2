	<?php include_once("home.php") ?>

<?php startblock('title') ?>
Edit Profile
<?php endblock() ?>

<?php startblock('extrahead') ?>
	<?php startblock('css') ?>
		<?php superblock() ?>
		<link type="text/css" rel="stylesheet" href="media/css/login.css" />
		<link type="text/css" rel="stylesheet" href="media/css/home.css" />
		<link type="text/css" rel="stylesheet" href="media/css/profile.css" />
	<?php endblock() ?>
<?php endblock() ?>

<?php startblock('body') ?>
	<?php startblock('body_head') ?>
		<?php superblock() ?>
	<?php endblock() ?>
	
<div>
	<!--<div id="id-top-gap"></div>
	<div>
		<div id="profile-pic" align="center"><img src=<?php echo $profile_pic ?> /></div>
		<form action="upload" method="POST" enctype="multipart/form-data">
			<div id="id-upload-bar" align="center">
				<input id="id-file-input" type="file" name="profile-pic" />
				<input id="id-text-input" type="text" name="" value="click here"/>
				<input id="id-submit" type="submit" name="profile-pic-submit" value="Upload"/>
			</div>
		</form>
	</div>-->
	
	<div style="clear:both;"></div>
	<div id="id-top-gap"></div>
	<div align="center">
		<div class="clearer" align="center">
			<span>Register Profile</span>
		</div>
		<br />
		<form action="register_profile" method="POST">
			<table summary="" >
				
				<tr>
					<td><label for="">First Name:</label></td>
					<td><input id="" type="text" name="profile-fname" class="signup-input"  /></td>
				</tr>
				<tr><td></td><td class="errorlist"><?php if(isset($errorlist[0])) echo $errorlist[0] ?></td></tr>
				<tr>
					<td><label for="">Last Name:</label></td>
					<td><input id="" type="text" name="profile-lname" class="signup-input"  /></td>
				</tr>
				<tr><td></td><td class="errorlist"><?php if(isset($errorlist[1])) echo $errorlist[1] ?></td></tr>
				<tr>
					<td><label for="">Phone:</label></td>
					<td><input id="" type="text" name="profile-phone" class="signup-input"  /></td>
				</tr>
				<tr>
					<td><label for="">Address:</label></td>
					<td><input id="" type="text" name="profile-address" class="signup-input" /></td>
				</tr>
				<tr>
					<td><label for="">City:</label></td>
					<td><input id="" type="text" name="profile-city" class="signup-input" /></td>
				</tr>
				<tr>
					<td><label for="">State:</label></td>
					<td><input id="" type="text" name="profile-state" class="signup-input" /></td>
				</tr>
				<tr align="right">
					<td colspan="2"><input id="id-update-input" type="submit" name="profile-update-input" value="Update" class="signup-input" /></td>
				</tr>
			</table>
		</form>
	</div>
	<br />
</div>
<?php endblock() ?>
