
<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  ?>
  <title>Connect | Dashboard</title>
  </head>
  <?php
  if(!isset($_SESSION['id'])){
        header('location:index.php');
  }
  $userObj = new User();
  $userDetails = $userObj->getUserprofileById($_SESSION['id']);
  $educations = new Education();
  $experiences = new Experience();

?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
  
?>
<?php
 $picErr = '';
 function unlinkImage(){
        $fileName = 'uploads/profile'.$_SESSION['id'].'*';
        $fileInfo = glob($fileName);
        $filext = explode('.',$fileInfo[0]);
        $fileactualext =  end($filext);
        $deletedPhoto = 'uploads/profile'.$_SESSION['id'].'.'.$fileactualext;
        unlink($deletedPhoto);
 }
 if(isset($_POST['del_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
     if(count((array)$userDetails) === 15){
        unlinkImage();
        $data = [];
        $data['userImage'] = '';
        $data['uploaded'] = 'no';
        if($userObj->uploadUserProfile($data, $_SESSION['id'])){
             header('Location:dashboard.php?success=pic-deleted'); 
        }else{
             header('Location:dashboard.php?success=pic-error');   
        }
         
     }else{
        $picErr = 'You have not updated any Image';
     }
   
 }
 if(isset($_POST['pic_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
     //check if the user has a profile
    if(count((array)$userDetails) > 0){
        $file = $_FILES['file'] ;
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileTempName = $file['tmp_name'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = ['png','jpg','jpeg'];
        if(in_array($fileActualExt,$allowed)){
               if($fileError === 0){
                   if($fileSize < 1000000){
                           $fileNewName = 'profile'.$_SESSION['id']. '.'. $fileActualExt;
                           $fileDestination = 'uploads/'.$fileNewName;
                           $data = [];
                           $data['userImage'] = $fileNewName;
                           $data['uploaded'] = 'yes';
                           //remove image if it exists in uploads
                           unlinkImage();
                           if($userObj->uploadUserProfile($data, $_SESSION['id'])){
                                 if(move_uploaded_file($fileTempName , $fileDestination)){
                                        header('Location:dashboard.php?success=pic-added');
                                 }else{
                                    header('Location:dashboard.php?success=pic-error');   
                                 }
                           }else{
                              header('Location:dashboard.php?success=pic-error');   
                           }
                          
                   }else{
                         $picErr ='File too big';
                   }

               }else{
                    $picErr = 'Error uploading picture';
               }
        }else{
            $picErr = 'Invalid file type';
        }
    }else{
        $picErr = 'Please edit your profile first';
    } 
 }

 ?>
    <section class="dashboard">
        <div class="container">
            <h1 class="dispay-4 primary-color">Dashboard</h1>
            <div class="d-flex flex-row jusfify-content-center signin">
                <i class="fas fa-user mr-2 mt-1"></i>
                <p class='text-capitilize mr-2'>Welcome <?php echo $_SESSION['userName'];?></p>
            </div>
            <div class="dashboard- w-75 row" >
                <div class="col-lg-8 col-md-7 ">
                            <!-- Check if user has already updated profile info -->
                        <?php if(count((array)$userDetails) === 15):?>
                            <!-- Check if user has uploaded a photo -->
                            <?php if($userDetails->uploaded === 'yes'):?>
                                <img src='uploads/<?php echo $userDetails->userImage;?>' class="img-fluid rounded" alt="" style="max-width:75%;" >
                            <?php else:?>
                                <img src="uploads/face.jpeg" class="img-fluid rounded" alt="" style="max-width:75%;">
                            <?php endif;?>
                        <?php else:?>
                            <img src="uploads/face.jpeg" class="img-fluid rounded" alt="" style="max-width:75%;">
                        <?php endif;?>
                        <span class="invalid text-danger d-block"><small><?php echo $picErr;?></small></span>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="d-flex flex-column">
                        <div class="mt-3">
                                <div class="form-group">
                                     <button class="image-upload btn btn-info">Choose Image</button>
                                </div>
                        </div>  
                        <div class="">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="POST"  enctype = 'multipart/form-data'>
                                    <div class="form-group">
                                        <input type="file"  class='image-file d-none' name='file'>
                                        <button  type='submit'class="img-btn btn btn-info " name='pic_submit'>Change Image</button>
                                    </div>
                                </form>
                        </div>
                        <div class="">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST' enctype = 'multipart/form-data'>
                                   <div class="form-group">
                                       <button type='submit' name='del_submit' class='btn btn-danger' >Delete Profile</button>
                                   </div>
                            </form>
                        </div>
                  </div>
                </div>
            </div>
            <div class="error-success mt-2">
               <?php if(isset($_GET['success'])):?>
                         <?php if($_GET['success'] === 'add-experience'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Experince was added successfully</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                         <?php if($_GET['success'] === 'add-profile'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Profile edited successfully</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                         <?php if($_GET['success'] === 'add-education'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Education was added successfully</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                         <?php if($_GET['success'] === 'ex-delete'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Experience deleted successfully</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                         <?php if($_GET['success'] === 'edu-delete'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Education deleted successfully</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                         <?php if($_GET['success'] === 'pic-added'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Image uploaded successfully</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                         <?php if($_GET['success'] === 'pic-deleted'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Image deleted successfully</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                         <?php if($_GET['success'] === 'pic-error'):?>
                                 <div class="alert alert-success alert-dismissible fade show py-0">
                                        <p class="pt-3">Error uploading image</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>
                        
               <?php endif;?>
                
            </div>
            <div class="d-flex flex-sm-row flex-column text-center">
                <a href='edit.php' class="btn btn-secondary px-5  mr-2 button-three mt-2">
                    <div class="d-flex flex-row mt-3">
                        <i class="fas fa-user mr-2 mt-1 primary-color"></i>
                        <p class='text-capitilize mr-2'>Edit Profile</p>
                    </div>
                </a>
                <a href='experience.php' class="btn btn-secondary px-5 mr-2 button-three  mt-2">
                    <div class="d-flex flex-row mt-3">
                        <i class="fas fa-user mr-2 mt-1 primary-color"></i>
                        <p class='text-capitilize mr-2'>Add Experience</p>
                    </div>
                </a>
                <a href='education.php' class="btn btn-secondary px-5  mr-2 button-three  mt-2">
                    <div class="d-flex flex-row mt-3">
                        <i class="fas fa-user mr-2 mt-1 primary-color"></i>
                        <p class='text-capitilize mr-2'>Add Education</p>
                    </div>
                </a>
            </div>
            <div class="justify-content-center">
                <h2 class="heading-one">Experience Credentials</h2>
                <table class="table table-borderless table-responsive-sm">
                    <thead class='bg-secondary'>
                        <tr>
                            <th scope="col lead">Company</th>
                            <th scope="col">Title</th>
                            <th scope="col">Years</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    <?php
                        
                    ?>
                    <?php foreach($experiences->getExperienceById($_SESSION['id']) as $experience):?>
                        <tr class='py-2'>
                            <td><?php echo $experience->companyName;?></td>
                            <td><?php echo $experience->jobTitle;?></td>
                            <td><?php echo $experience->fromDate;?> - <?php 
                             if($experience->currentJob === 'yes'){
                                  echo 'To Date';
                             }else{
                                echo $experience->toDate;
                             } ?></td>
                            <td><button class="btn btn-danger"><a href="delete.php?ex-deleteId=<?php echo $experience->experienceId; ?>" class='text-white'>Delete</a></button></td>
                        </tr>
                    <?php endforeach ;?>
                    </tbody>
                </table>
            </div>
            <div class="justify-content-center">
                <h2 class="heading-one">Education Credentials</h2>
                <table class="table table-borderless table-responsive-sm" >
                    <thead class='bg-secondary'>
                        <tr>
                            <th scope="col lead">School</th>
                            <th scope="col">Degree</th>
                            <th scope="col">Years</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($educations->getEducationById($_SESSION['id']) as $education):?>
                        <tr class='py-2'>
                            <td><?php echo $education->school;?></td>
                            <td><?php echo $education->schoolLevel;?></td>
                            <td><?php echo $education->fromDate;?> - <?php 
                             if($education->currentEducation === 'yes'){
                                  echo 'To Date';
                             }else{
                                echo $education->toDate;
                             } ?></td>
                           <td><button class="btn btn-danger"><a href="delete.php?edu-deleteId=<?php echo $education->educationId; ?>" class='text-white'>Delete</a></button></td>
                        </tr>
                    <?php endforeach ;?>
                    </tbody>
                </table>
            </div>
            <div class="py-4">
                        <a href="delete.php?user=delete-account" class=""> <button class="btn btn-danger"> <i class="fas fa-user mr-1"></i>Delete Account</button></a>
            
                      
            
            </div>

        </div>


        </div>
    </section>


    <?php include_once 'includes/footer.php';?>