<?php
include 'includes/class.php';
$jedit = new JsonEdit();

// initialize the variable for the JSON file on the Server
$file = "json_file.json";

// check for POST and write to the file
if( !empty($_POST['config']) ){

	$jedit->writeFile($file);

}

// call the file, replace config and decode it
$site_config = file_get_contents($file);
$json = json_decode($site_config, true);

?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Edit JSON with a Simple JSON Editor GUI">
	<title>JSONEditor - A Simple JSON Editor</title>

	<!-- CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">

</head>
<body>

	<div class="container content">

		<h1>JSONEditor - A Simple JSON Editor</h1>
		<p>A simple editor to manage a JSON file located on the server.  Intended for shallow JSON structures (object, array, pair). You'll want to make sure your file: <?php echo $file; ?> is writable. Best practices would be to secure this script and file on your web server.</p>

		<div class="row col-xs-12">

			<?php

			if( !empty($_POST['config']) ){

				echo "<div class='alert alert-success'>Config Saved!</div>";

			}
			?>

			<form id="adminForm" class="form-horizontal" method="post" action="">
				<?php

				// make tabs
				$jedit->makeTabs($json);

				?>

				<div class="tab-content">

					<?php

					// build the tab content
					$jedit->tabContent($json);

					?>

				</div>

				<div id="configuration" class="collapse">
					<h1>Configuration</h1>
					<p>
						Edit this area if you want to add more properties.
						Copy from the last block of code in the array (from comma to the last curly brace ( ,{ ... } ).
						The comma is required BUT there CAN NOT BE A COMMA after the LAST curly brace or bracket in the group.
						After making any edits you need to click the save button in order for your changes to take place.
						Make sure all images referenced in this file are in the appropriate folders.
					</p>
					<div class='form-group well'>
						<textarea rows='30' class='form-control' id='config' name='config'><?php echo $site_config; ?></textarea>
					</div>
				</div>

				<div class='row text-right'>
					<button type="button" class="btn btn-default pull-left btn-config collapsed" data-toggle="collapse" data-target="#configuration"></button>
					<button type='submit' class='btn btn-success'>SAVE SITE CONFIGURATION</button>
				</div>

			</form>
		</div>
	</div>

	<!-- JavaScript -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/scripts.js"></script>

</body>
</html>
