<?php // Filename: footer.inc.php ?>
<!-- footer for web pages. -->
<!-- the header has required config.inc for $app_name, $app_version, $app_copyright -->
<div class="row">
    <div class="col-lg-12">
        <p class="text-center mt-4"><?php echo '<span class="font-weight-bold">' . $app_name . ' - Version ' . $app_version . "</span><br>" . $app_copyright;?></p>
    </div>
</div>

<!-- jQuery -->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>