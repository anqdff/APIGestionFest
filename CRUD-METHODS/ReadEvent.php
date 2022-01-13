<?php
$conn = mysqli_connect('localhost','root','','gestfest');
$result= array();
$result['data']=array();
$response= mysqli_query($conn,"SELECT * FROM `evenement`");

while ($row=mysqli_fetch_array($response)){

    $index['id']=$row[0];
    $index['nom']=$row[1];
    $index['lieu']=$row[2];
    $index['datedebut']=$row[3];
    $index['Description']=$row[4];
    $index['photo']=$row[5];
    array_push($result['data'],$index);


}
$result['success']="1";
echo json_encode($result);

mysqli_close($conn);
//$result=mysqli_fetch_all($sql,MYSQLI_ASSOC);
//exit(json_encode($result));