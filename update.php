<?php 

  require_once('classes/database.php');
  $con = new database();
  $error_message = " ";

  if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $data = $con->viewData($id);
  }
  else {
    header('location:index.php');
  }

  if(isset($_POST['update'])) {
    //user information
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];

    //address information
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $user_id = $_POST['id'];

    if(isset($_POST['update'])) {
      if($con->updateUser($user_id, $firstname, $lastname, $birthday, $sex)) {
  
        if($con->updateUserAddress($user_id, $street, $barangay, $city, $province)) {
          echo "here";
          header('location:index.php?status=success1');
          exit();
        } else {
          $error_message = "Error occured while updating user address. PLease try again.";
        }
      } else {
        $error_message = "Error occured while updating user address. PLease try again.";
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="./includes/style.php">

</head>
<body>

<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4">Update Page</h3>
  <form method="POST">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" value="<?php echo $data['user_firstname'];?>" name="firstname"  placeholder="Enter first name">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" value="<?php echo $data['user_lastname'];?>" name="lastname"  placeholder="Enter last name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" value="<?php echo $data['user_birthday'];?>"name="birthday">
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" name="sex">
            <option value="Male" <?php if($data['user_sex'] == 'Male') echo 'selected';?>>Male</option>
            <option value="Female" <?php if($data['user_sex'] == 'Female') echo 'selected';?>>Female</option>
          </select>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" class="form-control" value="<?php echo $data['street'];?>" name="street" placeholder="Enter street">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" class="form-control" value="<?php echo $data['barangay'];?>" name="barangay" placeholder="Enter barangay">
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" value="<?php echo $data['city'];?>" name="city" placeholder="Enter city">
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" class="form-control" value="<?php echo $data['province'];?>" name="province" placeholder="Enter province">
        </div>
      </div>
    </div>
    
    <!-- Submit Button -->

    
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4"> 
        <input type="hidden" name="id" value="<?php echo $data['user_id'];?>">
            <input type="submit" name="update" class="btn btn-outline-primary btn-block mt-4" value="Update">

        </div>
        <div class="col-lg-3 col-md-4"> 
            <a class="btn btn-outline-danger btn-block mt-4" href="index.php">Go Back</a>
        </div>
    </div>
</div>


  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>