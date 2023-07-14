<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'db.php';
    session_start();

    if (isset($_POST['submit'])) {

        $email = $_POST['email'];

        // Created Session
        $_SESSION['email'] = $email;
        $password = $_POST['password'];

        $sql = "SELECT * FROM `details` WHERE email = '" . $email . "' AND password = '" . $password . "'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            header('location: dashboard.php');
        } else {
            echo '<div class="alert alert-danger text-center" role="alert">
                    Invalid Email address or Password!
                    </div>';
        }
    }

    ?>

    <form class="form-container" method="POST">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Log In</button>
        <a href="signup.php">Create an account? Sign Up Here</a>
    </form>
</body>

</html>