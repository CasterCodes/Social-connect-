<?php
class Comment {
      private $conn;
      public function __construct(){
           $this->conn = new Database();
      }
      public function createComment($data){
           $sql = "INSERT INTO comments(userId, postId,commentBody) VALUES (:userId, :postId, :commentBody)";
           $this->conn->query($sql);
           $this->conn->bind(':userId',$data['commentUserId']);
           $this->conn->bind(':postId',$data['postId']);
           $this->conn->bind(':commentBody',$data['commentBody']);
           if($this->conn->execute()){
                 return true;
           }else{
                return false;
           }
      }
      public function getCommentByUserId($userId, $postId){
           $sql = "SELECT * FROM  comments WHERE userId = :userId && postId = :postId";
           $this->conn->query($sql);
           $this->conn->bind(':userId', $userId);
           $this->conn->bind(':postId', $postId);
           $this->conn->execute();
           return $this->conn->rowCount();
      }
      public function getAllCommentsByPostId($id){
               $sql = "SELECT users.userName, userprofile.userImage, comments.commentBody FROM users
               INNER JOIN userprofile ON users.userId = userprofile.userId
               INNER JOIN comments ON userprofile.userId = comments.userId  WHERE postId = :postId";
               $this->conn->query($sql);
               $this->conn->bind(':postId', $id);
               $this->conn->execute();
               return $this->conn->resultSet();
      }
      public function deleteComment($id){
          $sql = "DELETE FROM comments WHERE userId = :userId";
          $this->conn->query($sql);
          $this->conn->bind(':userId',$id);
          if($this->conn->execute()){
                  return true;
          }else{
                  return false;
          }
 }
}