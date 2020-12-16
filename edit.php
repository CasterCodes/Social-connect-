<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  ?>
  <title>Connect | Edit</title>
  </head>
  <?php
  //init var
  $professionErr = $skillErr =  $dev_bioErr = '';
  $data = [];
  $data['profession'] = $data['company'] = $data['website'] = $data['location'] = $data['skills']= $data['github'] = '';
  $data['dev_bio'] = $data['facebook'] = $data['twitter'] = $data['insta'] = $data['youtube'] = '';
  $userObj = new User();
  $user = $userObj->getUserprofileById($_SESSION['id']);
  if(count((array)$user) > 0){
        $data['profession'] = $user->userProfession;
        $data['company'] = $user->userCompany;
        $data['website'] = $user->userWebsite;
        $data['location'] = $user->userLocation;
        $data['skills'] = $user->userSkills;
        $data['github'] =  $user->userGithub;
        $data['dev_bio'] =  $user->userBio;
        $data['facebook'] = $user->userFacebook;
        $data['twitter'] = $user->userTwitter;
        $data['insta'] = $user->userInsta;
        $data['youtube'] = $user->userYoutube;
        if(isset($_POST['update_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data['profession'] = trim($_POST['profession']);
            $data['company'] = trim($_POST['company']);
            $data['website'] = trim($_POST['website']);
            $data['location'] = trim($_POST['location']);
            $data['skills'] = trim($_POST['skills']);
            $data['github'] = trim($_POST['github']);
            $data['dev_bio'] = trim($_POST['dev_bio']);
            $data['facebook'] = trim($_POST['facebook']);
            $data['twitter'] = trim($_POST['twitter']);
            $data['insta'] = trim($_POST['insta']);
            $data['youtube'] = trim($_POST['youtube']);
            $skillCount = explode(',', $data['skills']);
               //validate profession
               if(empty($data['profession'])){
               $professionErr = 'Please select your profession level';
               }
               //validate skills
               if(empty($data['skills'])){
               $skillErr = 'Please enter a list of your skills';
               }elseif(count($skillCount) > 4){
               $skillErr = 'Skill must not be more than four';  
               }
       
               //validate developer bio
               if(empty($data['dev_bio'] )){
               $dev_bioErr = 'Please provide a simple bio' ;
               }elseif(strlen($data['dev_bio']) < 45 ){
               $dev_bioErr = 'Your bio is too short';
               }
               if(empty($professionErr) && empty($skillErr) && empty($dev_bioErr)){
                   if($userObj->updateUserProfile($data, $_SESSION['id'],$_SESSION['id'])){
                       header('Location:dashboard.php?success=update-profile');
                   }else{
                       header('Location:edit.php?error=update-profile');
                   }
               }  
         }
  }else{
    if(isset($_POST['edit_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data['profession'] = trim($_POST['profession']);
        $data['company'] = trim($_POST['company']);
        $data['website'] = trim($_POST['website']);
        $data['location'] = trim($_POST['location']);
        $data['skills'] = trim($_POST['skills']);
        $data['github'] = trim($_POST['github']);
        $data['dev_bio'] = trim($_POST['dev_bio']);
        $data['facebook'] = trim($_POST['facebook']);
        $data['twitter'] = trim($_POST['twitter']);
        $data['insta'] = trim($_POST['insta']);
        $data['youtube'] = trim($_POST['youtube']);
        $skillCount = explode(',', $data['skills']);
           //validate profession
           if(empty($data['profession'])){
           $professionErr = 'Please select your profession level';
           }
           //validate skills
           if(empty($data['skills'])){
           $skillErr = 'Please enter a list of your skills';
           }elseif(count($skillCount) > 4){
           $skillErr = 'Skill must not be more than four';  
           }
   
           //validate developer bio
           if(empty($data['dev_bio'] )){
           $dev_bioErr = 'Please provide a simple bio' ;
           }elseif(strlen($data['dev_bio']) < 45 ){
           $dev_bioErr = 'Your bio is too short';
           }
           if(empty($professionErr) && empty($skillErr) && empty($dev_bioErr)){
               if($userObj->createUserProfile($data, $_SESSION['id'])){
                   header('Location:dashboard.php?success=add-profile');
               }else{
                   header('Location:edit.php?error=edit-profile');
               }
           }  
     }
      
  }
?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
?>
    <section class="edit-profile">
        <div class="container">
            <h1 class="dispay-4 primary-color">Create Your Profile</h1>
            <div class="d-flex flex-row jusfify-content-center signin">
                <i class="fas fa-user mr-2 mt-1"></i>
                <p class='text-capitilize mr-2'>Provide some information to make your profile stand out</p>
            </div>
            <div class="error">
              <?php if(isset($_GET['error'])):?>
                         <?php if($_GET['error'] === 'edit-profile'):?>
                                 <div class="alert alert-danger alert-dismissible fade show py-0">
                                        <p class="pt-3">Error editing Profile ! Please try again</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>  
               <?php endif;?>
            </div>
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>
                    <div class="form-group">
                        <span><small>* required fields</small></span>
                        <select name="profession" id="" class='form-control'>
                        <?php if(count((array)$user) > 0): ?>
                            <option value="<?php echo $data['profession'];?>"><?php echo $data['profession'];?></option>
                        <?php else:?>
                            <option value="">* Select Professional Status</option>
                        <?php endif;?>
                            <option value="Senior">Senior</option>
                            <option value="Junior">Junior</option>
                        </select>
                        <span><small>Give us an idea of where are at your career</small></span>
                        <span class="invalid text-danger d-block"><small><?php echo $professionErr ;?></small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Company" name='company' value = "<?php echo $data['company'];?>">
                        <span><small>Could be your own company or where you work at</small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Website" name='website' value = "<?php echo $data['website'];?>">
                        <span><small>Could be your own or Company Website</small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Location" name='location' value = "<?php echo $data['location'];?>">
                        <span><small>City & State suggested (eg Kericho, Kenya)</small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="* Skills" name='skills' value = "<?php echo $data['skills'];?>">
                        <span><small>Please use a comma separated values (eg HTML, Javascript) but not more than four</small></span>
                        <span class="invalid text-danger d-block"><small><?php echo $skillErr ;?></small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Github Username" name='github' value = "<?php echo $data['github'];?>">
                        <span><small>If you want your latest repos and Github link, include your username</small></span>
                    </div>
                    <div class="form-group">
                        <textarea name="dev_bio" id="" cols="30" rows="6"
                        placeholder='* A short bio  of yourself'
                            class="form-control"><?php echo $data['dev_bio'] ;?></textarea>
                        <span><small>Tell us a little about yourself</small></span>
                        <span class="invalid text-danger d-block"><small><?php echo $dev_bioErr;?></small></span>
                    </div>
                    <div class="social py-4">
                        <div class="d-flex flex-row">
                            <button class="btn btn-secondary button-three py-2 px-4 mr-4">Add social links</button>
                            <div class='mr-4 mt-2'>
                                <strong class=''>Optional</strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control mr-2 align-self-end" placeholder="Facebook Url" name='facebook' value = "<?php echo $data['facebook'];?>">
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control mr-2" placeholder="Twitter Url" name='twitter' value = "<?php echo $data['twitter'];?>">
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control mr-2" placeholder="Instagram Url" name='insta'value = "<?php echo $data['insta'];?>">
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control mr-2" placeholder="YouTube Url" name='youtube' value = "<?php echo $data['youtube'];?>">
                    </div>
                    <div class="form-group d-flex flex-row w-50">
                       <?php if(count((array)$user) > 0): ?>
                            <button class="btn button-one mr-3" type='submit' name='update_submit'>
                                Update
                            </button> 
                        <?php else:?>
                            <button class="btn button-one mr-3" type='submit' name='edit_submit'>
                                 Submit
                            </button>
                        <?php endif;?>
                       
                        <a href='dashboard.php' class="btn btn-secondary mr-3 w-50">
                            Go back
                        </a>

                    </div>
                </form>
            </div>
        </div>

    </section>


    <?php include_once 'includes/footer.php';?>