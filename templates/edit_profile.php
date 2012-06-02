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
	<div id="id-update-profile" align="center">
		<div class="clearer" align="center">
			<span>Update Profile</span>
		</div>
		<br />
		<form action="profile" method="POST">
			<table summary="" >
				
				<tr>
					<td><label for="">First Name:</label></td>
					<td><input id="" type="text" name="profile-fname" class="signup-input" value="<?php if(isset($userobj -> first_name)) { echo $userobj -> first_name; } else echo ""; ?>" /></td>
				</tr>
				<tr><td></td><td class="errorlist"><?php if(isset($errorlist[0])) echo $errorlist[0] ?></td></tr>
				<tr>
					<td><label for="">Last Name:</label></td>
					<td><input id="" type="text" name="profile-lname" class="signup-input" value="<?php if(isset($userobj -> last_name)) { echo $userobj -> last_name; } else echo ""; ?>" /></td>
				</tr>
				<tr><td></td><td class="errorlist"><?php if(isset($errorlist[1])) echo $errorlist[1] ?></td></tr>
				<tr>
					<td><label for="">Phone:</label></td>
					<td><input id="" type="text" name="profile-phone" class="signup-input" value="<?php if(isset($userobj -> phone)) { echo $userobj -> phone; } else echo ""; ?>" /></td>
				</tr>
				<tr>
					<td><label for="">Address:</label></td>
					<td><input id="" type="text" name="profile-address" class="signup-input" value="<?php if(isset($userobj -> address)) { echo $userobj -> address; } else echo ""; ?>" /></td>
				</tr>
				<tr>
					<td><label for="">City:</label></td>
					<td><input id="" type="text" name="profile-city" class="signup-input" value="<?php if(isset($userobj -> city)) { echo $userobj -> city; } else echo ""; ?>" /></td>
				</tr>
				<tr>
					<td><label for="">State:</label></td>
					<td><input id="" type="text" name="profile-state" class="signup-input" value="<?php if(isset($userobj -> state)) { echo $userobj -> state; } else echo ""; ?>" /></td>
				</tr>
				<tr align="right">
					<td colspan="2"><input id="id-update-input" type="submit" name="profile-update-input" value="Update" class="signup-input" /></td>
				</tr>
			</table>
		</form>
		<br />
	</div>
	<div id="id-top-gap"></div>
</div>
<?php endblock() ?>
