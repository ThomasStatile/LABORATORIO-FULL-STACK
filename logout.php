<?php
session_start();
session_destroy();
header("Location: index.php"); // Reindirizza all'area di login o a un'altra pagina pubblica
exit();
?>
