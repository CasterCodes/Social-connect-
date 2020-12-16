<?php
 class Experience{
       private $conn;
       public function __construct(){
           $this->conn = new Database();
       }
       public function createExperience($data,$id){
        $sql = "INSERT INTO experience(userId,jobTitle,companyName,fromDate,toDate,currentJob,jobDesc)
        VALUES (:userId,:jobTitle,:companyName,:fromDate,:toDate,:currentJob , :jobDesc)";
        $this->conn->query($sql);
        $this->conn->bind(':userId', $id);
        $this->conn->bind(':jobTitle',  $data['job']);
        $this->conn->bind(':companyName', $data['company']);
        $this->conn->bind(':fromDate', $data['fromdate']);
        $this->conn->bind(':toDate',  $data['todate']);
        $this->conn->bind(':currentJob',  $data['current']);
        $this->conn->bind(':jobDesc',  $data['jobdesc']);
        if( $this->conn->execute()){
              return true;
        }else{
             return false;
        }
        
       }
       public function getExperienceById($id){
               $sql = "SELECT * FROM experience WHERE userId = :userId";
               $this->conn->query($sql);
               $this->conn->bind(':userId', $id);
               $this->conn->execute();
               return $this->conn->resultSet();
       }
       public function  deleteExperienceById($id){
               $sql = "DELETE FROM experience WHERE experienceId = :experienceId ";
               $this->conn->query($sql);
               $this->conn->bind(':experienceId', $id);
               if($this->conn->execute()){
                      return true;
               }else{
                      return false;
               }
               
       }
       public function  deleteUserExperienceById($id){
            $sql = "DELETE FROM experience WHERE userId = :userId";
            $this->conn->query($sql);
            $this->conn->bind(':userId', $id);
            if($this->conn->execute()){
                   return true;
            }else{
                   return false;
            }
            
    }
      
 }