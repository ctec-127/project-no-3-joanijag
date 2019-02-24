<?php // Filename: display-records.php
#$pageTitle declared set in the header.inc
$pageTitle = "Record Management";
require 'inc/layout/header.inc.php'; 
?>
<!-- #displays records -->
<!-- #The real magic happend in display/content.inc -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
        <?php require "inc/display/content.inc.php"; ?>
        </div>
    </div> <!-- end row -->
</div> <!-- end container -->
<?php require 'inc/layout/footer.inc.php'; ?>