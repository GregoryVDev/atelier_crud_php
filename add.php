<?php

if ($_POST) {

    if (
        isset($_POST['last_name']) &&
        isset($_POST['first_name']) &&
        isset($_POST['email']) &&
        isset($_POST['address']) &&
        isset($_POST['city'])
    ) {

        require_once("connect.php");

        $last_name = strip_tags($_POST["last_name"]);
        $first_name = strip_tags($_POST["first_name"]);
        $email = strip_tags($_POST["email"]);
        $address = strip_tags($_POST["address"]);
        $city = strip_tags($_POST["city"]);

        $sql = "INSERT INTO users (last_name, first_name, email, address, city) VALUES(:last_name, :first_name, :email, :address, :city)";
        $query = $db->prepare($sql);

        $query->bindValue(":last_name", $last_name);
        $query->bindValue(":first_name", $first_name);
        $query->bindValue(":email", $email);
        $query->bindValue(":address", $address);
        $query->bindValue(":city", $city);

        $query->execute();

        require_once("close.php");

        header("Location: index.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Add the users</title>
</head>

<body>
    <h1>Add the user</h1>
    <form method="post">
        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" required>

            <label for="first_name">First Name</label>
            <input type="text" name="first_name" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="address">Address</label>
            <input type="text" name="address" required>

            <label for="city">City</label>
            <input type="text" name="city" required>
            <input type="submit" value="send"></input>
        </div>
    </form>
    <a href="index.php">Back</a>
</body>

</html>