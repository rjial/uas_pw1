<?php
require("db/config.php");
session_start();
session_destroy();
?>

<script>
    alert("Selamat anda sudah logout!")
    window.location.href = "<?php echo base_urll("login.php") ?>"
</script>