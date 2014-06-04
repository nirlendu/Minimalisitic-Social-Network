<?php
session_start();
header("Location:Profile.php?VID=".$_SESSION['uid']);
?>