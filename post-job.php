<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jobear - Job Search and Posting</title>
   <link rel="stylesheet" href="personal.css">
  
  
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
    
    <h2>Request to Post Job</h2>
    <form action="post-job.php" method="post">

      <label for="reqtitle">Job Title:</label>
      <input type="text" id="reqtitle" name="reqtitle"><br><br>

      <label for="jobrequirements">Job Requirements:</label>
      <textarea id="jobrequirements" name="jobrequirements" rows="4"></textarea><br><br>

      <label for="salary">Salary Required:</label>
      <input type="text" id="salary" name="salary"><br><br>

      <label for="skillsreq">Skills Required:</label>
      <input type="text" id="skillsreq" name="skillsreq"><br><br>

      <label for="compadd">Company Address Link:</label>
      <input type="text" id="compadd" name="compadd"><br><br>

      <label for="jobrolesrespons">Job Roles and Responsibilities:</label>
      <textarea id="jobrolesrespons" name="jobrolesrespons" rows="4"></textarea><br><br>

      <label for="companyCertificate">Company Certificate for Validation:</label>
      <input type="file" id="companyCertificate"><br><br>

      <button type="submit">Request to Post Job</button>
    </form>
    <!-- Success message, hidden by default -->
    <p class="success-message" id="successMessage" style="display: none;">Request send successfully!</p>
  </div>

  <?php
    // Connect to the database
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn_string = "host=localhost dbname=INFO2413Project2 user=postgres password=JN520122";
        $conn = pg_connect($conn_string);

        if (!$conn) {
            die("Connection failed!");
        }

        $reqtitle = $_POST['reqtitle'];
        $jobrequirements = $_POST['jobrequirements'];
        $salary = $_POST['salary'];
        $skillsreq = $_POST['skillsreq'];
        $compadd = $_POST['compadd'];
        $jobrolesrespons = $_POST['jobrolesrespons'];

        // Prepare the SQL query and insert data into the table
        $query = "INSERT INTO job_post_requests (reqtitle, jobrequirements, salary, skillsreq, compadd, jobrolesrespons) VALUES ($1, $2, $3, $4, $5, $6)";

        // Execute the query
        $result = pg_query_params($conn, $query, array($reqtitle, $jobrequirements, $salary, $skillsreq, $compadd, $jobrolesrespons));

        if ($result) {
            echo "Application submitted successfully!";
        } else {
            echo "Error: " . pg_last_error($conn);
        }

        // Close the database connection
        pg_close($conn);

    }
    ?>

  <footer>
    <p>
      &copy; Jobear
      <br>
      <a href="mailto:helpdesk@gmail.com">JobearHelpDesk@gmail.com</a>
    </p>
    
  </footer>

  <script>
    // JavaScript code to handle form submission and success message
    document.getElementById('postJobForm').addEventListener('submit', function(event) {
      event.preventDefault();
      // You can handle form submission logic here, e.g., AJAX request to submit the data to the server
      // After successful submission, show the success message
      document.getElementById('successMessage').style.display = 'block';
    });

    document.getElementById('updateJobButton').addEventListener('click', function() {
      // You can add code here to refill the form with existing job data for updating
      // For simplicity, this button is just a placeholder and doesn't have any specific functionality in this example
    });
  </script>

</body>
</html>
