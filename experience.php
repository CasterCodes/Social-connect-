<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  ?>
  <title>Connect | Add Experience</title>
  </head>
  <?php
  $jobErr = $companyErr = $jobDescErr = '';
  if(isset($_POST['exp_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
       $data = [];
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       $data['job'] = trim($_POST['job']);
       $data['company'] = trim($_POST['company']);
       $data['fromdate'] = trim($_POST['fromdate']);
       $data['todate'] = trim($_POST['todate']);
       $data['current'] = trim($_POST['current']);
       $data['jobdesc'] = trim($_POST['jobdesc']);
       //validate job title
       if(empty($data['job'] )){
              $jobErr = 'Please enter job title';
       }
       //validate company
       if(empty($data['company'])){
            $companyErr = 'Please enter company name';
       }
       //validate job description
       if(empty($data['jobdesc'])){
             $jobDescErr = 'Please enter job description';
       }
       //check if the current value is empty and give it a value
       if(empty($data['current'])){
             $data['current']  = 'no' ;
       }
       if(empty($jobErr) && empty($jobDescErr) && empty($companyErr)){
             $experience = new Experience();
             if($experience->createExperience($data, $_SESSION['id'])){
                   header('Location:dashboard.php?success=add-experience');
             }else{
                header('Location:experience.php?error=add-experience'); 
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
            <h1 class="dispay-4 primary-color">Add An Experience</h1>
            <div class="d-flex flex-row jusfify-content-center signin">
                <i class="fas fa-user mr-2 mt-1"></i>
                <p class='text-capitilize mr-2'>Add any developer/programming positions that you had in the past</p>
            </div>
            <div class="error">
              <?php if(isset($_GET['error'])):?>
                         <?php if($_GET['error'] === 'add-experience'):?>
                                 <div class="alert alert-danger alert-dismissible fade show py-0">
                                        <p class="pt-3">Error adding experience ! Please try again</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>  
               <?php endif;?>
            </div>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method='POST'>
                    <div class="form-group">
                        <span class='py-2'><small>* required</small></span>
                        <input type="text" class="form-control" placeholder="* Job Title" name ='job'>
                        <span class="invalid text-danger d-block"><small><?php echo $jobErr ;?></small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class='form-control' placeholder="* Company" name='company'>
                        <span class="invalid text-danger d-block"><small><?php echo $companyErr ;?></small></span>
                    </div>
                    <div class="form-group">
                        <label for=""><small>From Date</small></label>
                        <input type="date" class='form-control' name='fromdate'>
                    </div>
                    <div class="form-group">
                        <label for=""><small>To Date</small></label>
                        <input type="date" class='form-control' name='todate'>
                    </div>
                    <div class="form-group">
                        <div class="d-flex flex-row">
                            <input type="checkbox" class='mr-2 mt-2' name='current' value='yes'>
                            <span class='mr-2'>Current Job</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="jobdesc" id="" cols="30" rows="4" class='form-control' placeholder = '* Job description'></textarea>
                        <span class="invalid text-danger d-block"><small><?php echo $jobDescErr ;?></small></span>
                    </div>
                    <div class="form-group d-flex flex-row w-50">
                        <button class="btn button-one mr-3" type='submit' name='exp_submit'>
                            Submit
                        </button>
                        <a href='dashboard.html' class="btn btn-secondary mr-3 w-50">
                            Go back
                        </a>

                    </div>
                </form>
            </div>
        </div>

    </section>


    <?php include_once 'includes/footer.php';?>