<?php // Filename: header.inc.php ?>
<!-- the header for web pages -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- #$pageTitle is found in the header for each page of the site: create, display and search-record. -->
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
<!-- #required config.inc for $app_name, $app_version, $app_copyright located in the footer.
     #includes nav bar -->
     <!-- #added "functions.inc" to the header. -->
    <?php require 'inc/functions/functions.inc.php'; ?>
    <?php require 'inc/app/config.inc.php';?> 
    <?php require 'inc/layout/navbar.inc.php';?>