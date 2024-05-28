<?php 

class database {
    function opencon() {
        return new PDO ('mysql:host=localhost; dbname=phpcrud', 'root', '');
    }

    function check($username, $password) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $query = $con->prepare("SELECT * FROM users WHERE user_name = ?");
        $query->execute([$username]);
    
        // Fetch the user data as an associative array
        $user = $query->fetch(PDO::FETCH_ASSOC);
    
        // If a user is found, verify the password
        if ($user && password_verify($password, $user['user_pass'])) {
            return $user;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
    }

    function signupUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profile_picture_path) {
        $con = $this->opencon();

        $con->prepare("INSERT INTO users (user_firstname, user_lastname, user_birthday, user_sex, user_email, user_name, user_pass, user_profile_picture) VALUES (?,?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $email, $username, $password, $profile_picture_path]);
        return $con->lastInsertId();
    }

    function insertAddress($user_id, $street, $barangay, $city, $province)
    {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, street, barangay, city, province) VALUES (?,?,?,?,?)")->execute([$user_id, $street, $barangay,  $city, $province]);
          
    }

    function signup($firstname, $lastname, $birthday, $sex, $username, $password) {
        $con = $this->opencon();
        //Check if username is existing 
        $query = $con->prepare("SELECT user_name FROM users WHERE user_name = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
        if ($existingUser) {
            return false;
        } else {
            return $con->prepare("INSERT INTO users (user_firstname, user_lastname, user_birthday, user_sex, user_name, user_pass)
            VALUES(?, ?, ?, ?, ?, ?)")->execute([$firstname, $lastname, $birthday, $sex, $username, $password]);
        }
    }
}
?>