<?php $all_method =&get_instance(); ?>
<?php if(isset($_GET['m']) && !empty($_GET['m']) && isset($_GET['t']) && !empty($_GET['t'])){		
		$message = base64_decode($_GET['m']);
		$type = base64_decode($_GET['t']);
?>
		<h3 class="<?php echo $type; ?>"><?php echo $message; ?></h3>
<?php } ?>