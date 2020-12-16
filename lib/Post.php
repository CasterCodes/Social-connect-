<?php 
class Post{
      private $conn;
      public function __construct(){
             $this->conn = new Database();
      }
      public function createPost($post,$id){
             $sql  = "INSERT INTO posts (userId, postBody) VALUES (:userId,:postBody)" ;
             $this->conn->query($sql);
             $this->conn->bind(':userId', $id);
             $this->conn->bind(':postBody', $post);
             if($this->conn->execute()){
                    return true;
             }else{
                  return false;
             }
      }
      public function getAllPosts(){
              $sql = "SELECT posts.postId,posts.postBody,posts.likes,posts.dislikes, users.userId,users.userName,userprofile.userImage FROM posts
               INNER JOIN users ON posts.userId = users.userId INNER JOIN userprofile ON users.userId = userprofile.userId
               ORDER BY postId DESC";
              $this->conn->query($sql);
              $this->conn->execute();
              return  $this->conn->resultSet();

      }
      public function getPostId($id){
               $sql = "SELECT * FROM posts WHERE postId = :postId";
               $this->conn->query($sql);
               $this->conn->bind(':postId', $id);
               $this->conn->execute();
               return $this->conn->singleResult();
      }
      public function deletePost($id){
       $sql = "DELETE FROM posts WHERE userId = :userId";
       $this->conn->query($sql);
       $this->conn->bind(':userId',$id);
       if($this->conn->execute()){
               return true;
       }else{
               return false;
       }
}
}