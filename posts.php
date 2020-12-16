<?php
  include 'config/init.php';
  include_once 'includes/header.php';
  ?>
  <title>Connect | Posts</title>
  </head>
  <?php
  $userObj = new User();
  $postObj = new Post();
  $likeObj = new Likes();
  $DlikeObj = new Dislike();
 $posts = $postObj->getAllPosts();
  $userDetails = $userObj->getUserprofileById($_SESSION['id']);
  //init var
  $postErr = '';
  if(isset($_POST['post_submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $post = trim($_POST['post']);
         if(empty($post)){
               $postErr = 'Please post something';
         }
         if(empty($postErr)){
               if($postObj->createPost($post, $_SESSION['id'])){
                   header('Location:posts.php?success=add-post');
               }else{
                    header('Location:posts.php?error=add-post');  
               }
         }
  }
  if(isset($_POST['like']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
           $postId = $_POST['postLikeId'];
           $data = [];
           $data['userId'] = $_SESSION['id'];
           $data['postId'] = $postId;
           // user likes
           $likes = $postObj->getPostId($postId);
           $likesCount = $likes->likes;
           // user like and unlike post at the same time
           if($DlikeObj->selectDisLikesByUserId($_SESSION['id']) !== 1){
               // if user had already liked unlike and remove the user form the  the likes table
                if($likeObj->selectLikesByUserId($_SESSION['id']) === 1){       
                    if($likeObj->updatePostLikes($likesCount-1, $postId)){
                        $likeObj->deleteLikesByUserId($_SESSION['id']);
                        header('location:posts.php');
                        exit();
                    }
                }else{
                    // if user had not liked like and insert the user to the likes table
                    if($likeObj->updatePostLikes($likesCount+1 ,$postId)){
                        $likeObj->insertLike($data);
                        header('location:posts.php');
                        exit();      
                    }
                }

           }else{
               header('Location:posts.php');
               exit();
           }
}
if(isset($_POST['Dlike']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $postId = $_POST['Dlike'];
    $Dlikes = $postObj->getPostId($postId);
    $DlikeCount = $Dlikes->dislikes;
    $data = [];
    $data['userId'] = $_SESSION['id'];
    $data['postId'] = $postId;
    //user cant dislike and like at the same time
    if(!$likeObj->selectLikesByUserId($_SESSION['id']) !== 1){
           // user dislikes
          // if user had already liked unlike and remove the user form the  the likes table
      if($DlikeObj->selectDisLikesByUserId($_SESSION['id']) === 1){       
        if($DlikeObj->updatePostDisLikes($DlikeCount - 1 , $postId)){
            $DlikeObj->deleteDisLikesByUserId($_SESSION['id']);
            header('location:posts.php');
            exit();
        }
    }else{   
    // if user had not liked like and insert the user to the likes table
    if($DlikeObj->updatePostDisLikes($DlikeCount + 1 ,$postId)){
            $DlikeObj->insertDisLike($data);
            header('location:posts.php');
            exit();      
    }

   }

 }else{
     header('location:posts.php');
     exit();
 }
    
}
?>
<!-- NAVIGATION -->
<?php 
   include_once 'includes/navigation.php';
?>
    <section class="posts">
        <div class="container">
            <h1 class="dispay-4 primary-color">Posts</h1>
            <div class="d-flex flex-row jusfify-content-center signin">
                <i class="fas fa-user mr-2 mt-1"></i>
                <p class='text-capitilize mr-2'>Welcome to the community</p>
            </div>
            <div class="d-flex flex-column">
                <div class="bg-primary-color">
                    <p class='my-2 mx-2 text-white'>Say Something...</p>
                </div>
                   <?php if(isset($_GET['success'])):?>
                                <?php if($_GET['success'] === 'add-post'):?>
                                        <div class="alert alert-success alert-dismissible fade show py-0 mt-2">
                                                <p class="pt-3">Post added successfully</p>
                                                <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                        </div>
                                <?php endif; ?>  
                    <?php endif;?>
                    <?php if(isset($_GET['error'])):?>
                                <?php if($_GET['error'] === 'add-post'):?>
                                        <div class="alert alert-danger alert-dismissible fade show py-0 mt-2">
                                                <p class="pt-3">Error adding post</p>
                                                <button class="close" type ='submit' data-dismiss='alert'>&times;</button>
                                        </div>
                                <?php endif; ?>  
                    <?php endif;?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" class='mt-2' method='POST'>
                    <div class="form-group">
                        <textarea name="post" id="" cols="30" rows="4" class='form-control' placeholder='Create a post'></textarea>
                        <span class="invalid text-danger"><small><?php echo $postErr ;?></small></span>
                    </div>
                    <div class="form-group">
                        <button type='submit' class="btn btn-secondary" name='post_submit'>Submit</button>
                    </div>
                </form>
            </div>
            <div class="developer-posts">
                 <?php foreach($posts as $post): ?>
                    <div class="jumbotron py-0 pt-3">
                        <div class="row ">
                            <div class="col-md-3 jusfify-content-center text-center">
                                  <!-- Check if user has already updated profile info -->
                                <?php if(count((array)$userDetails)  > 0):?>
                                    <!-- Check if user has uploaded a photo -->
                                    <?php if($userDetails->uploaded == 'yes'):?>
                                        <img src='uploads/<?php echo $post->userImage;?>'  alt="" >
                                    <?php else:?>
                                        <img src="uploads/face.jpeg"  alt="" style="max-width:90%;">
                                    <?php endif;?>
                                <?php else:?>
                                    <img src="uploads/face.jpeg"  alt="" style="max-width:90%;">
                                <?php endif;?>
                                <p class="heading-one primary-color"><?php echo $post->userName;?></p>
                            </div>
                            <div class="col-md-8 my-0">
                                <p><?php echo $post->postBody;?> </p>
                                <div class="d-flex flex-row  my-2">
                                     <?php
                                         if($likeObj->selectLikesByUserId($_SESSION['id']) > 0){
                                              $primaryColor = 'primary-color';
                                         }else{
                                            $primaryColor = ''; 
                                         }
                                         if($DlikeObj->selectDisLikesByUserId($_SESSION['id']) > 0){
                                               $disprimaryColor = 'primary-color';
                                         }else{
                                              $disprimaryColor = ''; 
                                         }
                                     ?>
                                     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>
                                         <input type="hidden" name='postLikeId' value='<?php echo isset($_SESSION['id']) ? $post->postId : '';?>'>
                                         <button class="btn btn-dark mr-2" name='like'><i class="fas fa-thumbs-up mr-2 <?php echo $primaryColor; ?>"></i><?php echo $post->likes;?></button>
                                     </form>
                                     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>
                                          <input type="hidden" name='Dlike' value='<?php  echo isset($_SESSION['id']) ? $post->postId : '';?>'>
                                         <button class="btn btn-dark mr-2"><i class="fas fa-thumbs-down <?php echo $disprimaryColor;?> mr-2"></i><?php echo $post->dislikes;?></button>
                                     </form>
                                    <a href="comments.php?postId=<?php echo $post->postId;?>&userId=<?php echo $post->userId;?>" class="btn button-one"> Comments</a>
                                </div>
                            </div>
                        </div>
                   </div>
                 <?php endforeach;?>
            </div>



        </div>
        </div>
    </section>
    <?php include_once 'includes/footer.php';?>