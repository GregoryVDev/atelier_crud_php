<?php

session_start();

if (
    isset($_GET['id']) && !empty($_GET['id'])
) {

    require_once('connect.php');

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM users WHERE id=:id';
    $query = $db->prepare($sql);

    $query->bindValue(':id', $id,);

    $query->execute();

    $result = $query->fetch();

    if (!$result) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>User profile</title>
</head>

<body>

    <div class="container">
        <h1>User profile</h1>
        <h2><?= $result['last_name'] . ' ' . $result['first_name'] ?></h2>

        <p>Last name : <?= $result['last_name'] ?></p>
        <p>First name : <?= $result['first_name'] ?></p>
        <p>Email : <?= $result['email'] ?></p>
        <p>Address : <?= $result['address'] ?></p>
        <p>City : <?= $result['city'] ?></p>

        <a href="index.php">Back</a>
    </div>
</body>

</html>