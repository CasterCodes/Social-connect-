CREATE TABLE users (
     userId int(11) PRIMARY KEY AUTO_INCREMENT NOT null,
     userName varchar(256) not null,
     userEmail varchar(256) not null,
     userPassword varchar(256) not null
)
create table userProfile (
     profileId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
     userId int(11) not null,
     userProfession varchar(256) not null,
     userCompany varchar(256) not null,
     userWebsite varchar(256) not null,
     userLocation varchar(256) not null,
     userSkills varchar(256) not null,
     userGithub varchar(256) not null,
     userBio longtext not null,
     userFacebook varchar(256) not null,
     userTwitter varchar(256) not  null,
     userInsta varchar(256) not null,
     userYoutube varchar(256) not null,
     userImage varchar(256) not null,
     uploaded varchar(256) DEFAULT 'no'
)
create table Experience (
      experienceId int(11) PRIMARY KEY AUTO_INCREMENT NOT null,
      userId int(11) not null,
      jobTitle varchar(256) not null,
      companyName varchar(256) not null,
      fromDate Date not null,
      toDate Date not null,
      currentJob varchar(256) DEFAULT 'no',
      jobDesc longtext not null
    
)
create table education (
     educationId int(11) AUTO_INCREMENT PRIMARY KEY not null,
     userId int(11) not null,
     school varchar(256) not null,
     schoolLevel varchar(256) not null,
     schoolField varchar(256) not null,
     fromDate Date not null,
     toDate Date not null,
     currentEducation varchar(256) DEFAULT 'no',
     educationDesc longtext not null  
)
create table posts (
     postId int(11)  PRIMARY KEY AUTO_INCREMENT NOT NULL,
     userId int(11) not null,
     postBody longtext not null,
     likes int(11)  DEFAULT 1,
     dislikes int(11) DEFAULT 1
)
create table comments (
      commentId int(11) PRIMARY KEY AUTO_INCREMENT not null,
      userId int(11) not null,
      postId int(11) not null,
      commentBody longtext not null
    
)

create table likes (
       likeId int(11) AUTO_INCREMENT PRIMARY KEY,
       userId int(11) not null,
       postId int(11) not null
)
create table dlikes (
       likeId int(11) AUTO_INCREMENT PRIMARY KEY,
       userId int(11) not null,
       postId int(11) not null
)
