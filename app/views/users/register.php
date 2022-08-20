<?php require APPROOT . '/views/inc/head.php' ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>

<div class="container mt-3">
   <div class="jumbotron jumbotron-fluid py-2 text-center">
      <h1 class="text-uppercase mb-0"><?php echo $data['title'] ?></h1>
      <p class="lead mb-0"><?php echo $data['description'] ?></p>
   </div>

   <div class="card card-body px-0 col-lg-6 col-md-12 m-auto shadow border-0 rounded-0">
      <div class="container">
         <form action="<?php echo URLROOT; ?>/users/register" method="POST" enctype="multipart/form-data">

            <div class="form-group mb-2">
               <label class="mb-0" for="name">Name</label>
               <input type="text" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?> rounded-0" name="name" placeholder="Enter Full Name" value="<?php echo $data['name'] ?>">
               <small class="invalid-feedback"><?php echo $data['name_err'] ?></small>
            </div>
            <div class="form-group mb-2">
               <label class="mb-0" for="username">Username</label>
               <input type="text" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?> rounded-0" name="username" placeholder="Enter Username" value="<?php echo $data['username'] ?>">
               <small class="invalid-feedback"><?php echo $data['username_err'] ?></small>
            </div>
            <div class="form-group mb-2">
               <label class="mb-0" for="email">Email</label>
               <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?> rounded-0" name="email" placeholder="Enter Email" value="<?php echo $data['email'] ?>">
               <small class="invalid-feedback"><?php echo $data['email_err'] ?></small>
            </div>
            <div class="form-group mb-2">
               <label class="mb-0" for="password">Password</label>
               <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?> rounded-0" name="password" placeholder="Enter Password" value="<?php echo $data['password'] ?>">
               <small class="invalid-feedback"><?php echo $data['password_err'] ?></small>
            </div>
            <div class="form-group row">
               <div class="col">
                  <input type="submit" value="Register" class="btn btn-primary form-control">
               </div>
               <div class="col">
                  <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light form-control">Or Login</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<?php require APPROOT . '/views/inc/footer.php' ?>