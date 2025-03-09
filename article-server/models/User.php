<?php
include("../connection/connection.php");
include("UserSkeleton.php");

class User{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        
    }
    
    public function register($fullname, $email, $password){

        $user = new UserSkeleton();

        
        $user->setFullname($fullname);
        $user->setEmail($email);
        $user->setPassword(password_hash($password,PASSWORD_DEFAULT));

        $sql = "INSERT INTO users (full_name, email,password) VALUES (?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss",$user->getFullname(), $user->getEmail(), $user->getPassword());

        if($stmt->execute()){
            return [
                "success" => true,
                "user_id" => $this->conn->insert_id,
                "message" => "User registered successfully"
            ];
        }
        else{
            return[
                "success"=>false,
                "message"=>"Error: " . $stmt->error
            ];
        }
}

public function read( $email,){
    $user = new UserSkeleton();


    $sql = "Select * FROM users where email =?";
    $stmt=$this->conn->prepare($sql);
    $stmt->bind_params("s",$email);
    $result= $stmt->get_result();
    return $result->fetch_assoc;

}


public function update($userId,$fullname,$email,$password){
    $user = new UserSkeleton();
    $user->setId($userId);
    $user->setFullname($fullname);
    $user->setEmail($email);
    $user->setPassword($password);

    $sql= "UPDATE users SET fullname=?, email=?, password=? WHERE userId=?";

    $stmt=$this->conn->prepare($sql);
    $stmt->bind_params("sssi",$user->getFullname() , $user->getEmail(),$user->getPassword(),$user->getId());

    if($stmt->execute()){
        return[
            "success"=>true,
            "message"=>"user updated"
        ];
    }
    else{
        return[
            "success"=>false,
            "message"=>"Update failed: " . $stmt->error
        ];
    }



}






}