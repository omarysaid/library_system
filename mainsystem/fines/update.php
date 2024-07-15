<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>

<?php
if (isset($_POST['update_data'])) {
    $fine_id = $_GET['fine_id'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
      $Status = $_POST['Status'];
  
    $errors = array(); 
    if (empty($amount)) {
        $errors[] = "amount is required";
    }
    if (empty($reason)) {
        $errors[] = "reason is required";
    }
 
     if (empty($Status)) {
        $errors[] = "status is required";
    }
   

    if (empty($errors)) {
        $update_fines = "UPDATE fine SET amount='$amount', reason='$reason',  Status='$Status'
        WHERE fine_id = '$fine_id'";

        if (mysqli_query($connect, $update_fines)) {
            $fineStatus= "Data updated successfully";
        } else {
            $fineStatus = "Error occurred while updating User";
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
                            <h3 class="card-title"><small>Fines Updation Form</small></h3>
                        </div>

                        <?php if (!empty(  $fineStatus)) : ?>
                        <div class="alert <?php echo strpos($fineStatus, 'successfully') !== false ? 'alert-primary' : 'alert-primary'; ?>"
                            id="successMessage" style="color:white">
                            <?php echo   $fineStatus; ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" onsubmit="return validateForm()">

                            <?php
                                        $select_fines = "SELECT * FROM fine WHERE fine_id = '" . $_GET['fine_id'] . "'";
                                        $result = mysqli_query($connect, $select_fines);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                            <div class="card-body">


                                <div class="form-group">
                                    <label for="course">amount</label>
                                    <input type="number" name="amount" class="form-control" placeholder=""
                                        value="<?php echo $row['amount'] ?>">
                                    <div class="error" id="amountError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="reason">Reason</label>
                                    <input type="text" name="reason" class="form-control" placeholder=""
                                        value="<?php echo $row['reason'] ?>">
                                    <div class="error" id="courseError"></div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="Status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="paid" <?php if ($row['Status'] === 'paid') echo ' selected'; ?>>
                                            Paid</option>
                                        <option value="unpaid"
                                            <?php if ($row['Status'] === 'unpaid') echo ' selected'; ?>>
                                            Unpaid</option>
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