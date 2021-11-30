<?php
session_start();
session_destroy();
?>

<script>
    alert("Selamat anda sudah logout!")
    window.location.href = "login.php"
</script>