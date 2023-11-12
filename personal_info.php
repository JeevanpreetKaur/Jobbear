<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Display</title>
    <link rel="stylesheet" href="personal.css">
</head>

<body>
    <header>
        <h1>Personal Information Display</h1>
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


    <div class="container">
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

    // Retrieve the submitted personal information
    $sql = "SELECT * FROM personal_information ORDER BY id DESC LIMIT 1";
    $result = pg_query($conn, $sql);

    if (!$result) {
        echo "Error fetching personal information.";
    } else {
        // Display the search results
        $row = pg_fetch_assoc($result);
        echo "<strong>First Name: </strong>" . $row['first_name'] . "<br>". "<br>";
        echo "<strong>Last Name: </strong>" . $row['last_name'] . "<br>". "<br>";
        echo "<strong>Experience: </strong>" . $row['experience'] . "<br>". "<br>";
        echo "<strong>Education: </strong>" . $row['education'] . "<br>". "<br>";
        echo "<strong>Skills: </strong>" . $row['skills'] . "<br>". "<br>";
        echo "<strong>New Skills: </strong>" . $row['new_skills'] . "<br>". "<br>";
        echo "<strong>Certifications: </strong>" . $row['certifications'] . "<br>". "<br>";
    }

    pg_close($conn);
    ?>
    </div>

    <footer>
        <p>
        &copy; Jobear
        <br>
        <a href="mailto:helpdesk@gmail.com">JobearHelpDesk@gmail.com</a>
        </p>
    </footer>

</body>
</html>
