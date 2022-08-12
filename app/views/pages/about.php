<?php require APPROOT . '/views/inc/head.php'?>
<?php require APPROOT . '/views/inc/navbar.php'?>

   <div class="container mt-3">
      <h1 class=""><?php echo $data['title'] ?></h1>
      <p class="lead"><?php echo $data['description'] ?></p>

      <small>Version: <strong><?php echo APPVERSION; ?></strong></small>
   </div>

<?php require APPROOT . '/views/inc/footer.php'?>