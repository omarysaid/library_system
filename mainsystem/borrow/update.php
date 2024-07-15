<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>


<?php
if (isset($_POST['update_data'])) {
    $borrow_id = $_GET['borrow_id'];
    $username = $_POST['username'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
     $publisher = $_POST['publisher'];
      $status = $_POST['status'];
  
    $errors = array(); 
    if (empty($username)) {
        $errors[] = "username is required";
    }
    if (empty($start_date)) {
        $errors[] = "date is required";
    }
    if (empty($end_date)) {
        $errors[] = "date is required";
    }
     if (empty($status)) {
        $errors[] = "Year is required";
    }
   
    if (empty($errors)) {
        $update_student = "UPDATE borrow SET username='$username', start_date='$start_date',  end_date='$end_date',  status='$status'
        WHERE borrow_id = '$borrow_id'";

        if (mysqli_query($connect, $update_student)) {
        
            $borrowStatus= "Data updated successfully";
        } else {
            
            $borrowStatus = "Error occurred while updating User";
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
                            <h3 class="card-title"><small>Books-Borrowing Updation Form</small></h3>
                        </div>


                        <?php if (!empty(  $borrowStatus)) : ?>
                        <div class="alert <?php echo strpos($borrowStatus, 'successfully') !== false ? 'alert-primary' : 'alert-primary'; ?>"
                            id="successMessage" style="color:white">
                            <?php echo   $borrowStatus; ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" onsubmit="return validateForm()">

                            <?php
                                        $select_book = "SELECT * FROM borrow WHERE borrow_id = '" . $_GET['borrow_id'] . "'";
                                        $result = mysqli_query($connect, $select_book);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fullname">Student_Reg no</label>
                                    <input type="text" name="username" class="form-control" placeholder=""
                                        value="<?php echo $row['username'] ?>">
                                    <div class="error" id="usernameError"></div>
                                </div>


                                <div class="form-group">
                                    <label for="course">Start_Date</label>
                                    <input type="date" name="start_date" class="form-control" placeholder=""
                                        value="<?php echo $row['start_date'] ?>">
                                    <div class="error" id="courseError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="course">Start_Date</label>
                                    <input type="date" name="end_date" class="form-control" placeholder=""
                                        value="<?php echo $row['end_date'] ?>">
                                    <div class="error" id="courseError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="returned"
                                            <?php if ($row['status'] === 'returned') echo ' selected'; ?>>
                                            Returned</option>
                                        <option value="borrowed"
                                            <?php if ($row['status'] === 'borrowed') echo ' selected'; ?>>
                                            Borrowed</option>
                                    </select>
                                    <div class="error" id="statusError"></div>
                                </div>


                            </div>

                            <div class="card-footer">
                                <center> <button type="submit" name="update_data"
                                        class="btn btn-success">Submit</button></center>
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