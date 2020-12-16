<?php
include 'config/init.php';
//check whether  the form is submitted
if(isset($_POST['comment_submit'])  && $_SERVER['REQUEST_METHOD'] === 'POST'){
      $data = [];
      $data['userId'] = trim($_POST['userId']);
      $data['commentUserId'] = $_SESSION['id'];
      $data['postId'] = trim($_POST['postId']);
      $data['commentBody'] = trim($_POST['comment']);
       //user is only able to comment when logged in
        if($_SESSION['id']){
               //user cant comment on his own post
               if($_SESSION['id'] == $data['userId']){
                  header('location:comments.php?postId='.$data['postId'] .'&userId='.$data['userId'] .'&comment=your-comment');
               }else{
                  $comment = new Comment();
                  $userComment = $comment->getCommentByUserId($_SESSION['id'] , $data['postId']);
                  //User only allowed to comment on a post once
                  if($userComment === 1){
                        header('location:comments.php?postId='.$data['postId'] .'&userId='.$data['userId'] .'&comment=exist-comment');
                  }else{
                        if(empty($data['comment'])){
                              $commentErr = 'Pleae say something';
                        }
                        if(!empty($commentErr)){
                              if($comment->createComment($data)){
                                    //direct to comments page with a success param
                                  header('location:comments.php?postId='.$data['postId'] .'&userId='.$data['userId'] .'&comment=success-comment');
                              }else {
                                     //direct to comments page with a error param
                                  header('location:comments.php?postId='.$data['postId'] .'&userId='.$data['userId'] .'&comment=fail-comment');    
                              }
                        }
                  }

                    
               }
        }  
}