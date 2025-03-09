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

public function read( $email){


    $sql = "Select * FROM users where email =?";
    $stmt=$this->conn->prepare($sql);

    if (!$stmt) {
        return ["success" => false, "message" => "SQL Error: " . $this->conn->error];
    }

    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result= $stmt->get_result();
    return $result->fetch_assoc();

}


public function update($id,$fullname,$email,$password){
    $user = new UserSkeleton();
    $user->setId($id);
    $user->setFullname($fullname);
    $user->setEmail($email);
    $user->setPassword($password);

    $sql= "UPDATE users SET full_name=?, email=?, password=? WHERE id=?";

    $stmt=$this->conn->prepare($sql);

    if (!$stmt) {
        return ["success" => false, "message" => "SQL Error: " . $this->conn->error];
    }

    $stmt->bind_param("sssi",$user->getFullname() , $user->getEmail(),$user->getPassword(),$user->getId());

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