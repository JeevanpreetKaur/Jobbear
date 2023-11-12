<!DOCTYPE html>
<html>

<head>
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
        <h2>Apply for a Job</h2>
        
        <form action="application.php" method="post">
            <label for="app_fname">First Name:</label>
            <input type="text" id="app_fname" name="app_fname" required><br><br>

            <label for="app_lname">Last Name:</label>
            <input type="text" id="app_lname" name="app_lname" required><br><br>

            <label for="jobid">Job ID:</label>
            <input type="number" id="jobid" name="jobid" required><br><br>

            <label for="apptitle">Job Title:</label>
            <input type="text" id="apptitle" name="apptitle" required><br><br>

            <label for="appdate">Apply Date:</label>
            <input type="date" id="appdate" name="appdate" required><br><br>

            <button type="submit">Apply Job</button>
        </form>
    </div>


    <?php
    // Connect to the database
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn_string = "host=localhost dbname=INFO2413Project2 user=postgres password=JN520122";
        $conn = pg_connect($conn_string);

        if (!$conn) {
            die("Connection failed!");
        }

        // Get the user's input
        $app_fname = $_POST['app_fname'];
        $app_lname = $_POST['app_lname'];
        $jobid = $_POST['jobid'];
        $apptitle = $_POST['apptitle'];
        $appdate = $_POST['appdate'];

        // Prepare the SQL query and insert data into the table
        $query = "INSERT INTO job_application (app_fname, app_lname, jobid, apptitle, appdate) VALUES ($1, $2, $3, $4, $5)";

        // Execute the query
        $result = pg_query_params($conn, $query, array($app_fname, $app_lname, $jobid, $apptitle, $appdate));

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

</body>
</html>


