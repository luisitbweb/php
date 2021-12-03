<html>
	<head>
		<title>PHP Version</title>
	</head>
	<body>
		<ul>
			<li>
				<strong>PHP version:</strong> <?php echo phpversion(); ?>
			</li>
			<li>
				<strong>Path to php.ini:</strong>
					<?php
						$inipath = php_ini_loaded_file();
						echo empty($inipath) ? 'No php.ini loaded' : $inipath;
					?>
			</li>
			<li>
				<strong>Physical script path:</strong> <?php echo __FILE__ ?>
			</li>
		</ul>
	</body>
</html>