<?php
  include 'config/init.php'; 
  include_once 'includes/header.php';
  ?>
  <title>Connect | Profile</title>
  </head>
  <?php
?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
?>
    <section class="profile">
         <?php
            if(isset($_GET['user-id'])){
                  $user_id = $_GET['user-id'];
                  $user = new User();
                  $profile = new User();
                  $userDetails = $user->getUserById($user_id);
                  $profileDetails = $profile->getUserprofileById($user_id);

            }
         ?>
        <div class="container">
            <div>
                <a href="developers.php" class="btn button-one my-2 w-50">Back to Developers</a>
            </div>
            <div class="jumbotron  d-flex flex-column jusfidy-content-center text-center developer-details">
                <div class=" mr-4 p-0">
                    <?php if($profileDetails->uploaded === 'yes'):?>
                        <img src='uploads/<?php echo $profileDetails->userImage;?>' alt="" class='profile-image ' >
                    <?php else:?>
                        <img src="uploads/face.jpeg" class="profile-image img-fluid " alt="">
                    <?php endif;?>
                </div>
                <div class=" mr-4 mt-2 text-white">
                    <h3 class='developer heading-one'><?php echo $userDetails->userName;?></h3>
                    <p>Developer at <?php echo $profileDetails->userCompany;?></p>
                    <p><?php echo $profileDetails->userLocation;?></p>

                </div>
                <div class="text-white text-center jusfidy-content-center mt-5">
                    <a href="<?php echo $profileDetails->userFacebook;?>" class='text-white'> <i class="fab fa-facebook-f fa-2x m-2"></i></a>
                    <a href="<?php echo $profileDetails->userTwitter;?>" class='text-white'> <i class="fab fa-twitter   fa-2x m-2"></i></a>
                    <a href="<?php echo $profileDetails->userInsta;?>" class='text-white'> <i class="fab fa-instagram   fa-2x m-2"></i></a>
                    <a href="<?php echo $profileDetails->userYoutube;?>" class='text-white'><i class="fab fa-youtube  fa-2x m-2"></i></a>
                </div>
            </div>
            <div class="developer-bio jumbotron">
                <div class="d-flex flex-column justify-centent-center text-center">
                    <h2 class='primary-color heading-one'><?php
                          $userfullname = $userDetails->userName;
                          $userfirstname = explode(' ', $userfullname);
                          echo $userfirstname[0] . "'s" . " Bio"
                    ?></h2>
                    <p><?php echo $profileDetails->userBio;?></p>
                </div>
                <hr>
                <div class="d-flex flex-column justify-centent-center text-center">
                    <h2 class='heading-one primary-color py-3'>Skill Set</h2>
                    <div class="d-flex text-center justify-content-center flex-sm-row flex-column">
                        <?php $skills = explode(',', $profileDetails->userSkills);?>
                        <?php if(count($skills) === 1):?>
                            <div class="d-flex  flex-row">
                            <div class="p-2 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-2 align-self-end">
                                <?php echo strtoupper($skills[0]);?>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if(count($skills) === 2):?>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[0]);?>
                                </div>
                            </div>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[1]);?>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if(count($skills) === 3):?>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[0]);?>
                                </div>
                            </div>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[1]);?>
                                </div>
                            </div>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[2]);?>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if(count($skills) === 4):?>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[0]);?>
                                </div>
                            </div>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[1]);?>
                                </div>
                            </div>
                            <div class="d-flex  flex-row">
                                <div class="p-2 align-self-start">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="p-2 align-self-end">
                                    <?php echo strtoupper($skills[2]);?>
                                </div>
                            </div>
                            <div class="d-flex  flex-row">
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
            <div class="well">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="jumbotron  experience">
                            <h2 class="primary-color">Experience</h2>
                            <?php
                              $experienceObj = new Experience();
                              $experienceDetails = $experienceObj->getExperienceById($user_id);
                            ?>
                            <?php if(count($experienceDetails) > 0):?>
                                <?php foreach($experienceDetails as $experience):?>
                                    <p class='mt-2'><?php echo $experience->jobTitle;?></p>
                                    <p><?php echo $experience->fromDate;?> - <?php 
                                    if($experience->currentJob === 'yes'){
                                        echo 'To Date';
                                    }else{
                                        echo $experience->toDate;
                                    } ?></p>
                                    <p>Position : <?php echo $profileDetails->userProfession;?> Developer</p>
                                    <p><?php echo $experience->jobDesc;?></p>
                                    <hr>
                              <?php endforeach;?>
                            <?php else:?>
                              <p class="text-info">
                                   User has not yet updated
                              </p>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 ">
                        <div class="jumbotron education">
                            <h2 class="primary-color">
                                Education
                            </h2>
                            <?php
                              $educationObj = new Education();
                              $educationDetails = $educationObj->getEducationById($user_id);
                            ?>
                            <!-- i education details exist display -->
                             <?php if(count($educationDetails) > 0):?>
                                <?php foreach($educationDetails as $education):?>
                                    <p class='mt-2'><?php echo $education->school;?></p>
                                    <p><?php echo $education->fromDate;?> - <?php 
                                    // current education display  echo To date
                                    if($education->currentEducation === 'yes'){
                                        echo 'To Date';
                                    }else{
                                        echo $education->toDate;
                                    } ?></p>
                                <p> Level : <?php echo $education->schoolLevel;?></p>
                                <p>Field Of Study : <?php echo $education->schoolField;?></p>
                                <p>Description : <?php echo $education->educationDesc;?></p>
                                <hr>
                                <?php endforeach;?>
                            <!-- else display this -->
                            <?php else:?>
                                <p class="text-info">
                                    User has not yet updated
                                </p>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="repos mx-3">
            <div class="d-flex flex-row primary-color ml-3 my-0">
                <div class='mr-2'>
                    <i class="fab fa-github heading-one mt-1 "></i>
                </div>
                <div class='mr-2'>
                    <p class="heading-one">Github Repos</p>
                </div>
                <input type="hidden" class="githubname" value="<?php echo  $profileDetails->userGithub; ?>">
            </div>
            <div class="repos-container">
            </div>
        </div>


    </section>


    <?php include_once 'includes/footer.php';?>