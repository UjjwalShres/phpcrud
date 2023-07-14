<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="mygridstyles.css">
</head>

<body>

    <?php include 'db.php';
    $searchbyagevalue = $_SESSION['searchbyagevalue'];
    $searchbygendervalue = $_SESSION['searchbygendervalue'];
    $searchbybloodgrpvalue = $_SESSION['searchbybloodgrpvalue'];



    if ($searchbyagevalue && $searchbygendervalue && $searchbybloodgrpvalue) {

        switch ([$searchbyagevalue, $searchbygendervalue, $searchbybloodgrpvalue]) {
            case ['all', 'all', 'all']:
                echo 'no input: default search';
                $sql = "SELECT * FROM userdetails";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;

            case [$searchbyagevalue, 'all', 'all']:
                echo 'input: ' . $searchbyagevalue;
                $sql = "SELECT * FROM userdetails WHERE $searchbyagevalue";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;

            case [$searchbyagevalue != 'all', $searchbygendervalue, 'all']:
                echo 'input1: ' . $searchbyagevalue . ' & input2: ' . $searchbygendervalue;
                $sql = "SELECT * FROM userdetails WHERE $searchbyagevalue AND $searchbygendervalue";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;

            case [$searchbyagevalue != 'all', $searchbygendervalue != 'all', $searchbybloodgrpvalue]:
                echo 'input1: ' . $searchbyagevalue . ' & input2: ' . $searchbygendervalue . ' & input3: ' . $searchbybloodgrpvalue;
                $sql = "SELECT * FROM userdetails WHERE $searchbyagevalue AND $searchbygendervalue AND $searchbybloodgrpvalue";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;

            case ['all', $searchbygendervalue != 'all', $searchbybloodgrpvalue != 'all']:
                echo 'input2: ' . $searchbygendervalue . ' & input3: ' . $searchbybloodgrpvalue;
                $sql = "SELECT * FROM userdetails WHERE $searchbygendervalue AND $searchbybloodgrpvalue";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;

            case ['all', 'all', $searchbybloodgrpvalue]:
                echo 'input3: ' . $searchbybloodgrpvalue;
                $sql = "SELECT * FROM userdetails WHERE $searchbybloodgrpvalue";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;

            case ['all', $searchbygendervalue, 'all']:
                echo 'input2: ' . $searchbygendervalue;
                $sql = "SELECT * FROM userdetails WHERE $searchbygendervalue";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;

            case [$searchbyagevalue, 'all', $searchbybloodgrpvalue]:
                echo 'input1: ' . $searchbyagevalue . ' & input3: ' . $searchbybloodgrpvalue;
                $sql = "SELECT * FROM userdetails WHERE $searchbyagevalue AND $searchbybloodgrpvalue";
                $result = mysqli_query($conn, $sql);
                $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                break;
        }
    } else {
        echo 'Please input any value!';
    }



    ?>



    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <!-- <th scope="col">Email</th> -->
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col">Blood Group</th>
                <th scope="col">Qualification</th>
                <th scope="col">Address</th>
            </tr>
        </thead>


        <?php foreach ($details as $items) : ?>
            <tbody>
                <tr>
                    <td><?php echo $items['firstname']; ?></td>
                    <td><?php echo $items['lastname']; ?></td>
                    <td><?php echo $items['gender']; ?></td>
                    <td><?php echo $items['age']; ?></td>
                    <td><?php echo $items['bloodgrp']; ?></td>
                    <td><?php echo $items['qualification']; ?></td>
                    <td><?php echo $items['address']; ?></td>
                </tr>
            </tbody>


        <?php endforeach; ?>




    </table>



</body>

</html>