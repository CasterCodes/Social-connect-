<?php
 class Dislike {
       private $conn;
       public function __construct(){
            $this->conn = new Database();
       }
       public function insertDisLike($data){
              $sql = "INSERT INTO dlikes (userId, postId) VALUES (:userId, :postId)";
              $this->conn->query($sql);
              $this->conn->bind(':userId', $data['userId']);
              $this->conn->bind(':postId', $data['postId']);
              if($this->conn->execute()){
                   return true;
              }else {
                   return false;
              }
       }
       public function selectDisLikesByUserId($id){
             $sql = "SELECT * FROM dlikes WHERE userId = :userId";
             $this->conn->query($sql);
             $this->conn->bind(':userId', $id);
             $this->conn->execute();
              return $this->conn->rowCount();
       }
       public function deleteDisLikesByUserId($id){
              $sql = "DELETE FROM dlikes WHERE userId = :userId";
              $this->conn->query($sql);
              $this->conn->bind(':userId', $id);
              if($this->conn->execute()){
                return true;
              }else{
                 return false;
             }   
       }
       public function updatePostDisLikes($likesCount ,$id){
             $sql = "UPDATE posts SET dislikes = :likes WHERE postId = :postId";
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