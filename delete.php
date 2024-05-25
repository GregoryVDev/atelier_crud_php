<?php

if (isset($_GET["id"]) && !empty($_GET["id"])) {

    require_once("connect.php");

    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM users WHERE id=:id";
    $query = $db->prepare($sql);

    $query->bindValue(":id", $id);
    $query->execute();

    $result = $query->fetch();

    if (!$result) {
        header("Location: index.php");
    }

    $sql = "DELETE FROM users WHERE id=:id";
    $query = $db->prepare($sql);

    $query->bindValue(":id", $id,);
    $query->execute();

    require_once("close.php");
    header("Location: index.php");

    session_start();

    // Une variable $_SESSION se définie comme ça : $_SESSION["NomDeLaSession"] = ValeurDeLaSession 
    $_SESSION['delete_confirm'] = true;

    // Cette ligne stock l'identifiant $id dans la variable de session "bonbon_delete_id"
    $_SESSION['user_delete_id'] = $id;
    $_SESSION['user_name'] = $result[1];
} else {
    header("Location: index.php");
}
