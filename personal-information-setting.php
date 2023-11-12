<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Information - Jobear</title>
  <link rel="stylesheet" href="personal.css">
  
  <style>
    /* Form styles */
    form {
      margin-top: 20px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    textarea,
    select {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    textarea {
      resize: vertical;
    }

    button[type="submit"],
    button[type="button"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .success-message {
      color: green;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Jobear</h1>
  </header>

  <nav>
    <div class="logo">
      <!-- Replace the source URL with your website logo image -->
      <img src="image/logo2.png" alt="Website Logo" class="secondImage">
    </div>

    <div class="navigation-links">
      <a href="home_after_login.html">Home</a>
      <a href="search.php">Search Jobs</a>
      <a href="application.php">Apply for Jobs</a>
      <a href="post-job.php">Post Jobs</a>
      <a href="personal-information-setting.php">Edit Personal Information</a>
      <a href="personal_info.php">Personal Information</a>
      <a href="about-us2.html">About Us</a>
    </div>
  </nav>

  <div class="container">
    <h2>Manage Personal Information</h2>
    <form method="post" action="personal-information-setting.php" enctype="multipart/form-data">
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" required><br>

      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" required><br>

      <label for="experience">Experience:</label>
      <select id="experience" name ="experience">
        <option value="">- Select Options -</option>
        <option value="High School">High School</option>
        <option value="Diploma">Diploma</option>
        <option value="Undergraduate">Undergraduate</option>
        <option value="Graduate">Graduate</option>
        <option value="Other">Other</option>
      </select><br>

      <label for="education">Education:</label>
      <textarea id="education" name="education" rows="4"></textarea><br>

    <label for="skills">Skills:</label>
    <select id="skills" name="skills">
      <optgroup label="Technical Skills">
        <option value="JavaScript">JavaScript</option>
        <option value="Python">Python</option>
        <option value="Java">Java</option>
        <!-- Add more technical skills options here -->
      </optgroup>
  </select>

    <label for="softSkills">Softskills:</label>
    <select id="softSkills" name="newSkills">
      <optgroup label="Soft Skills">
        <option value="Communication">Communication</option>
        <option value="Time Management">Time Management</option>
        <option value="Leadership">Leadership</option>
        <!-- Add more soft skills options here -->
      </optgroup>
  </select>
    <br>

 <label for="certifications">Certifications:</label>
      <textarea id="certifications" name="certifications" rows="4"></textarea><br>

      <label for="resume">Upload Resume:</label>
      <input type="file" id="resume"><br><br>

    <button type="submit">Update Information</button>
  </form>
  <!-- Success message, hidden by default -->
  <p class="success-message" id="successMessage" style="display: none;">Personal information updated successfully!</p>
</div>

<script>
  // JavaScript code to handle form submission and success message
  document.getElementById('personalInfoForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // You can handle form submission logic here, e.g., AJAX request to update user information on the server
    // After successful update, show the success message
    document.getElementById('successMessage').style.display = 'block';
  });
</script>

<?php
$host = 'localhost';
$dbname = 'INFO2413Project2';
$user = 'postgres';
$password = 'JN520122';

// Connect to the PostgreSQL database
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $first_name = pg_escape_string($_POST['firstName']);
    $last_name = pg_escape_string($_POST['lastName']);
    $experience = pg_escape_string($_POST['experience']);
    $education = pg_escape_string($_POST['education']);
    $skills = pg_escape_string($_POST['skills']);
    $new_skills = pg_escape_string($_POST['newSkills']);
    $certifications = pg_escape_string($_POST['certifications']);
   
    // Do query and store the data into the database
    $sql = "INSERT INTO personal_information (first_name, last_name, experience, education, skills, new_skills, certifications) VALUES ($1, $2, $3, $4, $5, $6, $7)";
    $result = pg_query_params($conn, $sql, array($first_name, $last_name, $experience, $education, $skills, $new_skills, $certifications));

    if ($result) {
      echo "<script>document.getElementById('successMessage').style.display = 'block';</script>";
      } else {
      echo "fail to insert" . pg_last_error($conn);
      }
}
pg_close($conn);

?>


 <footer>
    <p>
      &copy; Jobear
      <br>
      <a href="mailto:helpdesk@gmail.com">JobearHelpDesk@gmail.com</a>
    </p>
    
  </footer>
</body>
</html>
