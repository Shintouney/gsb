<!DOCTYPE html>
<html lang="fr">
<?php include 'header.php'; ?>
<body>
    <div id="wrapper">
        <!-- Fixed navbar -->
        <?php
            include 'navbar.php';
        ?>
        <?=$content;?>
    </div>
    <?php include 'footer.php' ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/gsb.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <?php $js = "js/". $template .".js";
    if (file_exists($js)):?><script src="<?=$js?>"></script><?php endif; ?>
</body>
</html>