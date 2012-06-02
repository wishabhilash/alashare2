<?php include_once('base.php'); 
$domain = $_SERVER['HTTP_HOST'];
?>

<?php startblock('title') ?>
Login status
<?php endblock() ?>


<?php startblock('body') ?>
<h1>Your account has been activated.<br />Click <a href=<?php echo 'http://'.$domain.'/php/login';?>>here</a> to login.</h1>

<?php endblock() ?>
