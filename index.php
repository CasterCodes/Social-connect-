<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  ?>
  <title>Connect | Home</title>
  </head>
  <?php
  $user = new User();
//  Init vars
   $nameErr = $emailErr = $passErr = $passConfirmErr = '';
   $data = [];
   $data['userName'] =  $data['userEmail']  = $data['userPassword'] =  $data['userCpassword'] ='';
   if(isset($_POST['reg_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $data['userName'] = trim($_POST['name']);
    $data['userEmail'] = trim($_POST['email']);
    $data['userPassword'] = trim($_POST['password']);
    $data['userCpassword'] = trim($_POST['cpassword']);
    //validate name
    if(empty($data['userName'])){
         $nameErr = 'Please enter your name';
    }
    //validate email
    if(empty($data['userEmail'])){
         $emailErr = "Please enter your email";
    }elseif($user->rowCountEmail($data['userEmail']) > 0){
        //to check if the email exists
        $emailErr = 'Email already taken';
    }elseif(!filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)){
        // validate email
        $emailErr = 'Please enter a valid email';
    }
    //validate password
    if(empty( $data['userPassword'])){
          $passErr = 'Please enter your password';
    }elseif(strlen($data['userPassword']) < 6){
          $passErr = 'Password must be at least 6 characters';
    }
    //validate confirm password
    if(empty($data['userCpassword'])){
        $passConfirmErr = 'Please confirm your password';  
    }else {
        if( $data['userPassword'] !== $data['userCpassword'] ){
            $passConfirmErr = 'Passwords dont match';  
        }
    }
   // make sure all the errors are empty
    if(empty($nameErr) && empty($emailErr) && empty($passErr) && empty($passConfirmErr)){
        //hash password
          $data['userPassword'] = password_hash($data['userPassword'], PASSWORD_BCRYPT);
          if($user->insertUser($data)){
                header('location:login.php?success=registration');
          }else{
            header('location:index.php?error=registration');
          }
    }
    
}
?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
?>
    <section class="banner">
        <div class="banner-overlay">
            <div class="banner-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-7 d-none d-md-block">
                            <div class="d-flex jusfify-content-center flex-column">
                                <h1 class="display-4 heading-1">Connecting Developers</h1>
                                <div class="d-flex flex-row">
                                    <div class="p-3 align-self-start">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="p-3 align-self-end lead">
                                        Create a developer profile/portfolio
                                    </div>
                                </div>
                                <div class="d-flex flex-row">
                                    <div class="p-3 align-self-start lead">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="p-3 align-self-end lead">
                                        Share projets and posts
                                    </div>
                                </div>
                                <div class="d-flex flex-row">
                                    <div class="p-3 align-self-start lead">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="p-3 align-self-end lead">
                                        Get help from other developers
                                    </div>
                                </div>

                                <a href="developers.php" class='btn button-one'>Developers</a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg-5 register ">
                            <div class="container">
                                <div class="d-flex justify-content-center flex-column">
                                    <div class="card px-2 bg-primary-color ">
                                        <div class="card-body">
                                            <h1 class="dispay-4">Sign Up</h1>
                                            <div class="d-flex flex-row jusfify-content-center text-center">
                                                <i class="fas fa-user mr-2 mt-1"></i>
                                                <p class='text-capitilize mr-2'>Create your Account</p>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name='name' value = "<?php $data['userName'];?>"
                                                        placeholder="Name">
                                                    <span class="invalid text-danger"><small><?php echo $nameErr ;?></small></span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name='email'
                                                        placeholder="Email Address">
                                                        <span class="invalid text-danger"><small><?php echo $emailErr ;?></small></span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name='password'
                                                        placeholder="Your password">
                                                        <span class="invalid text-danger"><small><?php echo $passErr ;?></small></span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name='cpassword'
                                                        placeholder="Confirm your password">
                                                        <span class="invalid text-danger"><small><?php echo $passConfirmErr;?></small></span>
                                                </div>
                                                <input type="submit" value='Sign Up' name='reg_submit'
                                                    class='btn btn-secondary signup-btn'>
                                                <p class="mt-3">Already have an account ? <a href="login.php"
                                                        class='signup-a'>Login</a>
                                                </p>

                                        </div>
                                    </div>


                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    
    <?php include_once 'includes/footer.php';?>