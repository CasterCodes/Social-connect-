<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  ?>
  <title>Connect | Comments</title>
  </head>
  <?php
  $commentObj = new Comment();
  $userObj = new User();
  $postObj = new Post();
  $userDetails = $userObj->getUserprofileById($_SESSION['id']);
?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
?>
    <section class="comments">
        <div class="container">
            <div class="py-2">
                <a href="posts.php" class="btn button-one w-50">Back to Posts</a>
            </div>
            <div class="developer-comment">
                  <?php 
                      if(isset($_GET['postId'])){
                             $postId = $_GET['postId'];
                      }else{
                           $postId = '';
                      }
                      if(isset($_GET['userId'])){
                            $userId = $_GET['userId'];
                      }else{
                           $userId = '';
                      }
                      $user = $userObj->getUserById($userId);
                      $post = $postObj->getPostId($postId);
                      $userProfile = $userObj->getUserprofileById($userId)
                  ?>
                <div class="jumbotron py-0 pt-3">
                    <div class="row ">
                        <div class="col-md-3 jusfify-content-center text-center">
                             <!-- Check if user has already updated profile info -->
                             <?php if(count((array)$userProfile) === 15):?>
                                    <!-- Check if user has uploaded a photo -->
                                    <?php if($userProfile->uploaded === 'yes'):?>
                                        <img src='uploads/<?php echo $userProfile->userImage;?>'  alt="" >
                                    <?php else:?>
                                        <img src="uploads/face.jpeg"  alt="" style="max-width:50%;">
                                    <?php endif;?>
                                <?php else:?>
                                    <img src="uploads/face.jpeg"  alt="" style="max-width:50%;">
                                <?php endif;?>
                            <img src="images/face.jpeg" alt="">
                            <p class="heading-one primary-color"><?php echo $user->userName;?></p>
                        </div>
                        <div class="col-md-8 my-0">
                            <p class='mt-4'><?php echo $post->postBody;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column">
                <div class="bg-primary-color">
                    <p class='my-2 mx-2 text-white'>Say Something...</p>
                </div>
                <div class="error">
                    <?php if(isset($_GET['comment'])):?>
                                <?php if($_GET['comment'] === 'your-comment'):?>
                                        <div class="alert alert-info alert-dismissible fade show py-0 mt-2">
                                                <p class="pt-3">Your can't commment on your post</p>
                                                <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                        </div>
                                <?php endif; ?>  
                                <?php if($_GET['comment'] === 'exist-comment'):?>
                                        <div class="alert alert-info alert-dismissible fade show py-0 mt-2">
                                                <p class="pt-3">Your have already commented on this post</p>
                                                <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                        </div>
                                <?php endif; ?> 
                                <?php if($_GET['comment'] === 'success-comment'):?>
                                        <div class="alert alert-success alert-dismissible fade show py-0 mt-2">
                                                <p class="pt-3">Post added successfully</p>
                                                <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                        </div>
                                <?php endif; ?>
                                  
                    <?php endif;?>
                </div>
                <form action="add-comments.php" class='mt-2' method='POST'>
                    <div class="form-group">
                        <textarea name="comment" id="" cols="30" rows="4" class='form-control' placeholder='Create a comment'></textarea>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name='postId' value=<?php 
                        //postId displayed when user is logged;
                         if(isset($_SESSION['id'])){
                            echo $postId;
                          }
                          ?>>
                     </div>
                     <div class="form-group">
                      <input type="hidden" name='userId' value=<?php
                       //userId displayed when user is logged;
                        if(isset($_SESSION['id'])){
                            echo $post->userId;
                        }
                          ?>>
                     </div>
                    <div class="form-group">
                        <button type='submit' class="btn btn-secondary" name='comment_submit'>Submit</button>
                    </div>
                </form>
            </div>
            <div class="developer-comments">
                  <?php
                      $comments = $commentObj->getAllCommentsByPostId($postId);
                  ?>
                  <?php foreach($comments as $comment):?>
                        <div class="jumbotron py-0 pt-3">
                            <div class="row ">
                                <div class="col-md-3 jusfify-content-center text-center">
                                      <!-- Check if user has already updated profile info -->
                                <?php if(count((array)$userDetails) === 15):?>
                                    <!-- Check if user has uploaded a photo -->
                                    <?php if($userDetails->uploaded === 'yes'):?>
                                        <img src='uploads/<?php echo $userDetails->userImage;?>'  alt="" >
                                    <?php else:?>
                                        <img src="uploads/face.jpeg"  alt="" style="max-width:50%;">
                                    <?php endif;?>
                                <?php else:?>
                                    <img src="uploads/face.jpeg"  alt="" style="max-width:50%;">
                                <?php endif;?>
                                    <p class="heading-one primary-color"><?php echo $comment->userName;?></p>
                                </div>
                                <div class="col-md-8 my-0 mt-4">
                                    <p><?php echo $comment->commentBody;?></p>
                                </div>
                            </div>
                        </div>
                  <?php endforeach;?>
            </div>



        </div>
        </div>
    </section>



    <?php include_once 'includes/footer.php';?>