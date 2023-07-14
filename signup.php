<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'db.php';
    $username = $email = $password = $valemail = '';
    $usernameErr = $emailErr = $passwordErr = '';




    if (isset($_POST['submit'])) {


        // Validate Username
        if (empty($_POST['username'])) {
            $usernameErr = 'Username is required';
        } else {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Validate email
        $valemail = $_POST['email'];
        $sql = "SELECT * FROM `details` WHERE email = '" . $valemail . "'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            echo '<div class="alert alert-danger text-center" role="alert">
            Email Already Exists! Choose another Email!!
            </div>';
        } else {
            if (empty($_POST['email'])) {
                $emailErr = 'Email is required';
            } else {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
            }

            // Validate password
            if (empty($_POST['password'])) {
                $passwordErr = 'password is required';
            } else {
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            }

            if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
                $sql = "INSERT INTO details (username, email, password) VALUES ('$username', '$email', '$password')";

                if (mysqli_query($conn, $sql)) {

                    header('location: index.php');
                } else {
                    echo "Error:";
                }
                mysqli_close($conn);
            } else {
                echo '<div class="alert alert-danger text-center" role="alert">
                Email or Password cannot be empty!
                </div>';
            }
        }
    }


    ?>



    <form class="form-container" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="username" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" id="username" name="username" placeholder="username">
            <div class="invalid-feedback">
                <?php echo $usernameErr; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" name="email" id="email" placeholder="example@gmail.com">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <div class="invalid-feedback">
                <?php echo $usernameErr; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" name="password" id="password" placeholder="Password">
            <div class="invalid-feedback">
                <?php echo $usernameErr; ?>
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        <a href="index.php">Already have an account? Log In Here</a>
    </form>


</body>

</html>