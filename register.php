<?php
session_start();
include './connection/connection.php';



$userAddStatus = "";

if (isset($_POST["add_user"])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $password = md5($_POST['password']); 
  $role = $_POST['role'];
    if (empty($errors)) {
        $insert_new_user = "INSERT INTO user (fullname, username, course,year, password,role) 
                            VALUES ('$fullname', '$username', '$course','$year', '$password','$role')";

        if (mysqli_query($connect, $insert_new_user)) {
            $userAddStatus = "User Registered successfully";
        } else {
            $userAddStatus = "Error occurred while adding user";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Library Manageent</title>
</head>

<body>
    <section class="form-02-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="_lk_de">
                        <div class="form-03-main" style="margin-top: 1px;">
                            <center>
                                <h2> ARU LIBRARY MANAGEMENT</h2>
                            </center>

                            <div class="alert <?php echo !empty($userAddStatus) && strpos($userAddStatus, 'successfully') !== false ? 'alert-success' : ''; ?>"
                                id="successMessage" style="text-align:center">
                                <?php echo $userAddStatus; ?>
                            </div>
                            <div class="logo">
                                <img src="assets/images/logoo.jpg">
                            </div>


                            <form action="" method="POST">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="fullname" class="form-control _ge_de_ol"
                                                type="text" placeholder=" Fullname" required="yes" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control _ge_de_ol"
                                                type="text" placeholder=" Username (Reg No)" required="yes"
                                                aria-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="course" class="form-control _ge_de_ol" type="text"
                                                placeholder="Enter Course (Eg, ISM)" required="yes"
                                                aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" name="year" class="form-control _ge_de_ol"
                                                type="number" placeholder="Enter Year (1,2,3,4,5)" required="yes"
                                                aria-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control _ge_de_ol" type="text"
                                        placeholder="Enter Password" required="yes" aria-required="true">
                                </div>


                                <input type="hidden" name="role" value="Student" placeholder="Enter Password"
                                    required="yes" aria-required="true">


                                <div class="form-group">

                                    <button class="_btn_04" type="submit" name="add_user">
                                        Register
                                    </button>
                                </div>
                            </form>
                            <div class="form-group nm_lk">
                                <a href="index.php">Already Have an Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>