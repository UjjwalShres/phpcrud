<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="mygridstyles.css">
</head>

<body>
    <?php include 'db.php';
    include 'navbar.php';
    include 'search.php';


    $firstName = $lastName = $gender = $bloodgrp = $qualification = $address = '';
    $firstNameErr = $lastNameErr = $genderErr = $bloodgrpErr = $qualificationErr = $addressErr = '';




    if (isset($_POST['submit'])) {


        // Validate firstName
        if (empty($_POST['firstName'])) {
            $firstNameErr = 'firstName is required';
        } else {
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Validate lastName
        if (empty($_POST['lastName'])) {
            $lastNameErr = 'lastName is required';
        } else {
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Validate email
        // if (empty($_POST['email'])) {
        //     $emailErr = 'Email is required';
        // } else {
        //     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        // }

        // Validate gender
        if (empty($_POST['gender'])) {
            $genderErr = 'gender is required';
        } else {
            $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Validate bloodgrp
        if (empty($_POST['bloodgrp'])) {
            $bloodgrpErr = 'bloodgrp is required';
        } else {
            $bloodgrp = filter_input(INPUT_POST, 'bloodgrp', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Validate qualification
        if (empty($_POST['qualification'])) {
            $qualificationErr = 'qualification is required';
        } else {
            $qualification = filter_input(INPUT_POST, 'qualification', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Validate address
        if (empty($_POST['address'])) {
            $addressErr = 'address is required';
        } else {
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($firstNameErr) && empty($lastNameErr) && empty($emailErr) && empty($genderErr) && empty($bloodgrpErr) && empty($qualificationErr) && empty($addressErr)) {
            $sql = "INSERT INTO userdetails (firstname, lastname, email, gender, bloodgrp, qualification, address) VALUES ('$firstName', '$lastName', '$email', '$gender', '$bloodgrp', '$qualification', '$address')";

            if (mysqli_query($conn, $sql)) {

                header("Location: userdetails.php");
            } else {
                echo "Error:";
            }
            mysqli_close($conn);
        } else {
            echo '<div class="alert alert-danger text-center" role="alert">
                Some fields are empty!
                </div>';
        }
    }


    ?>


    <div class="grid-container">
        <div class="grid-table">
            <?php include 'userdetailstable.php'; ?>
        </div>

        <div class="grid-form">
            <form id="form-all" class="form-container" method="POST">
                <div class="form-group">
                    <label for="firstName">First name</label>
                    <input type="firstName" class="form-control <?php echo $firstNameErr ? 'is-invalid' : null; ?>" id="firstName" name="firstName" placeholder="First name">
                    <div class="invalid-feedback">
                        <?php echo $firstNameErr; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input type="lastName" class="form-control <?php echo $lastNameErr ? 'is-invalid' : null; ?>" id="lastName" name="lastName" placeholder="Last name">
                    <div class="invalid-feedback">
                        <?php echo $lastNameErr; ?>
                    </div>
                </div>
                <!-- <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" name="email" id="email" placeholder="example@gmail.com">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <div class="invalid-feedback">
                <.?php echo $emailErr; ?>
            </div>
        </div> -->
                <div class="form-group">
                    <label for="gender">Gender</label><br>
                    <input type="radio" name="gender" value="female" class="ms-1"> Female
                    <input type="radio" name="gender" value="male" class="ms-5"> Male
                    <div class="invalid-feedback">
                        <?php echo $genderErr; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bloodgrp">Blood Group</label><br>
                    <select id="bloodgrp" name="bloodgrp" class="ms-1">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    <div class="invalid-feedback">
                        <?php echo $bloodgrpErr; ?>
                    </div>
                    <div class="form-group">
                        <label for="qualification">Qualification</label><br>
                        <select id="qualification" name="qualification" class="ms-1">
                            <option value=">below SEE">below SEE</option>
                            <option value="SEE passed">SEE passed</option>
                            <option value="+2 running">+2 running</option>
                            <option value="+2 completed">+2 completed</option>
                            <option value="Bachelors running">Bachelors running</option>
                            <option value="Bachelors completed">Bachelors completed</option>
                            <option value="Masters running">Masters running</option>
                            <option value="Masters completed">Masters completed</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php echo $qualificationErr; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="address" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" name="address" id="address" placeholder="street name, city">
                        <div class="invalid-feedback">
                            <?php echo $addressErr; ?>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success">Save</button>
            </form>
        </div>

    </div>
</body>

</html>