<?php


include "conn.php";
$id = $_REQUEST['id'];
$sql="SELECT stat_tahun,stat_jumlah FROM statistik JOIN negara ON negara.negara_id=statistik.negara_id WHERE negara.negara_nama like '$id'";

    mysqli_multi_query($conn,$sql);
    $result=mysqli_store_result($conn);
    $i=0;
    $row=mysqli_fetch_all($result);
	

    header('Content-Type: application/json');
	//echo var_dump ($row);
	//echo("LALALA");
	
	echo json_encode($row);
	//echo var_dump($lala);
	//	return $lala;
	
	

?>