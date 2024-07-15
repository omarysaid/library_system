<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>STUDENT NO</th>

                                    <th>AMOUNT</th>
                                    <th>REASON</th>
                                    <th>STATUS</th>
                                    <th>ADDED DATE</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$cnt = 1; 
$select_fines=
    "SELECT fine.*, borrow.*
    FROM fine
    INNER JOIN borrow ON fine.borrow_id = borrow.borrow_id";
$result = mysqli_query($connect, $select_fines) or die(mysqli_error($connect));
$number = mysqli_num_rows($result);
if ($number > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
  
        ?>
                                <tr>
                                    <td><?php echo $cnt++; ?></td>

                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['reason']; ?></td>
                                    <td><?php echo $row['Status']; ?></td>

                                    <td><?php echo $row['created']; ?></td>
                                    <td>

                                        <span>
                                            <a href="./update.php?fine_id=<?php echo $row['fine_id'] ?>">
                                                <button class="btn btn-success" style="width: 40px;">
                                                    <i class="fa fa-pen"></i>

                                                </button>
                                            </a>
                                        </span>

                                        <span>
                                            <button class="btn btn-danger" style="width: 40px;"
                                                onclick="confirmDelete(<?php echo $row['fine_id'] ?>)">
                                                <i class="fa fa-trash"></i>

                                            </button>
                                        </span>



                                    </td>
                                </tr>
                                <?php
    }
} else {
    echo "<tr><td colspan='5'>0 results</td></tr>";
}
?>
                            </tbody>

                        </table>
                    </div>

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
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>


<script>
function confirmDelete(fineId) {
    if (confirm("Are you sure you want to delete?")) {
        window.location.href = "./delete.php?fine_id=" + fineId;
    }
}
</script>


<?php include '../include/footer.php'; ?>