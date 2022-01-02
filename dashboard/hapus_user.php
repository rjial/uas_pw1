<?php
require("../db/config.php");
session_start();

if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
    header("Location: " . base_urll("login.php"));
    // echo "asdasdasd";
} else {
    $id = $_SESSION['login'];
    $query = "SELECT * from user where id_user='" . $id . "'";
    $stmt = $db->query($query);
    // var_dump($stmt);
    // die();
    if ($stmt->rowCount() > 0) {
        $username = $stmt->fetchColumn(2);
        $query_level = $db->query("select user_level.* from user inner join user_level on user_level.id_level = user.id_level where id_user=" . $id);
        $array_level = $query_level->fetchAll()[0];
    } else {
        header("Location: " . base_urll("logout.php"));
        // echo "asdasdasd";
    }
    $id_user = $_GET['id'];
    if ($id_user > 0 || $id_user != null) {
        $query_user = $db->query("SELECT * FROM `user` WHERE ID_USER=" . $id_user);
        $array_user = $query_user->fetchAll()[0];
        if ($query_user->rowCount() > 0) {
            if ($array_user["ID_LEVEL"] == 2) {
                $query_psrt = $db->query("select * from peserta where ID_USER='" . $array_user["ID_USER"] . "'");
                if ($query_psrt->rowCount() > 0) {
                    $query_psrthps = $db->exec("delete from peserta where ID_USER='" . $array_user["ID_USER"] . "'");
                    if ($query_psrthps) {
                    }
                }

                // var_dump($array_psrt);
            }
            $query_userhps = $db->exec("DELETE FROM `user` WHERE ID_USER=" . $id_user);
            if ($query_userhps) {
                header("Location: " . base_urll("dashboard/users.php"));
            }
        }
        // var_dump($array_user);
        // die();
    } else {
        header("Location: " . base_urll("dashboard/users.php"));
    }
}
