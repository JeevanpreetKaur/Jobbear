<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
</head>

<!-- title and css links -->
<head>
    <title>Sign In</title>
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

        <!--navigation bars -->
        <div class="navigation-links">
            <a href="home-page.html">Home</a>
            <a href="signin.php">Log In</a>
            <a href="about-us.html">About Us</a>
        </div>
    </nav>

    <!-- input bars for the users to sign up -->
    <div class="container">
    <h2>Sign Up to Jobear</h2>
        <form action="signup.php" method="post"> 
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" required>
            <br><br>
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br><br>
            <input type="submit" value="signup">
        </form>

        <p>Already have an account? <a href="signin.php">Sign In</a></p>

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

<?php
//connect to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn_string = "host=localhost dbname=INFO2413Project2 user=postgres password=JN520122";
    $conn = pg_connect($conn_string);

    if (!$conn) {
        die("Connection Failed!");
    }

    // get users input
    $firstname = pg_escape_string($_POST['firstname']);
    $lastname = pg_escape_string($_POST['lastname']);
    $email = pg_escape_string($_POST['email']);
    $password = pg_escape_string($_POST['password']);

    // check if the email is already exist
    $checkEmailSql = "SELECT jemail FROM Job_Seeker WHERE jemail = $1";
    $checkEmailResult = pg_query_params($conn, $checkEmailSql, array($email));

    $checkEmailSql2 = "SELECT user_email FROM signup WHERE user_email = $1";
    $checkEmailResult2 = pg_query_params($conn, $checkEmailSql2, array($email));

    if (pg_num_rows($checkEmailResult) > 0 || pg_num_rows($checkEmailResult2) > 0) {
        echo "This Email is already exist! Please use another Email!";
        pg_close($conn);
        exit;
    }

    // insert the data into the database
    $sql = "INSERT INTO signup (user_fname, user_lname, user_email, user_password) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $sql, array($firstname, $lastname,$email, $password));

    if ($result) {
        echo "Sign up success!";
    } else {
        echo "Sign up failed! Please try later!";
    }

    pg_close($conn);

    header("Location: signin.php");
}
?>