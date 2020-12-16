<?php
 include 'config/init.php';
 
 include_once 'includes/header.php';
 ?>
  <title>Connect | Delete User Account</title>
  </head>
  <?php
?>
<?php
 
 $userObj = new User();
 $educationObj = new Education();
 $postObj = new Post();
 $commentObj = new Comment();
 $experienceObj = new Experience();
if(isset($_SESSION['id'])){
     if(isset($_GET['ex-deleteId'])){
           $ex_deleteId =  $_GET['ex-deleteId'];

           if($experienceObj->deleteExperienceById($ex_deleteId)){
                 header('Location:dashboard.php?success=ex-delete');
           }
     }
     if(isset($_GET['edu-deleteId'])){
        $edu_deleteId =  $_GET['edu-deleteId'];
        if($education->deleteEducationById($edu_deleteId)){
              header('Location:dashboard.php?success=edu-delete');
        }
     }
     if(isset($_POST['keep-account']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
      header('Location:dashboard.php');
     } 
     if(isset($_POST['delete-account']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
          if($userObj->deleteUser($_SESSION['id'])){
                  if($userObj->deleteUserProfile($_SESSION['id'])){
                            if($commentObj->deleteComment($_SESSION['id'])){
                                    if($postObj->deletePost($_SESSION['id'])){
                                          if($educationObj->deleteuserEducationById($_SESSION['id'])){
                                                  if($experienceObj->deleteUserExperienceById($_SESSION['id'])){
                                                       session_unset();
                                                       session_destroy();
                                                       header('Location:index.php');
                                                       exit();
                                                  }
                                          }

                                    }
                            }
                        }
          }
     } 
}else{
      header('Location:index.php');
}
?>
<?php
  include_once 'includes/navigation.php';
?>
<div class="container mt-5 delete">
      <?php if(isset($_GET['user'])):?>
             <?php if($_GET['user'] === 'delete-account'):?>
                  <div class="jumbotron text-center">
                        <h2 class='text-center primary-color'>WE ARE SORRY TO SEE YOU LEAVE</h2>
                        <p class='text-center d-block'>A you sure you want to delete your account ?</p>
                        <p class='text-center d-block text-danger'><small>All your data will be deleted</small></p>
                        <div class="row">
                           <div class="col-md-6 mt-2">
                                 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>
                                       <button class="btn btn-danger d-block w-100" name='delete-account' type='submit'>DELETE</button>
                                 </form>
                           </div>
                           <div class="col-md-6 mt-2">
                                 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>
                                       <button class="btn w-100 button-one d-block" name='keep-account' type='submit'>KEEP ACCOUNT</button>
                                 </form>
                               
                           </div>
                        </div>
                  </div>
             <?php endif;?>
      <?php endif;?>
     
</div>
<?php include_once 'includes/footer.php';?>