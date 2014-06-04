<?php
session_start();
include 'FunctionsImp.php';
include 'chata.html';
echo "<center><br/><a href='NotificationsAdmin.php'>Notifications</a><br/>";
echo "<a href='PostAdmin.php'>Post Something</a><br/>";
echo "<a href='ManualQuery.php'>Manual Query</a><br/>";
echo "<a href='AdminAutoQueries.php'>Automated Queries</a><br/>";
echo "<a href='LogoutAdmin.php'>Logout</a><br/>";
?>