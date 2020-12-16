<?php
 class Education{
       private $conn;
       public function __construct(){
           $this->conn = new Database();
       }
       public function createEducation($data,$id){
        $sql = "INSERT INTO education (userId,school,schoolLevel,schoolField,fromDate,toDate,currentEducation,educationDesc)
        VALUES (:userId,:school,:schoolLevel,:schoolField,:fromDate,:toDate,:currentEducation,:educationDesc)";
        $this->conn->query($sql);
        $this->conn->bind(':userId', $id);
        $this->conn->bind(':school',  $data['school']);
        $this->conn->bind(':schoolLevel', $data['level']);
        $this->conn->bind(':schoolField', $data['field']);
        $this->conn->bind(':fromDate', $data['fromdate']);
        $this->conn->bind(':toDate',  $data['todate']);
        $this->conn->bind(':currentEducation',  $data['current']);
        $this->conn->bind(':educationDesc',  $data['edudesc']);
        if( $this->conn->execute()){
              return true;
        }else{
             return false;
        }
        
       }
       public function getEducationById($id){
            $sql = "SELECT * FROM education WHERE userId = :userId";
            $this->conn->query($sql);
            $this->conn->bind(':userId', $id);
            $this->conn->execute();
            return $this->conn->resultSet();
    }
    public function  deleteEducationById($id){
      $sql = "DELETE FROM education WHERE educationId = :educationId ";
      $this->conn->query($sql);
      $this->conn->bind(':educationId', $id);
      if($this->conn->execute()){
             return true;
      }else{
             return false;
      }
      
   }
   public function  deleteuserEducationById($id){
      $sql = "DELETE FROM education WHERE userId = :userId ";
      $this->conn->query($sql);
      $this->conn->bind(':userId', $id);
      if($this->conn->execute()){
             return true;
      }else{
             return false;
      }
      
   }
      
 }