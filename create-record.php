<?php // Filename: create-record.php
#title for the header
$pageTitle = "Create Record";
#header  
require 'inc/layout/header.inc.php'; 
?>
<!-- #Pionts to create includes files. creates a form and functionality for creating a new db record.  -->
<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1>Create a New Record</h1>
			<?php require __DIR__ .'/inc/create/content.inc.php'; ?>
			<?php require __DIR__ .'/inc/shared/form.inc.php' ?>
		</div>
    </div>
</div>
<!-- #footer -->
<?php require 'inc/layout/footer.inc.php'; ?>