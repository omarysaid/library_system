<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>

<?php
$bookborrowStatus = "";
$errors = [];

if (isset($_POST["add_borrow"])) {
    $book_id = $_POST['book_id'];
    $username = $_POST['username'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    if (empty($username)) {
        $errors[] = "Username is required";
    }
   
    if (empty($start_date)) {
        $errors[] = "Start date is required";
    }
    if (empty($end_date)) {
        $errors[] = "End date is required";
    }
    if (empty($status)) {
        $errors[] = "Status is required";
    }

    if (empty($errors)) {
        $insert_new_borrow = "INSERT INTO borrow (book_id, username, start_date, end_date, status) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($connect, $insert_new_borrow);
        mysqli_stmt_bind_param($stmt, "issss", $book_id, $username, $start_date, $end_date, $status);
    
        if (mysqli_stmt_execute($stmt)) {
            $bookborrowStatus = "Book borrowed successfully";
        } else {
            $bookborrowStatus = "Error occurred while borrowing book";
        }
        
        mysqli_stmt_close($stmt);
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
                            <h3 class="card-title"><small>Borrowing addition Form</small></h3>
                        </div>

                        <?php if (!empty($bookborrowStatus)) : ?>
                        <div class="alert <?php echo strpos($userStatus, 'successfully') !== false ? 'alert-danger' : 'alert-danger'; ?>"
                            id="successMessage" style="color:white">
                            <?php echo $bookborrowStatus; ?>
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
                                    <label for="fullname">Book_Name</label>
                                    <input type="text" class="form-control" placeholder=""
                                        value="<?php echo $row['name'] ?>">
                                    <div class="error" id="nameError"></div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="book_id" value="<?php echo $row['book_id'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="course">Student_Reg number</label>
                                    <input type="text" name="username" class="form-control" placeholder="">
                                    <div class="error" id="courseError"></div>
                                </div>



                                <div class="form-group">
                                    <label for="course">Start_Date</label>
                                    <input type="date" name="start_date" class="form-control" placeholder="">
                                    <div class="error" id="courseError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="course">End_Date</label>
                                    <input type="date" name="end_date" class="form-control" placeholder="">
                                    <div class="error" id="courseError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="returned">Returned</option>
                                        <option value="borrowed">Borrowed</option>
                                    </select>
                                    <div class="error" id="statusError"></div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" name="add_borrow" class="btn btn-success">Submit</button>
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