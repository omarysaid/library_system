<?php include '../include/header.php'; ?>
<?php include '.././include/sidebar.php'; ?>
<?php
if (isset($_POST['update_data'])) {
    $user_id = $_GET['user_id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $course = $_POST['course'];
    $year = $_POST['year'];
  
    $errors = array(); 
    if (empty($fullname)) {
        $errors[] = "Fullname is required";
    }
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($course)) {
        $errors[] = "Course is required";
    }
    if (empty($year)) {
        $errors[] = "Year is required";
    }
   
    if (empty($errors)) {
        $update_student = "UPDATE user SET fullname='$fullname', username='$username', course='$course', year='$year'
        WHERE user_id = '$user_id'";

        if (mysqli_query($connect, $update_student)) {
       
            $userStatus = "Student updated successfully";
        } else {
           
            $userStatus = "Error occurred while updating User";
        }
    } else {
     
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}

?>

<div class="content-wrapper" style="margin-top: 70px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-10">

                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title"><small>Student Updation Form</small></h3>
                        </div>

                        <?php if (!empty($userStatus)) : ?>
                        <div class="alert <?php echo strpos($userStatus, 'successfully') !== false ? 'alert-primary' : 'alert-primary'; ?>"
                            id="successMessage" style="color:white">
                            <?php echo $userStatus; ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" onsubmit="return validateForm()">

                            <?php
                                        $select_user = "SELECT * FROM user WHERE user_id = '" . $_GET['user_id'] . "'";
                                        $result = mysqli_query($connect, $select_user);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" name="fullname" class="form-control" placeholder=""
                                        value="<?php echo $row['fullname'] ?>">
                                    <div class="error" id="fullnameError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder=""
                                        value="<?php echo $row['username'] ?>">
                                    <div class="error" id="usernameError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input type="text" name="course" class="form-control" placeholder=""
                                        value="<?php echo $row['course'] ?>">
                                    <div class="error" id="courseError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="year">year</label>
                                    <input type="number" name="year" class="form-control" placeholder=""
                                        value="<?php echo $row['year'] ?>">
                                    <div class="error" id="yearError"></div>
                                </div>



                            </div>

                            <div class="card-footer">
                                <center><button type="submit" name="update_data" class="btn btn-success">Submit</button>
                                </center>
                            </div>
                            <?php
                                            }
                                        }
                                        ?>

                        </form>
                    </div>

                </div>

                <div class="col-md-6">

                </div>

            </div>

        </div>
    </section>

</div>



<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>


<script>
function validateForm() {
    var fullname = document.getElementById('fullname').value.trim();
    var username = document.getElementById('username').value.trim();
    var course = document.getElementById('course').value.trim();
    var year = document.getElementById('year').value.trim();


    var isValid = true;
    document.getElementById('fullnameError').textContent = '';
    document.getElementById('usernameError').textContent = '';
    document.getElementById('courseError').textContent = '';
    document.getElementById('yearError').textContent = '';


    if (fullname === '') {
        document.getElementById('fullnameError').textContent = 'Fullname is required';
        isValid = false;
    }
    if (username === '') {
        document.getElementById('usernameError').textContent = 'username is required';
        isValid = false;
    }
    if (course === '') {
        document.getElementById('courseError').textContent = 'course is required';
        isValid = false;
    }
    if (year === '') {
        document.getElementById('yearError').textContent = 'year is required';
        isValid = false;
    }


    return isValid;
}
</script>


<?php include '../include/footer.php'; ?>