<?php

if (empty($_SESSION['user_id'])) {
    header('location:login.php');
    exit();

  }


session_start();
require_once('classes/database.php'); 

$sweetAlertConfig = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $authorFirstName = $_POST['authorFirstName'];
    $authorLastName = $_POST['authorLastName'];
    $authorBirthYear = $_POST['authorBirthYear'];
    $authorNationality = $_POST['authorNationality'];

    
    $con = new database(); 

    $sql = "INSERT INTO authors (author_FN, author_LN, author_birthday, author_nat) 
            VALUES (:firstName, :lastName, :birthYear, :nationality)";
    
    try {
        
        $conn = $con->opencon();
        
        
        $stmt = $conn->prepare($sql);

        
        $stmt->bindParam(':firstName', $authorFirstName);
        $stmt->bindParam(':lastName', $authorLastName);
        $stmt->bindParam(':birthYear', $authorBirthYear);
        $stmt->bindParam(':nationality', $authorNationality);

        
        $stmt->execute();

        
        $sweetAlertConfig = "<script>
            Swal.fire({
                icon: 'success',
                title: 'Author Added Successfully!',
                text: 'The author has been added to the database.',
                confirmButtonText: 'Ok'
            }).then(() => {
                window.location.href = 'add_authors.php';
            });
        </script>";

    } catch (PDOException $e) {
        
        $sweetAlertConfig = "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error Adding Author',
                text: 'An error occurred: " . $e->getMessage() . "',
                confirmButtonText: 'Ok'
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
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> Correct Bootstrap Icons CSS -->
  <title>Authors</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Library Management System (Admin)</a>
      <a class="btn btn-outline-light ms-auto active" href="add_authors.php">Add Authors</a>
      <a class="btn btn-outline-light ms-2" href="add_genres.php">Add Genres</a>
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
    <h4 class="mt-5">Add New Author</h4>
    <form method="POST" action="add_authors.php">
      <div class="mb-3">
        <label for="authorFirstName" class="form-label">First Name</label>
        <input type="text" class="form-control" name="authorFirstName" required>
      </div>
      <div class="mb-3">
        <label for="authorLastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="authorLastName" required>
      </div>
      <div class="mb-3">
        <label for="authorBirthYear" class="form-label">Birth Date</label>
        <input type="date" class="form-control" name="authorBirthYear" max="<?= date('Y-m-d') ?>" required>
      </div>
      <div class="mb-3">
        <label for="authorNationality" class="form-label">Nationality</label>
        <select class="form-select" name="authorNationality" required>
          <option value="" disabled selected>Select Nationality</option>
          <option value="Filipino">Filipino</option>
          <option value="American">American</option>
          <option value="British">British</option>
          <option value="Canadian">Canadian</option>
          <option value="Chinese">Chinese</option>
          <option value="French">French</option>
          <option value="German">German</option>
          <option value="Indian">Indian</option>
          <option value="Japanese">Japanese</option>
          <option value="Mexican">Mexican</option>
          <option value="Russian">Russian</option>
          <option value="South African">South African</option>
          <option value="Spanish">Spanish</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Add Author</button>
      <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <script src="./package/dist/sweetalert2.js"></script>
  <?php echo $sweetAlertConfig; ?>
    </form>
    
  </div>


  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
