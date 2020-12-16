<?php
  include 'config/init.php'; 
  include_once 'includes/header.php';
  $users = new User();
  ?>
  <title>Connect | Developers</title>
  </head>
  <?php
if(isset($_POST['search']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
     $search = $_POST['developer'];
     if(count((array)$users->getUserByUserName($search)) > 0){
            header('location:developers.php?search=true&d='.$search);
            exit();
     }else{
        header('location:developers.php?search=false');
        exit();
     }
     
     var_dump();
}
?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
?>
    <section class="developers">
        <div class="container">
         <?php if(isset($_GET['search']) && $_GET['search'] === 'true'):?>
            <h1>Developers</h1>
            <div class="d-flex flex-row jusfify-content-center text-center">
                <p class='text-capitilize mr-2'>These are the developers we found</p>
            </div>
            <div class="justify-content-center">
                <?php  $usersSearch = $users->getUserByUserName($_GET['d']);?>
                 <?php foreach($usersSearch as $user):?>
                    <div class="jumbotron mt-4">
                    <div class="row">
                        <div class="col-md-7 col-lg-9 col-sm-12">
                            <div class="d-flex justify-content-start flex-md-row  flex-column">
                                <div class="align-self-start mr-4 p-0">
                                    <div class="align-self-start mr-4 p-0 " >
                                        <?php if($user->uploaded === 'yes'):?>
                                           <img src='uploads/<?php echo $user->userImage;?>' alt="" class='profile-image ' >
                                        <?php else:?>
                                           <img src="uploads/face.jpeg" class="profile-image img-fluid " alt="">
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="align-self-start mr-4 mt-2">
                                    <h3 class='developer'><?php echo $user->userName?></h3>
                                    <p>Developer at <?php echo $user->userCompany;?></p>
                                    <p><?php echo $user->userLocation;?></p>
                                    <a href="profile.php?user-id=<?php echo $user->userId;?>" class='btn button-one profile-btn'>View Profile</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5 col-lg-3 lang mt-2 col-sm-12">
                             <?php 
                                  $skills = explode(',' , $user->userSkills);
                             ?>
                             <?php if(count($skills) === 1):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo $skills[0];?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 1):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo $skills[0];?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 2):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[0]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[1]);?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 3):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[0]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[1]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[2]);?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 4):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[0]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[1]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[2]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[3]);?>
                                        </div>
                               </div>
                             <?php endif;?>
                        </div>
                    </div>
                </div>
                 <?php endforeach;?>
            </div>
         <?php else:?>
            <h1>Developers</h1>
            <div class="d-flex flex-row jusfify-content-center text-center">
                <i class="fas fa-user mr-2 mt-1"></i>
                <p class='text-capitilize mr-2'>Connect with other developers</p>
            </div>
            <div class="error">
              <?php if(isset($_GET['search'])):?>
                         <?php if($_GET['search'] === 'false'):?>
                                 <div class="alert alert-danger alert-dismissible fade show py-0">
                                        <p class="pt-3">Sorry there is no user by that name</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>  
               <?php endif;?>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>
                <div class="form-group search-developer">
                    <input type="text" class='form-control' placeholder="Search by username" name='developer'> 
                    <button type='submit' class='btn submit-search button-one' name='search'>Search</button>
                </div>
            </form>
            <div class="justify-content-center">
                 <?php foreach($users->getUser() as $user):?>
                    <div class="jumbotron mt-4">
                    <div class="row">
                        <div class="col-md-7 col-lg-9 col-sm-12">
                            <div class="d-flex justify-content-start flex-md-row  flex-column">
                                <div class="align-self-start mr-4 p-0">
                                    <div class="align-self-start mr-4 p-0 " >
                                        <?php if($user->uploaded === 'yes'):?>
                                           <img src='uploads/<?php echo $user->userImage;?>' alt="" class='profile-image ' >
                                        <?php else:?>
                                           <img src="uploads/face.jpeg" class="profile-image img-fluid " alt="">
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="align-self-start mr-4 mt-2">
                                    <h3 class='developer'><?php echo $user->userName?></h3>
                                    <p>Developer at <?php echo $user->userCompany;?></p>
                                    <p><?php echo $user->userLocation;?></p>
                                    <a href="profile.php?user-id=<?php echo $user->userId;?>" class='btn button-one profile-btn'>View Profile</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5 col-lg-3 lang mt-2 col-sm-12">
                             <?php 
                                  $skills = explode(',' , $user->userSkills);
                             ?>
                             <?php if(count($skills) === 1):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo $skills[0];?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 1):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo $skills[0];?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 2):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[0]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[1]);?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 3):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[0]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[1]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[2]);?>
                                        </div>
                               </div>
                             <?php endif;?>
                             <?php if(count($skills) === 4):?>
                                <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[0]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[1]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[2]);?>
                                        </div>
                               </div>
                               <div class="d-flex jusifty-content-start flex-row">
                                        <div class="p-2 align-self-start">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="p-2 align-self-end">
                                            <?php echo strtoupper($skills[3]);?>
                                        </div>
                               </div>
                             <?php endif;?>
                        </div>
                    </div>
                </div>
                 <?php endforeach;?>
            </div>
        </div>
     <?php endif;?>
    </section>
    <?php include_once 'includes/footer.php';?>