<?php 

 if((!isset($_GET['table']))){

    header("Location: index.php" );
    exit();
    }




	require_once "connect.php";

$conn = new mysqli($servername, $username, $password,$database);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8');

$sql_table = "SHOW KEYS FROM ".$_GET['table']." WHERE Key_name = 'PRIMARY'";

$pk_name = $conn->query($sql_table);

$pk_table =  $pk_name->fetch_assoc();

$Column_name = $pk_table['Column_name'];




$key = array_keys($_GET);

$sql2 = "";
$sql = "INSERT INTO ".$_GET['table']." (";
for($i=1;$i<count($key);$i++){
if($i==count($key)-1) {$sql2 = $sql2.$key[$i].')';
break;
}
 
$sql2 = $sql2.$key[$i].",";

}
$sql2 = $sql2.' VALUES (';

for($i=1;$i<count($key);$i++){
if($i==count($key)-1) {$sql2 = $sql2."'".$_GET[$key[$i]]."') ";
break;
}
 
$sql2 = $sql2."'".$_GET[$key[$i]]."' , ";



}


$sql_fin =$sql.$sql2;




$conn->query($sql_fin);


header('Location: ' . $_SERVER['HTTP_REFERER']); 


?>