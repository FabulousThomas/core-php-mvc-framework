<?php require APPROOT . '/views/inc/head.php'?>
<?php require APPROOT . '/views/inc/navbar.php'?>

<div class="container">
<div class="jumbotron jumbotron-fluid py-2 text-center">
   <div class="container">
      <h1 class="text-uppercase"><?php echo $data['title'] ?></h1>
      <p class="lead mb-2"><?php echo $data['description'] ?></p>
   </div>
</div>
</div>

<?php require APPROOT . '/views/inc/footer.php'?>