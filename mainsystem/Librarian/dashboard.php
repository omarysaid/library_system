<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" style="font-family: Georgia, 'Times New Roman', Times, serif;">
                        LIBRARIAN_DASHBOARD </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content" style="margin-top: 30px;">
        <div class="container-fluid shadow">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box" style="height: 120px;">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-graduate"></i></span>
                        <div class="info-box-content">
                            <?php
                            $sql = "SELECT COUNT(*) AS total_users FROM user WHERE username <> 'librarian'";
                            $result = $connect->query($sql);
                            $total_users = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total_users = $row["total_users"];
                            }
                            ?>
                            <center><span class="info-box-text">STUDENTS</span></center>
                            <hr>
                            <center><span class="info-box-number">0<?php echo $total_users; ?></span></center>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book-open"></i></span>
                        <?php
                        $sql = "SELECT COUNT(*) AS total_books FROM book";
                        $result = $connect->query($sql);
                        $total_books = 0;
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_books = $row["total_books"];
                        }
                        ?>
                        <div class="info-box-content" style="height: 106px;">
                            <center><span class="info-box-text">BOOKS</span></center>
                            <hr>
                            <center><span class="info-box-number">0<?php echo $total_books; ?></span></center>
                        </div>

                    </div>

                </div>

                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book-reader"></i></span>
                        <?php
                        $sql = "SELECT COUNT(*) AS total_books FROM borrow WHERE status = 'borrowed'";
                        $result = $connect->query($sql);
                        $total_books = 0;
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_books = $row["total_books"];
                        }
                        ?>
                        <div class="info-box-content" style="height: 106px;">
                            <center><span class="info-box-text">BORROWED</span></center>
                            <hr>
                            <center><span class="info-box-number">0<?php echo $total_books; ?></span></center>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-address-book"></i></span>
                        <?php
                        $sql = "SELECT COUNT(*) AS total_books FROM borrow WHERE status = 'returned'";
                        $result = $connect->query($sql);
                        $total_books = 0;
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_books = $row["total_books"];
                        }
                        ?>
                        <div class="info-box-content" style="height: 106px;">
                            <center><span class="info-box-text">RETURNED</span></center>
                            <hr>
                            <center><span class="info-box-number">0<?php echo $total_books; ?></span></center>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box" style="height: 100px;">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>
                        <?php
                        $sql = "SELECT COUNT(*) AS total_fines FROM fine";
                        $result = $connect->query($sql);
                        $total_fines = 0;
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_fines = $row["total_fines"];
                        }
                        ?>
                        <div class="info-box-content">
                            <center><span class="info-box-text">TOTAL_FINES</span></center>
                            <hr>
                            <center><span class="info-box-number">0<?php echo $total_fines; ?></span></center>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-gradient-warning elevation-1"><i
                                class="fas fa-dollar-sign"></i></span>
                        <?php
                        $sql = "SELECT COUNT(*) AS total_fines FROM fine WHERE Status = 'paid'";
                        $result = $connect->query($sql);
                        $total_fines = 0;
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_fines = $row["total_fines"];
                        }
                        ?>
                        <div class="info-box-content" style="height: 86px;">
                            <center><span class="info-box-text">PAID_FINES</span></center>
                            <hr>
                            <center><span class="info-box-number">0<?php echo $total_fines; ?></span></center>
                        </div>

                    </div>

                </div>

                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-gradient-danger elevation-1"><i
                                class="fas fa-dollar-sign"></i></span>
                        <?php
                        $sql = "SELECT COUNT(*) AS total_fines FROM fine WHERE Status = 'unpaid'";
                        $result = $connect->query($sql);
                        $total_fines = 0;
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_fines = $row["total_fines"];
                        }
                        ?>
                        <div class="info-box-content" style="height: 86px;">
                            <center><span class="info-box-text">UNPAID_FINES</span></center>
                            <hr>
                            <center><span class="info-box-number">0<?php echo $total_fines; ?></span></center>
                        </div>

                    </div>

                </div>
            </div>

    </section>
</div>
<?php include '../include/footer.php'; ?>