<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php include 'db.php';
    include 'navbar.php';
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }

    $sql = "SELECT * FROM details";
    $result = mysqli_query($conn, $sql);
    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>



    <table class="table ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
                <th scope="col">Edited by</th>
            </tr>
        </thead>

        <!-- Delete Operation -->
        <?php
        if (isset($_POST['delete'])) {
            if (empty($_POST['id'])) {
                echo "ERROR";
            } else {
                $id = $_POST['id'];
                echo $id;
                $sql = 'DELETE FROM details WHERE id="' . $_POST['id'] . '"';
                header('location: dashboard.php');


                if (mysqli_query($conn, $sql)) {
                    echo 'Record Deleted Successfully';
                }
            }
        }


        foreach ($details as $items) : ?>
            <tbody>

                <tr class="<?php echo ($email == $items['email']) ? "table-warning" : ""; ?>">
                    <form method="POST">

                        <td><?php echo $items['username']; ?></td>
                        <td><?php echo $items['email']; ?></td>
                        <td><?php echo $items['password']; ?></td>
                        <input name="id" type="hidden" value="<?php echo $items['id']; ?>" />
                        <td>
                            <button name="delete" class="btn btn-danger <?php echo ($email == $items['email']) ? "d-none" : ""; ?>">Delete</button>
                            <button name="edit" class="btn btn-warning"><a class="edit" href="edit.php?id=<?php echo $items['id']; ?>">Edit</a></button>
                        </td>
                        <td><?php echo $items['editby']; ?></td>

                    </form>
                </tr>
            </tbody>
        <?php endforeach; ?>


    </table>



</body>

</html>