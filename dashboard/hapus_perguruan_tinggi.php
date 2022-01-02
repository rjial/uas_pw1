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
    $id_pt = $_GET['id'];
    if ($id_pt > 0 || $id_pt != null) {
        $query_pt = $db->query("SELECT * FROM `perguruan_tinggi` WHERE `ID_PERGURUAN_TINGGI` = " . $id_pt);
        if ($query_pt->rowCount() > 0) {
            $query_pthps = $db->exec("DELETE FROM `perguruan_tinggi` WHERE `ID_PERGURUAN_TINGGI` = " . $id_pt);
            if ($query_pthps) {
                header("Location: " . base_urll("dashboard/perguruan_tinggi.php"));
            }
        }
    } else {
        header("Location: " . base_urll("dashboard/perguruan_tinggi.php"));
    }
}
