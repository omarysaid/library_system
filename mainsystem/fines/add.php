<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>

<?php
$finesStatus = "";
$errors = [];

if (isset($_POST["add_fines"])) {
    $borrow_id = $_POST['borrow_id'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];
  
    if (empty($amount)) {
        $errors[] = "Amount is required";
    }
   
    if (empty($reason)) {
        $errors[] = "reason date is required";
    }
  
    if (empty($status)) {
        $errors[] = "Status is required";
    }

    if (empty($errors)) {
        $insert_new_fines = "INSERT INTO fine (borrow_id, amount, reason, status) VALUES (?, ?, ?, ?)";
    
        $stmt = mysqli_prepare($connect, $insert_new_fines);
        mysqli_stmt_bind_param($stmt, "isss", $borrow_id, $amount, $reason, $status);
    
        if (mysqli_stmt_execute($stmt)) {
            $finesStatus = "Fines Added successfully";
        } else {
            $finesStatus = "Error occurred while borrowing book";
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
                            <h3 class="card-title"><small>fines addition Form</small></h3>
                        </div>


                        <?php if (!empty(  $finesStatus)) : ?>
                        <div class="alert <?php echo strpos($borrowStatus, 'successfully') !== false ? 'alert-danger' : 'alert-danger'; ?>"
                            id="successMessage" style="color:white">
                            <?php echo   $finesStatus; ?>
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
                                    <input type="text" class="form-control" placeholder=""
                                        value="<?php echo $row['username'] ?>">
                                    <div class="error" id="usernameError"></div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="borrow_id" value="<?php echo $row['borrow_id'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount(Tshs)</label>
                                    <input type="number" name="amount" class="form-control" placeholder="Enter Amount">
                                    <div class="error" id="courseError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="reason">Reason</label>
                                    <textarea name="reason" id="reason" class="form-control"
                                        placeholder="Enter reason"></textarea>
                                    <div class="error" id="reasonError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                    <div class="error" id="statusError"></div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" name="add_fines" class="btn btn-success">Submit</button>
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