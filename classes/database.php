<?php 

class database {
    function opencon() {
        return new PDO ('mysql:host=localhost; dbname=phpcrud', 'root', '');
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

}
?>