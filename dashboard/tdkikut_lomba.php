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
    if ($stmt->rowCount() > 0) {
        $username = $stmt->fetchColumn(2);
        $query_level = $db->query("select user_level.* from user inner join user_level on user_level.id_level = user.id_level where id_user=" . $id);
        $array_level = $query_level->fetchAll()[0];
        if ($array_level["ID_LEVEL"] != 2) {
            header("Location: " . base_urll("dashboard/"));
        }
    } else {
        header("Location: " . base_urll("logout.php"));
        // echo "asdasdasd";
    }
    $id_lomba = $_GET['id'];
    if ($id_lomba > 0 || $id_lomba != null) {
        $query_lomba = $db->query("SELECT * FROM `lomba` WHERE ID_LOMBA=" . $id_lomba);
        if ($query_lomba->rowCount() > 0) {
            $query_psrt = $db->query("select * from peserta where ID_USER=" . $id);
            $array_psrt = $query_psrt->fetchAll()[0];
            $sql_ikutilomba = "DELETE FROM `ambil_lomba` where `ID_PESERTA`='" . $array_psrt["ID_PESERTA"] . "' and `ID_LOMBA`='" . $id_lomba . "'";
            $query_ikutilomba = $db->exec($sql_ikutilomba);
            if ($query_ikutilomba) {
                header("Location: " . base_urll("dashboard/"));
            }
        }
    } else {
        header("Location: " . base_urll("dashboard/"));
    }
}
// var_dump($array_pt);
// die();
