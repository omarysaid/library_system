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
                                    <th>NAME OF THE BOOK</th>

                                    <th>STUDENT</th>
                                    <th>START</th>
                                    <th>END </th>
                                    <th>STATUS</th>

                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$cnt = 1; 
$select_borrow =
    "SELECT borrow.*, book.*
    FROM borrow
    INNER JOIN book ON borrow.book_id = book.book_id";
$result = mysqli_query($connect, $select_borrow) or die(mysqli_error($connect));
$number = mysqli_num_rows($result);
if ($number > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
   
        ?>
                                <tr>
                                    <td><?php echo $cnt++; ?></td>
                                    <td><?php echo $row['name']; ?></td>

                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>


                                    <td>

                                        <span>
                                            <a href="./update.php?borrow_id=<?php echo $row['borrow_id'] ?>">
                                                <button class="btn btn-success" style="width: 40px;">
                                                    <i class="fa fa-pen"></i>

                                                </button>
                                            </a>
                                        </span>

                                        <span>
                                            <a href="../fines/add.php?borrow_id=<?php echo $row['borrow_id'] ?>">
                                                <button class="btn btn-primary" style="width: 40px;">
                                                    <i class="fa fa-dollar-sign"></i>

                                                </button>
                                            </a>
                                        </span>



                                        <span>
                                            <button class="btn btn-danger" style="width: 40px;"
                                                onclick="confirmDelete(<?php echo $row['borrow_id'] ?>)">
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
function confirmDelete(borrowId) {
    if (confirm("Are you sure you want to delete?")) {
        window.location.href = "./delete.php?borrow_id=" + borrowId;
    }
}
</script>


<?php include '../include/footer.php'; ?>