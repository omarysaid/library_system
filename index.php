<?php
session_start();
include './connection/connection.php';

$message = ""; // Variable to store messages

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($password)) {
        // Handle empty fields
        $message = "username and password not match.";
    } else {
        $password = md5($password);

        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connect, $sql);
        $number = mysqli_num_rows($result);
        if ($number > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['username'] = $row['username'];
              $_SESSION['role'] = $row['role'];

            if ($row['role'] == "Librarian") {
                $redirectUrl = './mainsystem/Librarian/dashboard.php';
            } 
            else {
                // Redirect to a default page if role is null or any other unknown role
                $redirectUrl = './mainsystem/students/view_book_lists.php';
            }

            header("Location: $redirectUrl"); // Redirect immediately
            exit;
        } else {
            $message = "Wrong username or password. Please try again.";
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

    <style>
    .error-message {
        margin-top: 10px;
        color: red;
    }
    </style>
</head>

<body>
    <section class="form-02-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="_lk_de">
                        <div class="form-03-main">
                            <center>
                                <h2> ARU LIBRARY MANAGEMENT</h2>
                            </center>


                            <div class="logo">
                                <img src="assets/images/logoo.jpg">
                            </div>
                            <!-- Message div -->
                            <?php if (!empty($message)) : ?>
                            <div class="<?php echo $loginSuccess ? 'success-message' : 'error-message'; ?>"
                                style="text-align:center">
                                <?php echo $message; ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control _ge_de_ol" type="text"
                                        placeholder="Enter Username" required="" aria-required="true">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control _ge_de_ol" type="text"
                                        placeholder="Enter Password" required="" aria-required="true">
                                </div>



                                <div class="form-group">
                                    <button class="_btn_04" type="submit" name="login">
                                        Login
                                    </button>
                                </div>
                            </form>
                            <div class="form-group nm_lk">
                                <a href="register.php">Create Account</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>