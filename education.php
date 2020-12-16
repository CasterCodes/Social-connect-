<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  $schoolErr = $levelErr= $fieldErr =  $eduDescErr = '';
  if(isset($_POST['edu_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
       $data = [];
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       $data['school'] = trim($_POST['school']);
       $data['level'] = trim($_POST['level']);
       $data['field'] = trim($_POST['field']);
       $data['fromdate'] = trim($_POST['fromdate']);
       $data['todate'] = trim($_POST['todate']);
       $data['current'] = trim($_POST['current']);
       $data['edudesc'] = trim($_POST['edudesc']);
       //validate job title
       if(empty($data['school'] )){
              $schoolErr = 'Please enter school title';
       }
       //validate company
       if(empty($data['level'])){
            $levelErr= 'Please enter education level';
       }
        //validate field
       if(empty($data['field'])){
           $fieldErr = 'Please enter field of study';
       }
       //validate job description
       if(empty($data['edudesc'])){
             $eduDescErr = 'Please enter education description';
       }
       //check if the current value is empty and give it a value
       if(empty($data['current'])){
             $data['current']  = 'no' ;
       }
       if(empty($schoolErr) && empty($levelErr) && empty($fieldErr) && empty($eduDescErr)){
             $education = new Education();
             if($education->createEducation($data, $_SESSION['id'])){
                   header('Location:dashboard.php?success=add-education');
             }else{
                header('Location:education.php?error=add-education'); 
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
            <h1 class="dispay-4 primary-color">Add Education</h1>
            <div class="d-flex flex-row jusfify-content-center signin">
                <i class="fas fa-user mr-2 mt-1"></i>
                <p class='text-capitilize mr-2'>Add school, bootcamp, etc you have attended</p>
            </div>
            <div class="error">
              <?php if(isset($_GET['error'])):?>
                         <?php if($_GET['error'] === 'add-education'):?>
                                 <div class="alert alert-danger alert-dismissible fade show py-0">
                                        <p class="pt-3">Error adding education ! Please try again</p>
                                        <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                 </div>
                         <?php endif; ?>  
               <?php endif;?>
            </div>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method='POST'>
                    <div class="form-group">
                        <span class='py-2'><small>* required</small></span>
                        <input type="text" class="form-control" placeholder="* School or Bootcamp" name='school'>
                        <span class="invalid text-danger d-block"><small><?php echo $schoolErr ;?></small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class='form-control' placeholder="* Degree or Certificate" name='level'>
                        <span class="invalid text-danger d-block"><small><?php echo $levelErr ;?></small></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class='form-control' placeholder=" * Field of Study" name='field'>
                        <span class="invalid text-danger d-block"><small><?php echo $fieldErr;?></small></span>
                    </div>
                    <div class="form-group">
                        <label for=""><small>From Date</small></label>
                        <input type="date" class='form-control' name='fromdate' >
                    </div>
                    <div class="form-group">
                        <label for=""><small>To Date</small></label>
                        <input type="date" class='form-control' name='todate'>
                    </div>
                    <div class="form-group">
                        <div class="d-flex flex-row">
                            <input type="checkbox" class='mr-2 mt-2' name='current' value='yes'>
                            <span class='mr-2'>Current School</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="edudesc" id="" cols="30" rows="4" class='form-control'  placeholder='* Education description'></textarea>
                        <span class="invalid text-danger d-block"><small><?php echo $eduDescErr ;?></small></span>
                    </div>
                    <div class="form-group d-flex flex-row w-50">
                        <button class="btn button-one mr-3" type='submit' name='edu_submit'>
                            Submit
                        </button>
                        <a href='dashboard.php' class="btn btn-secondary mr-3 w-50">
                            Go back
                        </a>

                    </div>
                </form>
            </div>
        </div>

    </section>


    <?php include_once 'includes/footer.php';?>