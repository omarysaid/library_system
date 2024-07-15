<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>

<?php
if (isset($_POST['update_data'])) {
    $book_id = $_GET['book_id'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $year = $_POST['year'];
     $publisher = $_POST['publisher'];
      $edition = $_POST['edition'];
  
    $errors = array(); 
    if (empty($name)) {
        $errors[] = "name is required";
    }
    if (empty($author)) {
        $errors[] = "author is required";
    }
    if (empty($year)) {
        $errors[] = "Year is required";
    }
     if (empty($publisher)) {
        $errors[] = "Year is required";
    }
     if (empty($edition)) {
        $errors[] = "Year is required";
    }
   
    if (empty($errors)) {
        $update_student = "UPDATE book SET name='$name', author='$author',  year='$year',  publisher='$publisher',  edition='$edition'
        WHERE book_id = '$book_id'";
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
                            <h3 class="card-title"><small>books Updation Form</small></h3>
                        </div>


                        <?php if (!empty($userStatus)) : ?>
                        <div class="alert <?php echo strpos($userStatus, 'successfully') !== false ? 'alert-danger' : 'alert-danger'; ?>"
                            id="successMessage" style="color:white">
                            <?php echo $userStatus; ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" onsubmit="return validateForm()">

                            <?php
                                        $select_book = "SELECT * FROM book WHERE book_id = '" . $_GET['book_id'] . "'";
                                        $result = mysqli_query($connect, $select_book);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fullname">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder=""
                                        value="<?php echo $row['name'] ?>">
                                    <div class="error" id="nameError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Author</label>
                                    <input type="text" name="author" class="form-control" placeholder=""
                                        value="<?php echo $row['author'] ?>">
                                    <div class="error" id="usernameError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="course">Year</label>
                                    <input type="text" name="year" class="form-control" placeholder=""
                                        value="<?php echo $row['year'] ?>">
                                    <div class="error" id="courseError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="publisher">Publisher</label>
                                    <input type="text" name="publisher" class="form-control" placeholder=""
                                        value="<?php echo $row['publisher'] ?>">
                                    <div class="error" id="publisherError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="edition">Edition</label>
                                    <input type="text" name="edition" class="form-control" placeholder=""
                                        value="<?php echo $row['edition'] ?>">
                                    <div class="error" id="editionError"></div>
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
<?php include '../include/footer.php'; ?>
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