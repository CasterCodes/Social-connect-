<?php
class User {
      private $conn;
      public function __construct(){
           $this->conn = new Database();
      }
      public function insertUser($data){
            $sql = "INSERT INTO users(userName,userEmail,userPassword) VALUES (:userName, :userEmail, :userPassword)";
            $this->conn->query($sql);
            $this->conn->bind(':userName', $data['userName']);
            $this->conn->bind(':userEmail', $data['userEmail']);
            $this->conn->bind(':userPassword', $data['userPassword']);
            if($this->conn->execute()){
                return true;
            }else{
                 return false;
            }
      }
      public function selectUserByEmail($email){
             $sql = "SELECT * FROM users WHERE userEmail = :userEmail";
             $this->conn->query($sql);
             $this->conn->bind(":userEmail", $email);
             $this->conn->execute();
             return  $this->conn->singleResult();
      }
      public function rowCountEmail($email){
          $sql = "SELECT * FROM users WHERE userEmail = :userEmail";
          $this->conn->query($sql);
          $this->conn->bind(":userEmail", $email);
          $this->conn->execute();
           return $this->conn->rowCount();
      }
      
      public function createUserProfile($data, $id){
             $sql = "INSERT INTO userprofile (
                  userId,userProfession ,userCompany,userWebsite,userLocation,userSkills,
                  userGithub,userBio,userFacebook,userTwitter,userInsta,userYouTube)
                  VALUES (
                    :userId , :userProfession, :userCompany, :userWebsite, :userLocation, :userSkills,
                    :userGithub , :userBio, :userFacebook , :userTwitter , :userInsta , :userYouTube

                  )";
              $this->conn->query($sql);
              $this->conn->bind(':userId' , $id);
              $this->conn->bind(':userProfession' ,$data['profession'] );
              $this->conn->bind(':userCompany' ,   $data['company']);
              $this->conn->bind(':userWebsite' ,  $data['website']);
              $this->conn->bind(':userLocation', $data['location']);
              $this->conn->bind(':userSkills' ,  $data['skills']);
              $this->conn->bind(':userGithub' , $data['github']);
              $this->conn->bind(':userBio' ,  $data['dev_bio']);
              $this->conn->bind(':userFacebook' , $data['facebook'] );
              $this->conn->bind(':userTwitter' ,  $data['twitter']);
              $this->conn->bind(':userInsta' ,    $data['insta'] );
              $this->conn->bind(':userYouTube' , $data['youtube']);
              if($this->conn->execute()){
                    return true;
              }
              else{
                     return false;
              }
           
      }
      public function updateUserProfile($data, $userId, $updateId){
           $sql = "UPDATE userProfile SET userId =  :userId ,userProfession = :userProfession, userCompany = :userCompany,
                    userWebsite = :userWebsite , userLocation = :userLocation, userSkills = :userSkills,  userGithub = :userGithub,
                    userBio = :userBio, userFacebook = :userFacebook, userTwitter = :userTwitter, userInsta = :userInsta, 
                    userYouTube = :userYouTube WHERE userId = :updateId";
           $this->conn->query($sql);
           $this->conn->bind(':userId' , $userId);
           $this->conn->bind(':userProfession' ,$data['profession'] );
           $this->conn->bind(':userCompany' ,   $data['company']);
           $this->conn->bind(':userWebsite' ,  $data['website']);
           $this->conn->bind(':userLocation', $data['location']);
           $this->conn->bind(':userSkills' ,  $data['skills']);
           $this->conn->bind(':userGithub' , $data['github']);
           $this->conn->bind(':userBio' ,  $data['dev_bio']);
           $this->conn->bind(':userFacebook' , $data['facebook'] );
           $this->conn->bind(':userTwitter' ,  $data['twitter']);
           $this->conn->bind(':userInsta' ,    $data['insta'] );
           $this->conn->bind(':userYouTube' , $data['youtube']);
           $this->conn->bind(':userYouTube' , $data['youtube']);
           $this->conn->bind(':updateId' , $updateId);
           if($this->conn->execute()){
                 return true;
           }
           else{
                  return false;
           }
        
   }
      public function getUser(){
              $sql = "SELECT  users.userId,users.userName, userprofile.userProfession, userprofile.userCompany, userprofile.userWebsite,
              userprofile.userLocation,userprofile.userSkills, userprofile.userGithub,userprofile.userBio, userprofile.userFacebook,
              userprofile.userTwitter, userprofile.userInsta, userprofile.userYoutube, userprofile.userYoutube,userprofile.userImage,
              userprofile.uploaded
              FROM users 
              INNER JOIN userprofile ON users.userId = userprofile.userId";
              $this->conn->query($sql);
              $this->conn->execute();
              return $this->conn->resultSet();
      }
      public function getUserByUserName($userName){
       $sql = "SELECT  users.userId,users.userName, userprofile.userProfession, userprofile.userCompany, userprofile.userWebsite,
       userprofile.userLocation,userprofile.userSkills, userprofile.userGithub,userprofile.userBio, userprofile.userFacebook,
       userprofile.userTwitter, userprofile.userInsta, userprofile.userYoutube, userprofile.userYoutube,userprofile.userImage,
       userprofile.uploaded
       FROM users 
       INNER JOIN userprofile ON users.userId = userprofile.userId WHERE userName LIKE  :userName";
       $this->conn->query($sql);
       $this->conn->bind(':userName',"%" .$userName. "%");
       $this->conn->execute();
       return $this->conn->resultSet();
}
      public function getUserById($id){
             $sql = "SELECT * FROM users WHERE userId = :userId";
             $this->conn->query($sql);
             $this->conn->bind(':userId', $id);
             $this->conn->execute();
             return $this->conn->singleResult();
      }
      public function getUserprofileById($id){
          $sql = "SELECT * FROM userprofile WHERE userId = :userId";
          $this->conn->query($sql);
          $this->conn->bind(':userId', $id);
          $this->conn->execute();
          if($this->conn->rowCount() === 1){
               return $this->conn->singleResult();
          }else{
                return $this->conn->resultSet();
          }
          
     }
     public function uploadUserProfile($data, $id) {
            $sql = "UPDATE userprofile SET userImage = :userImage , uploaded = :uploaded WHERE userId = :userId";
            $this->conn->query($sql);
            $this->conn->bind(':userImage',$data['userImage']);
            $this->conn->bind(':uploaded', $data['uploaded']);
            $this->conn->bind(':userId', $id);
            if($this->conn->execute()){
                   return true;
            }else {
                  return false;
            }

     }
     public function deleteUser($id){
              $sql = "DELETE FROM users WHERE userId = :userId";
              $this->conn->query($sql);
              $this->conn->bind(':userId',$id);
              if($this->conn->execute()){
                      return true;
              }else{
                      return false;
              }
     }
     public function deleteUserProfile($id){
              $sql = "DELETE FROM userprofile WHERE userId = :userId";
              $this->conn->query($sql);
              $this->conn->bind(':userId',$id);
              if($this->conn->execute()){
                     return true;
              }else{
                     return false;
              }   
     }

 }
    
