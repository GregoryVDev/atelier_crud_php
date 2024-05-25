<?php
session_start();
require_once("connect.php");

// Etape 1 : Créer la requête SQL
$sql = "SELECT * FROM users";
// Etape 2 : Préparer la requête SQL
$query = $db->prepare($sql);
// Etape 3 : Exécuter la requête SQL
$query->execute();
// Etape 4 : Récupérer les résultats de la requête SQL dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Users</title>
</head>

<body>
    <h1>Users List</h1>
    <?php if (isset($_SESSION['delete_confirm']) && $_SESSION['delete_confirm'] === true) : ?>
        <div>
            <p>The user <?= ($_SESSION["user_name"]) ?> has been successfully deleted.</p>
        </div>
        <?php unset($_SESSION["delete_confirm"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["update_confirm"]) && $_SESSION["update_confirm"] === "valid" && isset($_SESSION["name_user"])) : ?>
        <div>
            <p>The user <?= ($_SESSION["name_user"]) ?> has been modified by <?= ($_SESSION["name_edited"]) ?>.</p>
        </div>
        <?php unset($_SESSION["update_confirm"]);
        unset($_SESSION["name_user"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['name_confirm']) && $_SESSION['name_confirm'] === "confirm" && isset($_SESSION["name_add"])) : ?>
        <div>
            <p>The user <?= ($_SESSION["name_add"]) ?> has been added.</p>
        </div>
        <?php unset($_SESSION["name_confirm"]);
        unset($_SESSION["name_add"]); ?>
    <?php endif; ?>

    <table>
        <thead>
            <th>Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>City</th>
            <th>Action</th>
        </thead>
        <?php foreach ($result as $user) : ?>
            <tbody>
                <tr>
                    <td><?= ($user['last_name']) ?></td>
                    <td><?= ($user['first_name']) ?></td>
                    <td><?= ($user['email']) ?></td>
                    <td><?= ($user['address']) ?></td>
                    <td><?= ($user['city']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $user["id"] ?>">Edit</a>
                        <a href="details.php?id=<?= $user["id"] ?>">Profil</a>
                        <a href="delete.php?id=<?= $user["id"] ?>">Delete</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Add</a>
</body>

</html>