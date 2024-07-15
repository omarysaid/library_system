<?php include '../include/header.php'; ?>
<?php include '../include/sidebar.php'; ?>
<?php
$bookAddStatus = "";
$errors = [];
if (isset($_POST["add_book"])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $publisher = $_POST['publisher'];
    $edition = $_POST['edition'];

    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($author)) {
        $errors[] = "Author is required";
    }
    if (empty($year)) {
        $errors[] = "Year is required";
    }
       if (empty($publisher)) {
        $errors[] = "publisher is required";
    }
       if (empty($edition)) {
        $errors[] = "Edition is required";
    }
    if (empty($errors)) {
        $insert_new_book = "INSERT INTO book (name, author, year, publisher, edition) VALUES('$name','$author','$year','$publisher','$edition');";

        if (mysqli_query($connect, $insert_new_book)) {
          
            $bookAddStatus = "Book added successfully";
        } else {
         
            $bookAddStatus = "Error occurred while adding book";
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
                            <h3 class="card-title"><small>Books Form</small></h3>
                        </div>
                        <?php if (!empty($bookAddStatus)) : ?>
                        <div class="alert <?php echo strpos($userStatus, 'successfully') !== false ? 'alert-danger' : 'alert-danger'; ?>"
                            id="successMessage" style="color:white">
                            <?php echo $bookAddStatus; ?>
                        </div>
                        <?php endif; ?>
                        <form method="POST" onsubmit="return validateForm()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fullname">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter book name">
                                    <div id="nameError" class="error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Author</label>
                                    <input type="text" id="author" name="author" class="form-control"
                                        placeholder="Enter Author name">
                                    <div id="authorError" class="error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="course">Year</label>
                                    <input type="number" id="year" name="year" class="form-control"
                                        placeholder="Enter Year">
                                    <div id="yearError" class="error"></div>
                                </div>

                                <div class="form-group">
                                    <label for="course">Publisher</label>
                                    <input type="text" id="publisher" name="publisher" class="form-control"
                                        placeholder="Enter Publisher">
                                    <div id="publisherError" class="error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="course">Edition</label>
                                    <input type="text" id="edition" name="edition" class="form-control"
                                        placeholder="Enter Book Edition">
                                    <div id="editionError" class="error"></div>
                                </div>
                                <div class="card-footer">
                                    <center> <button type="submit" name="add_book"
                                            class="btn btn-success">Submit</button></center>
                                </div>
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
    var name = document.getElementById('name').value.trim();
    var author = document.getElementById('author').value.trim();
    var year = document.getElementById('year').value.trim();
    var publisher = document.getElementById('publisher').value.trim();
    var edition = document.getElementById('edition').value.trim();
    var nameInput = document.getElementById('name');
    var authorInput = document.getElementById('author');
    var yearInput = document.getElementById('year');
    var publisherInput = document.getElementById('publisher');
    var editionInput = document.getElementById('edition');
    var nameError = document.getElementById('nameError');
    var authorError = document.getElementById('authorError');
    var yearError = document.getElementById('yearError');
    var publisherError = document.getElementById('publisherError');
    var editionError = document.getElementById('editionError');
    var isValid = true;
    // Validate name
    if (name === "") {
        nameInput.style.borderColor = "red";
        nameError.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
        nameError.style.color = "red";
        nameError.style.fontWeight = "bold";
        isValid = false;
    } else {
        nameInput.style.borderColor = "";
        nameError.innerHTML = "";
    }
    if (author === "") {
        authorInput.style.borderColor = "red";
        authorError.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
        authorError.style.fontWeight = "bold";
        isValid = false;
    } else {
        authorInput.style.borderColor = "";
        authorError.innerHTML = "";
    }
    // Validate year
    if (year === "") {
        yearInput.style.borderColor = "red";
        yearError.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
        yearError.style.color = "red";
        yearError.style.fontWeight = "bold";
        isValid = false;
    } else {
        yearInput.style.borderColor = "";
        yearError.innerHTML = "";
    }
    if (publisher === "") {
        publisherInput.style.borderColor = "red";
        publisherError.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
        publisherError.style.color = "red";
        publisherError.style.fontWeight = "bold";
        isValid = false;
    } else {
        publisherInput.style.borderColor = "";
        publisherError.innerHTML = "";
    }
    // Validate edition
    if (edition === "") {
        editionInput.style.borderColor = "red";
        editionError.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
        editionError.style.color = "red";
        editionError.style.fontWeight = "bold";
        isValid = false;
    } else {
        editionInput.style.borderColor = ""; // Clear border color
        editionError.innerHTML = ""; // Clear previous error message
    }
    return isValid;
}
</script>
</body>

</html>