<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  ?>
  <title>Connect | Login</title>
  </head>
  <?php
  //init vars
  $email = $password = '';
  $emailErr = $passwordErr = '';
   if(isset($_POST['log_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        //validate email
        if(empty($email)){
             $emailErr = 'Please enter your email';
        }
        //validate password
        if(empty($password)){
             $passwordErr = 'Please enter your password';
        }
        //make sure all the error are empty
        if(empty($emailErr) && empty($passwordErr)){
               $user = new User();
               if($user->rowCountEmail($email) === 1){
                    $userDetails = $user->selectUserByEmail($email);
                    $userPassword = $userDetails->userPassword;
                    $userLoginId = $userDetails->userId;
                    $userName = $userDetails->userName;
                    if(password_verify($password, $userPassword)){
                          //login successfull
                          $_SESSION['id'] = $userLoginId;
                          $_SESSION['userName'] = $userName;
                          header('location:dashboard.php');
                    }else{
                         $passwordErr = 'Wrong Password';
                    }
               }else{
                $emailErr = 'No user with that email';
            }
        }
   }

?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
?>
    <section class="login">
        <div class="container">
            <h1 class="dispay-4">Sign In</h1>
            <div class="d-flex flex-row jusfify-content-center signin">
                <i class="fas fa-user mr-2 mt-1"></i>
                <p class='text-capitilize mr-2'>Sign into Your Account</p>
            </div>
            <div class="error">
              <?php if(isset($_GET['success'])):?>
                         <?php if($_GET['success'] === 'registration'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Registration was successfully, You can now login.</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>  
               <?php endif;?>
            </div>
           
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method='POST'>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Email Address" name='email'>
                    <span class="invalid text-danger"><small><?php echo $emailErr ;?></small></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg " placeholder="Password" name='password'>
                    <span class="invalid text-danger"><small><?php echo $passwordErr ;?></small></span>
                </div>
                <input type="submit" value='Login' class='btn btn-primary button-one' name='log_submit'>
                <p class="mt-3">Dont have an account ? <a href="index.php">Sign Up</a>
                </p>
            </form>
        </div>

    </section>


    <?php include_once 'includes/footer.php';?>