<?php require APPROOT . '/views/inc/head.php'?>
<?php require APPROOT . '/views/inc/navbar.php'?>

   <div class="container mt-3">
      <h1 class=""><?= $data['title'] ?></h1>
      <p class="lead"><?= $data['description'] ?></p>

      <small>Version: <strong><?= APPVERSION; ?></strong></small>
   </div>

<?php require APPROOT . '/views/inc/footer.php'?>