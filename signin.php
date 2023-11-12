<!DOCTYPE html>
<html>

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

    <!-- input bars for the users to log in -->
    <div class="container">
        <h2>Sign In to Jobear</h2>
        <form action="signin.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br><br>
            <input type="submit" value="login">
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
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
        die("Connection failed!");
    }

    //get data from the inputs
    $email = pg_escape_string($_POST['email']);
    $password = pg_escape_string($_POST['password']);

    //query the database
    $sql = "SELECT 'signup' as user_type, user_email as email, user_password as password FROM signup WHERE user_email = $1
    UNION
    SELECT 'job_seeker' as user_type, jemail as email, jpassword as password FROM job_seeker WHERE jemail = $1
    UNION
    SELECT 'moderator' as user_type, memail as email, password as password FROM moderator WHERE memail = $1
    UNION
    SELECT 'employer' as user_type, empemail as email, emppassword as password FROM employer WHERE empemail = $1";


    $result = pg_query_params($conn, $sql, array($email));

    //check if the password and the email are match
    if ($result && pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    $db_password = $row['password'];

        if ($password === $db_password) {
            //start a session to access user information
            session_start();
            $email = $_SESSION['email'];

            header('Location: home_after_login.html');
            exit();
        } else {
            echo "Wrong password!";
        }
    } else {
        echo "Email does not exist!";
    }    

    pg_close($conn);
}
?>