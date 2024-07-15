<?php
session_start();
include '../connection/connection.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to join book and borrow tables with search functionality
$sql = "SELECT b.name, b.author, b.year, b.publisher, b.edition, br.start_date, br.end_date, br.status
        FROM book b
        LEFT JOIN borrow br ON b.book_id = br.book_id
        WHERE b.name LIKE '%$search%' OR b.author LIKE '%$search%' OR b.publisher LIKE '%$search%' OR b.edition LIKE '%$search%'";

$result = $connect->query($sql);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Library Management System</title>
    <style>
    body {
        font-family: Georgia, 'Times New Roman', Times, serif;
    }
    </style>
</head>

<body>

    <div class="container shadow fixed-top" style="background-color:#FF6347; height:100px;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <img src="../Assets/images/logoo.jpg"
                    style="height:80px; width:100px; border-radius:20px; margin-top:10px">
            </div>
            <div class="col-md-5 d-flex justify-content-between align-items-center">
                <h2 style="color:white; font-size:25px; margin:0">
                    Library Management System</h2>
                <a href="../../index.php"><button class="btn btn"
                        style="height:50px;width:100px; margin-top:15px; background-color:Olive">Log
                        Out</button></a>
            </div>
        </div>

    </div>
    <div class="container " style="height:230px; background-color:#FF6347; margin-top:110px">
        <div class="owl-carousel slide-one-item" style="margin-top:14px">
            <div class="d-md-flex testimony-29101 align-items-stretch" style="height:220px">
                <div class="image" style="background-image: url('./assets/images/liii.jpg');"></div>
                <div class="text" style="background-color:#094469">
                    <blockquote>
                        <p style="color:white">&ldquo;Library management involves the systematic organization,
                            administration, and maintenance of a library's resources to ensure efficient access and
                            utilization of books. .&rdquo;</p>
                    </blockquote>
                </div>
            </div>
            <div class="d-md-flex testimony-29101 align-items-stretch" style="height:220px">
                <div class="image" style="background-image: url('./assets/images/library1.jpg');"></div>
                <div class="text" style="background-color:#094469">
                    <blockquote>
                        <p style="color:white">&ldquo; Collection development involves selecting, acquiring, and
                            maintaining a diverse array of resources, such as books, journals, multimedia materials,
                            and digital resources, to meet the informational and recreational needs of the library's
                            users.&rdquo;</p>
                    </blockquote>
                </div>
            </div>
            <div class="d-md-flex testimony-29101 align-items-stretch" style="height:220px">
                <div class="image" style="background-image: url('./assets/images/library2.jpg');"></div>
                <div class="text" style="background-color:#094469">
                    <blockquote>
                        <p style="color:white">&ldquo;this Cataloging plays a crucial role in library management by
                            creating structured records for each item in the library's collection, enabling patrons
                            to locate resources through a catalog or online database..&rdquo;</p>
                    </blockquote>
                </div>
            </div>
        </div>

    </div>
    <div class="container" style="background-color:#FF6347">
        <div class="container shadow" style=" background-color:#094469">
            <center>
                <h5 style="color:white;">The Lists of Books available
                    from our Campus
                </h5>
                <form method="get" action="">
                    <input type="text" name="search" placeholder="Search books..."
                        value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn btn-light">Search</button>
                </form>
            </center>
            <div class="row" style="margin-top:30px">
                <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Set default status to "Available"
                    $status = "Available";

                    if ($row["status"] !== null && $row["status"] !== "returned") {
                        $start_date = new DateTime($row["start_date"]);
                        $end_date = new DateTime($row["end_date"]);
                        $status = "Borrowed";
                    }

                    echo '<div class="col-md-4 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row["name"] . '</h5><hr style="background-color:green">
                                    <h6 class="card-subtitle mb-2">Author: ' . $row["author"] . '</h6>
                                    <h6 class="card-text">
                                        <strong>Year:</strong> ' . $row["year"] . '<br>
                                        <strong>Publishers:</strong> ' . $row["publisher"] . '<br>
                                        <strong>Edition:</strong> ' . $row["edition"] . '<br>
                                        <span style="color:' . ($status == "Borrowed" ? "#dc3545;" : "#28a745;") . '">' . $status . '</span>';
                    
                    if ($status == "Borrowed") {
                        echo '<br><br><strong>From:</strong> ' . $start_date->format('d/m/Y') . '<br>
                              <strong>To:</strong> ' . $end_date->format('d/m/Y');
                    }
                    
                    echo '</h6>
                                </div>
                            </div>
                          </div>';
                }
            } else {
                echo '<div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            No records found.
                        </div>
                    </div>';
            }
            ?>
            </div>
        </div>
    </div>
    </div>
    <script src="./assets/js/jquery-3.3.1.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>

<?php
$connect->close();
?>