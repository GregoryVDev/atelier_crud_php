<?php

session_start();

if ($_POST) {

    if (
        isset($_POST["last_name"]) &&
        isset($_POST["first_name"]) &&
        isset($_POST["email"]) &&
        isset($_POST["address"]) &&
        isset($_POST["city"])
    ) {
        require_once("connect.php");

        $id = strip_tags($_POST["id"]);
        $last_name = strip_tags($_POST["last_name"]);
        $first_name = strip_tags($_POST["first_name"]);
        $email = strip_tags($_POST["email"]);
        $address = strip_tags($_POST["address"]);
        $city = strip_tags($_POST["city"]);

        $sql = "UPDATE users SET last_name=:last_name, first_name=:first_name, email=:email, address=:address, city=:city WHERE id=:id";
        $query = $db->prepare($sql);

        $query->bindValue(":id", $id);
        $query->bindValue(":last_name", $last_name);
        $query->bindValue(":first_name", $first_name);
        $query->bindValue(":email", $email);
        $query->bindValue(":address", $address);
        $query->bindValue(":city", $city);

        $query->execute();

        require_once("close.php");

        header("Location: index.php");
    }
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {

    require_once("connect.php");

    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM users WHERE id=:id";
    $query = $db->prepare($sql);

    $query->bindValue(":id", $id);
    $query->execute();

    $result = $query->fetch();

    require_once("close.php");
} else {
    header("Location: index.php");
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>User profil edit</title>
</head>

<body>
    <h1>User profil edit</h1>

    <form method="post">
        <div>
            <label for="last_name">Last name</label>
            <input type="text" name="last_name" value="<?= $result['last_name'] ?>" required>

            <label for="first_name">First name</label>
            <input type="text" name="first_name" value="<?= $result['first_name'] ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?= $result['email'] ?>" required>

            <label for="address">Address</label>
            <input type="text" name="address" value="<?= $result['address'] ?>" required>

            <label for="city">City</label>
            <input type="text" name="city" value="<?= $result['city'] ?>" required>

            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <input type="submit" value="EDIT"></input>
        </div>
    </form>
</body>

</html>