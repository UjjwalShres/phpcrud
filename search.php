<?php
include 'db.php';


if (isset($_POST['search'])) {
    if ($_POST['age']) {
        $_SESSION['searchbyagevalue'] = $_POST['age'];;
    }

    if ($_POST['gender']) {
        $_SESSION['searchbygendervalue'] = $_POST['gender'];
    }

    if ($_POST['bloodgrp']) {
        $_SESSION['searchbybloodgrpvalue'] = $_POST['bloodgrp'];
    }
} else {
    echo 'Please choose any field and search';
}


?>

<nav class="navbar navbar-light bg-light">
    <form class="form-inline" method="POST">

        <!-- search by age -->
        <label for="age" style="margin-top: 8px;">Age: </label>
        <select id="age" name="age" class="ms-1 me-3">
            <option value="all">All</option>
            <option value="age BETWEEN 0 AND 20">0 - 20</option>
            <option value="age BETWEEN 20 AND 30">20 - 30</option>
            <option value="age BETWEEN 30 AND 40">30 - 40</option>
            <option value="age > 40">above 40</option>
        </select>

        <!-- search by gender -->
        <label for="gender" style="margin-top: 8px;">Gender: </label>
        <select id="gender" name="gender" class="ms-1 me-3">
            <option value="all">All</option>
            <option value="gender = 'male'">Male</option>
            <option value="gender = 'female'">Female</option>
        </select>

        <!-- search by bloodgrp -->
        <label for="bloodgrp" style="margin-top: 8px;">Blood group: </label>
        <select id="bloodgrp" name="bloodgrp" class="ms-1 me-3">
            <option value="all">All</option>
            <option value="bloodgrp = 'A+'">A+</option>
            <option value="bloodgrp = 'A-'">A-</option>
            <option value="bloodgrp =  'B+'">B+</option>
            <option value="bloodgrp = 'B-'">B-</option>
            <option value="bloodgrp = 'O+'">O+</option>
            <option value="bloodgrp = 'O-'">O-</option>
        </select>

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
    </form>
</nav>