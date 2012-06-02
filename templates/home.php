<?php include_once("base.php") ?>

<?php startblock('title') ?>
Home Page
<?php endblock() ?>

<?php startblock('extrahead') ?>
	<?php startblock('css') ?>
		<link rel="stylesheet" href="media/css/home.css" />
		<link rel="stylesheet" href="media/css/demos.css">
		<link rel="stylesheet" href="media/js/widgets/themes/base/jquery.ui.all.css">
		<style>
			.class_tab, .class_tab a { width:100px; height: 75px; text-align:center;}
			.class_tab a { margin-top:5px; }
			.ui-widget-header { background-image : url(); background:#52b4cd}
			.user_list {  -moz-border-radius: 5px; -webkit-border-radius:5px; border-radius:5px; -khtml-border-radius:5px; }
			.user_list span { font-size:16px; }
			.user_list #name { font-size:16px; }
			#id-data-meter { position:absolute; margin:50px 0 0 700px; font-size:20px; font-weight:bold; color:#54A2BB; text-shadow:0px 1px 2px #000; background:#fff;}
			#id-data-meter { border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; -moz-border-radius:5px; box-shadow:inset 0 0 5px #000; -webkit-box-shadow:inset 0 0 5px #000;}
			#id-data-meter span { padding:20px; }
		</style>
	<?php endblock() ?>
	
	
	<?php startblock('jslinks') ?>
		<script src="media/js/jquery-1.6.2.js"></script>
		<script src="media/js/external/jquery.bgiframe-2.1.2.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.core.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.widget.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.mouse.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.tabs.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.draggable.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.position.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.resizable.js"></script>
		<script src="media/js/widgets/ui/jquery.ui.dialog.js"></script>
	<?php endblock() ?>
	
	
	<?php startblock('js') ?>
	<script>
	
	//Fetch self files
	$(function(){
		$("#id_user_data").load('media/ajax_scripts/fetch_files_db.php');
	});
	
	//Dialogs
	$(function(){
		$("#id-dialog-share").delegate('#dialog-selectable', 'click', function(){
			var item_id = $("#id-dialog-share > #dialog-data-id").attr('title');
			$('li',this).toggleClass('ui-state-default').toggleClass('dialog-selectable-selected');
			var html = $(this).html();
			if($('li',this).hasClass('dialog-selectable-selected'))
			{
				
				var user_id = $('#dialog-user-id', this).attr('title');
				$(this).load('media/ajax_scripts/share_data.php',{'item_id':item_id, 'user_id':user_id, 'html':html});
			}
			else
			{
				var user_id = $('#dialog-user-id', this).attr('title');
				$(this).load('media/ajax_scripts/unshare_data.php',{'item_id':item_id, 'user_id':user_id, 'html':html});
			}
		});
	});
	
	//data-list workings
	$(function(){
		$("body").delegate("#data-list", "hover", function(){
			$("#data-list-options", this).toggleClass("optionShow");
			var filename = $("#data-list-options", this).attr('name');
			$("#data-list-options > #id-data-list-delete", this).click(function(){
				var self = $(this);
				$("#id-dialog-delete-confirm").dialog({
					modal:true,
					resizable:false,
					buttons: {
						"Delete": function(){
							$(self).load('media/ajax_scripts/delete_file.php', {'filename':filename});
							$("#id_user_data").load('media/ajax_scripts/fetch_files_db.php');
							$(this).dialog("close");
						},
						Cancel: function() {
							$(this).dialog("close");
						}
					}
				});
			});
			
			var item_id = $("#data-list-options > #data-id", this).attr('title');
			$("#data-list-options > a:eq(1)", this).click(function(){
				$("#id-dialog-share").load('media/ajax_scripts/share_dialog_content', {'item_id' : item_id});
				$("#id-dialog-share").dialog({
					modal:true,
					height:500,
					width:500
				});
			});
		});
	});
	
	$(function(){
		$("body").delegate("#shared-data-list", "hover", function(){
			$("#shared-data-list-options", this).toggleClass("optionShow");
		});
	});
	
		
	//Make tabs
	$(function() {
		$( "#tabs" ).tabs();
	});
	
	//Fetch users
	<?php if($ajax_call == 0){ ?>
	$(function(){
		$("#tab_2").click(function(){
			$("#id_user_area").load('media/ajax_scripts/fetch_users.php');
			<?php $ajax_call++ ?>
		})
	});
	<?php } ?>
	
	//Fetch shared files
	<?php if($ajax_call2 == 0){ ?>
	$(function(){
		$("#tab_3").click(function(){
			$("#id_user_shared").load('media/ajax_scripts/fetch_files_shared.php');
			<?php $ajax_call2++ ?>
		})
	});
	<?php } ?>
	
	
	
	
	//Fake root for upload
	$(function(){
		$("#id-file-input").change(function(){
			$("#id-text-input").val($(this).val());
		});
	});
	
	//Detects brower to set margin to upload.
	if($.browser.webkit)
	{
		$("#id-file-input").attr('style',"margin-left:-55px;");
	}
	
	</script>
	<?php endblock() ?>
	
	<?php superblock() ?>
<?php endblock() ?>


<?php startblock('body') ?>

	<?php startblock('body_head') ?>
		<div id="id_header" style="height:100px;">
			<div id="id_logo"><a href="home"><img src="media/images/logo.png"/></a></div>
			<div id="id-static-links" align="right">
				<span id="id-welcome-text">Welcome</span>
				<span id="id-profile"><a href="profile">
					<?php
						$id = $_SESSION['id'];
						$name = mysql_query("select first_name, last_name from user_profile where id='$id';");
						if(mysql_num_rows($name) > 0)
						{
							$name = mysql_fetch_object($name);
							echo $name -> first_name." ".$name -> last_name;
						}
						else
							echo "";
					?>
				</a></span>
				<span id="id-logout"><a href="logout">Logout</a></span>
			</div>
			<div id="id-data-meter">
				<span>Used: <?php if(isset($dir_size) && isset($user_quota)) echo $dir_size."/".$user_quota."MB"; ?></span>
			</div>
		</div>
	<?php endblock() ?>

<div id="id_content">
	
<div id="tabs">
	<ul>
		<li class="class_tab"><a id="tab_1" href="#tabs-1"><img src="media/images/home.png" /><div>My Files</div></a></li>
		<li class="class_tab"><a id="tab_2" href="#tabs-2"><img src="media/images/users.png" /><div>Users</div></a></li>
		<li class="class_tab"><a id="tab_3" href="#tabs-3"><img src="media/images/download.png" /><div>Shared with me</div></a></li>
	</ul>
	
	<div id="tabs-1">
		<div id="upload-div">
			<form action="upload" method="POST" enctype="multipart/form-data">
				<div id="id-upload-bar">
						<input id="id-file-input" type="file" name="file" />
						<input id="id-text-input" type="text" name="" value="click here"/>
						<input id="id-submit" type="submit" value="Upload" />
				</div>
			</form>
		</div>
		<div id="id_user_data">
			<!-- THIS SHOULD BE LEFT BLANK -->
		</div>
	</div>
	
	<div id="tabs-2">
		<div id="id_user_area">
			<!-- THIS SHOULD BE LEFT BLANK -->
			<img src="media/images/loading.gif">
		</div>
	</div>
	
	<div id="id-dialog-share" style="display:none;" ><img src="media/images/loading.gif"></div>
	<div id="id-dialog-delete-confirm" style="display:none;" >Sure you want to delete this item?</div>
	
	
	<div id="tabs-3">
		<div id="id_user_shared">
			<!-- THIS SHOULD BE LEFT BLANK -->
		</div>
	</div>
</div>

	

</div>
<div id="id_footer">
	
</div>


<?php endblock() ?>
