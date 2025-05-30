<?php
 
session_start();
require_once('classes/database.php');
$con = new database();
 
 
  $sweetAlertConfig = "" ;
 
     $id = $_POST['id'];
    $data = $con->viewGenreID($id);
 
 
 
if (isset($_POST['update_genre'])) {
    
    $id = $_POST['id'];
    $genre_name = $_POST['genre_name'];
   
  
    $GenreID = $con->updateGenre($genre_name, $id);
 
    if ($GenreID) {
        // Success alert
        $sweetAlertConfig = "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Update Successful',
          text: 'Genre has been updated successfully!',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'admin_homepage.php';
          }
        });
        </script>";
    } else {
        $_SESSION['error'] = "Sorry, there was an error updating.";
    }
}
 
?>
 
 
 
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./package/dist/sweetalert2.css">
 
 
  <title>update Genre</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Library Management System (Admin)</a>
          <div class="d-flex ms-auto">
          <a class="btn btn-outline-light ms-auto" href="add_authors.php">Add Authors</a>
          <a class="btn btn-outline-light ms-2" href="add_genres.php">Add Genres</a>
          <a class="btn btn-outline-light ms-2" href="add_books.html">Add Books</a>
      <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
          <div class="dropdown ms-2">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> <!-- Bootstrap icon -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <li>
                  <a class="dropdown-item" href="profile.html">
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
    <h4 class="mt-5">Edit Genre</h4>
 
    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
 
    <form method="POST">
      <div class="mb-3">
        <label for="genre_name"   class="form-label">Genre Name</label>
        <input type="text" value="<?php echo $data["genre_name"]?>" class="form-control" name="genre_name" id="genre_name" required>
      </div>
        <input type="hidden" name ="id" value = "<?php echo $data["genre_id"]?>" >
      <button type="submit" name="update_genre" class="btn btn-primary">Add Genre</button>
 
    </form>
       <script src="./package/dist/sweetalert2.js"></script>
 
    <?php echo $sweetAlertConfig; ?>
  </div>
 
  <script src="./package/dist/sweetalert2.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
 