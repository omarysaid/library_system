<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>

<div class="content-wrapper">
    <div class="card-header">
        <a href="./add.php"><button class="btn btn-success" style="margin-left: 10px;">New Book</button></a>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>BOOK</th>
                                    <th>AUTHOR</th>
                                    <th>YEAR</th>
                                    <th>PUBLISHER</th>
                                    <th>EDITION</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $cnt = 1;
                                        $select_books =
                                            "SELECT * FROM book  ";
                                        $result = mysqli_query($connect, $select_books) or die(mysqli_error($connect));
                                        $number = mysqli_num_rows($result);
                                        if ($number > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                <tr>
                                    <td><?php echo $cnt++; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td><?php echo $row['publisher']; ?></td>
                                    <td><?php echo $row['edition']; ?></td>


                                    <td>

                                        <span>
                                            <a href="./update.php?book_id=<?php echo $row['book_id'] ?>">
                                                <button class="btn btn-success" style="width: 50px;">
                                                    <i class="fa fa-pen"></i>

                                                </button>
                                            </a>
                                        </span>


                                        <span>
                                            <a href="../borrow/add.php?book_id=<?php echo $row['book_id'] ?>">
                                                <button class="btn btn-primary" style="width: 50px;">
                                                    <i class="fa fa-book"></i>

                                                </button>
                                            </a>
                                        </span>


                                        <span>
                                            <button class="btn btn-danger" style="width: 50px;"
                                                onclick="confirmDelete(<?php echo $row['book_id'] ?>)">
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
function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete?")) {
        window.location.href = "./delete.php?book_id=" + userId;
    }
}
</script>


</body>

</html>