<?php
$conn = mysqli_connect('localhost','root','','gestfest');
$sql= mysqli_query($conn,"SELECT * FROM `user`");

$result=mysqli_fetch_all($sql,MYSQLI_ASSOC);
exit(json_encode($result));