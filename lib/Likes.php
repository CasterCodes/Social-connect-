<?php
 class Likes {
       private $conn;
       public function __construct(){
            $this->conn = new Database();
       }
       public function insertLike($data){
              $sql = "INSERT INTO likes (userId, postId) VALUES (:userId, :postId)";
              $this->conn->query($sql);
              $this->conn->bind(':userId', $data['userId']);
              $this->conn->bind(':postId', $data['postId']);
              if($this->conn->execute()){
                   return true;
              }else {
                   return false;
              }
       }
       public function selectLikesByUserId($id){
             $sql = "SELECT * FROM likes WHERE userId = :userId";
             $this->conn->query($sql);
             $this->conn->bind(':userId', $id);
             $this->conn->execute();
              return $this->conn->rowCount();
       }
       public function deleteLikesByUserId($id){
              $sql = "DELETE FROM likes WHERE userId = :userId";
              $this->conn->query($sql);
              $this->conn->bind(':userId', $id);
              if($this->conn->execute()){
                return true;
              }else{
                 return false;
             }   
       }
       public function updatePostLikes($likesCount ,$id){
             $sql = "UPDATE posts SET likes = :likes WHERE postId = :postId";
             $this->conn->query($sql);
             $this->conn->bind(':likes', $likesCount);
             $this->conn->bind(':postId', $id);
             if($this->conn->execute()){
                   return true;
             }else{
                  return false;
             }

       }
 }