<?php
$conn = mysqli_connect('localhost','root','','gestfest');
if($_SERVER['REQUEST_METHOD']=='POST'){
    $result= array();
    $result['data']=array();
    $response= mysqli_query($conn,"SELECT * FROM `artiste`");

    while ($row=mysqli_fetch_array($response)){

        $index['id']=$row[0];
        $index['nom']=$row[1];
        $index['prenom']=$row[2];
        $index['nomArtiste']=$row[3];
        $index['age']=$row[4];
        $index['sexe']=$row[5];
        $index['style']=$row[6];
        $index['photo']=$row[7];
        array_push($result['data'],$index);


    }
    $result['success']="1";
    echo json_encode($result);
    mysqli_close($conn);

}