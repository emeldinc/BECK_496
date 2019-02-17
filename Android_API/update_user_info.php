<?php

class update_user_info {

    private $conn;

    // constructor
    function __construct() {
        require_once 'android_login_connect.php';
        // connecting to database
        $db = new android_login_connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Storing new user
     * returns user details
     */
    public function StoreUserInfo($username, $password, $firstname, $lastname, $role, $image_path) {
    
        $stmt = $this->conn->prepare("INSERT INTO beckdoor.user(username, password, firstname, lastname, role, image_path) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $password, $firstname, $lastname, $role, $image_path);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT username, password, firstname, lastname, role, image_path FROM beckdoor.user WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt-> bind_result($token2,$token3,$token4,$token5,$token6,$token7);
            while ( $stmt-> fetch() ) {
               $user["username"] = $token2;
               $user["password"] = $token3;
               $user["firstname"] = $token4;
               $user["lastname"] = $token5;
               $user["role"] = $token6;
               $user["image_path"] = $token7;
            }
            $stmt->close();
            return $user;
        } else {
          return false;
        }
    }

    /**
     * Get user by username and password
     */
    public function VerifyUserAuthentication($username, $password) {

        $stmt = $this->conn->prepare("SELECT username, password, firstname, lastname, role, image_path FROM beckdoor.user WHERE username = ?");

        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $stmt-> bind_result($token2,$token3,$token4,$token5,$token6,$token7);

            while ( $stmt-> fetch() ) {
               $user["username"] = $token2;
               $user["password"] = $token3;
               $user["firstname"] = $token4;
               $user["lastname"] = $token5;
               $user["role"] = $token6;
               $user["image_path"] = $token7;
            }

            $stmt->close();

    }

    /**
     * Check user is existed or not
     */
    public function CheckExistingUser($username) {
        $stmt = $this->conn->prepare("SELECT username from user WHERE username = ?");

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    
}

?>
