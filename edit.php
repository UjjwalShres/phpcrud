<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'db.php';
    $id = $_GET['id'];

    $sql = "SELECT * FROM details WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $resultData = mysqli_fetch_assoc($result);

    $username = $resultData['username'];
    $email = $resultData['email'];
    $password = $resultData['password'];

    $usernameErr = $emailErr = $passwordErr = '';

    session_start();
    if (isset($_SESSION['email'])) {
        $editby = $_SESSION['email'];
    }

    if (isset($_POST['update'])) {


        // Validate Username
        if (empty($_POST['username'])) {
            $usernameErr = 'Username is required';
        } else {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Validate email
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

        if (isset($_SESSION['email'])) {
            $editby = $_SESSION['email'];
        }


        if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
            $sql = "UPDATE details SET username = '$username', email = '$email', password = '$password', editby = '$editby' WHERE id = '$id'";

            if (mysqli_query($conn, $sql)) {
                header('location: dashboard.php');
            } else {
                echo "Error:";
            }
            mysqli_close($conn);
        }
    }


    ?>



    <form class="form-container" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="username" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" id="username" name="username" placeholder="username" value="<?php echo $username; ?>">
            <div class="invalid-feedback">
                <?php echo $usernameErr; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" name="email" id="email" placeholder="example@gmail.com" value="<?php echo $email; ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <div class="invalid-feedback">
                <?php echo $emailErr; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>">
            <div class="invalid-feedback">
                <?php echo $passwordErr; ?>
            </div>
        </div>

        <button type="submit" name="update" class="btn btn-warning update">Update</button>
        <a href="dashboard.php">Go back to Dashboard →</a>
    </form>


</body>

</html>