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

$result = $query->fetchAll(pdo::FETCH_ASSOC);

// echo "<pre>";
// print_r($result);
// echo "</pre>";

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
                    <td><?= $user['last_name'] ?></td>
                    <td><?= $user['first_name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['address'] ?></td>
                    <td><?= $user['city'] ?></td>
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