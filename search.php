<!DOCTYPE html>
<html>

<!-- title and css links -->
<head>
    <title>Job Search Results</title>
    <link rel="stylesheet" href="personal.css">
</head>

<body>
    <header>
        <h1>JOBEAR</h1>
    </header>

    <nav>
        <div class="logo">
            <!-- Replace the source URL with your website logo image -->
            <img src="image/logo2.png" alt="Website Logo" class="secondImage">
        </div>

        <!--navigation bars -->
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

    <!-- search bar for the users to input keywords -->
    <div class="container">
        <form method="get">
            <label for="keywords">Keywords:</label>
            <input type="text" name="keywords" id="keywords" value="<?= isset($keywords) ? htmlentities($keywords) : ''; ?>"
                required>
            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    //set basic information of the database
    if (isset($_GET['keywords'])) {
        $host = 'localhost';
        $dbname = 'INFO2413Project2';
        $user = 'postgres';
        $password = 'JN520122';
        
        //connect to the database
        $conn_string = "host=" . $host . " dbname=" . $dbname . " user=" . $user . " password=" . $password;
        $conn = pg_connect($conn_string);

        if (!$conn) {
            die("Connection failed: " . pg_last_error());
        }

        //get keywords from the input
        $keywords = $_GET['keywords'];
        
        //set the number of the results that would be shown in each page
        $page = isset($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;
        $offset = ($page - 1) * 20;

        //qurey the database adn get the results
        $query = "SELECT * FROM job WHERE title ILIKE $1 OR description ILIKE $1 limit 20 offset $2";
        $result = pg_query_params($conn, $query, array("%$keywords%", $offset));

        if (!$result) {
            die("Query execution failed: " . pg_last_error());
        }

        $jobs = pg_fetch_all($result);

        //display the results
        if (isset($jobs) && count($jobs) > 0) {
            echo "<hr />";
            echo "<h2>Search results for '$keywords':</h2>";
            echo "<ul>";
            foreach ($jobs as $job) {
                echo "<li>";
                echo "<strong>Job ID:</strong> " . $job['jobid'] . "<br>";
                echo "<strong>Title:</strong> " . $job['title'] . "<br>";
                echo "<strong>Description:</strong> " . $job['description'] . "<br>";
                echo "<strong>Location:</strong> " . $job['location'] . "<br>" . "<br>";
                echo "</li>";
            }
            echo "</ul>";


            //set options for the user to filp pages
            echo "<br / >";
            echo '<a href="?keywords=' . $keywords . '&page=' . ($page - 1). '">Previous</a>';
            echo "&nbsp;	&nbsp;	&nbsp;	&nbsp;	";
            echo '<a href="?keywords=' . $keywords . '&page=' . ($page + 1). '">Next</a>';

        } else {
            echo "<p>No jobs found for '$keywords'.</p>";
        }
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