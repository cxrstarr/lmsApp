<?php
require_once('classes/database.php');

$sweetAlertConfig = "";

if (isset($_POST['add_genre'])) {
    $genreName = $_POST['genre_name'];
    $con = new database();
    $result = $con->addGenre($genreName);

    if ($result) {
        $sweetAlertConfig = "<script>
            Swal.fire({
                icon: 'success',
                title: 'Genre Added',
                text: 'The genre was added successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'add_genres.php';
            });
        </script>";
    } else {
        $sweetAlertConfig = "<script>
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Genre could not be added. Try again.',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="./package/dist/sweetalert2.css">
  <title>Genres</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Library Management System (Admin)</a>
      <a class="btn btn-outline-light ms-auto" href="add_authors.php">Add Authors</a>
      <a class="btn btn-outline-light ms-2 active" href="add_genres.php">Add Genres</a>
      <a class="btn btn-outline-light ms-2" href="add_books.php">Add Books</a>
      <div class="dropdown ms-2">
        <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li>
            <a class="dropdown-item" href="profile.php">
                <i class="bi bi-person-circle me-2"></i> See Profile Information
            </a>
          </li>
          <li>
            <button class="dropdown-item" onclick="updatePersonalInfo()">
              <i class="bi bi-pencil-square me-2"></i> Update Personal Information
            </button>
          </li>
          <li>
            <button class="dropdown-item" onclick="updatePassword()">
              <i class="bi bi-key me-2"></i> Update Password
            </button>
          </li>
          <li>
            <button class="dropdown-item text-danger" onclick="logout()">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container my-5 border border-2 rounded-3 shadow p-4 bg-light">
    <h4 class="mt-5">Add New Genre</h4>
    <form method="POST" action="add_genres.php">
      <div class="mb-3">
        <label for="genre_name" class="form-label">Genre Name</label>
        <input type="text" class="form-control" name="genre_name" id="genre_name" required>
      </div>
      <button type="submit" name="add_genre" class="btn btn-primary">Add Genre</button>
    </form>
  </div>

  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <script src="./package/dist/sweetalert2.js"></script>
  <?php echo $sweetAlertConfig; ?>

</body>
</html>
