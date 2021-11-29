<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="papaj.ico" type="image/x-icon">
    <title>Wadowice study admin Panel</title>
  </head>
  <body>
    <header>
      <h1>Uczelnia im Jana Pawła 2 w Wadowicach</h1>
      <h2>Panel Administracyjny</h2>
    


  
    
    <!--<p class="choose">Wybierz tabele:</p>-->



    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


<?php 
    
session_start();

if (!isset($_SESSION['loged_in']))
	{
		header('Location: index.php');
		exit();
	}



	require_once "connect.php";


echo"Witaj <b > $_SESSION[user] </b>";
echo "<a href='logout.php' class='logeout'>Wyloguj</a>";


echo "</header>";
echo "<div class='content'>";


$sql = "Show TABLES FROM $database";

    $conn = new mysqli($servername, $username, $password,$database);
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset('utf8');
    

$result =$conn->query($sql);



while($row = $result->fetch_row()){
    echo "<p><a href='show.php?table=$row[0]' class='nav-table'>$row[0]</a></p>";
}

echo " </div>";

echo "<div class='data'>";

if(isset($_GET['table'])){

$header = strtoupper($_GET['table']);

echo "<table>";

echo "<tr > <td colspan='100%'><b id='table'> $header</b> 
<button class='add' style='float:right;' onclick='add()' >
<span class='add-text'>DODAJ</span>
<span class='add-icon'>
<ion-icon name='add-circle-outline'></ion-icon>
</span></button>
</td></tr>";

$sql_col_name = "show COLUMNS FROM $_GET[table]";

$col_name = $conn->query($sql_col_name);

$form_names = array();

echo "<tr>";

while($name = $col_name->fetch_assoc()){
$form_names[] = $name['Field'];

  echo "<td> <b> $name[Field] </b>  </td>";

}

$fk_res = $conn->query("SHOW KEYS FROM $_GET[table] WHERE Key_name like 'fk%'");
$fk_col_names = array();


while($fk_name = $fk_res->fetch_assoc()){

$fk_col_names[] = $fk_name['Column_name'];



}




echo "</tr>";

$sql2 = "SELECT * FROM $_GET[table]";
$table_data = $conn->query($sql2);

if($table_data->num_rows > 0){


while($data = $table_data->fetch_row()){
  
echo "<tr id='$data[0]'>";
for($i=0;$i<count($data);$i++){
    echo "<td>".$data[$i].'</td>';
};

    
echo "<td> <a style='text-decoration: none; background: none; color:white;' href='delete.php?table=$_GET[table]&id=$data[0]' ><button class='delete'> USUŃ</button> </a></td>";
echo "<td><button class='update' onclick='update($data[0])'>MODYFIKUJ</button></td>";
echo "</tr>";

}


}

echo "</table>";
}

if(isset($_GET['table'])){

echo "<form action='update.php' id='form_1'>";

echo "<span style='margin-left:95%; cursor:pointer' onclick='close_form(1)'>X</span>";
echo "<p id='row_id' >ELO</p>";
echo "<input name='table' value=$_GET[table] type='hidden'></input>";

for($x = 1;$x<count($form_names);$x++){
if(in_array($form_names[$x],$fk_col_names)){

  echo "<div>";
echo "<img src='./key.svg' style='width:10px height:10px'>   <span class='details'>$form_names[$x]</span>:  <input name='$form_names[$x]' ></input>";
echo "</div>";


}
else {



  echo "<div>";
echo "$form_names[$x]  <input name='$form_names[$x]' ></input>";

echo "</div>";}
}

echo "<button >Prześlij</button>";
echo "</form>";


echo "<form action='insert.php' id='form_2'>";

echo "<span style='margin-left:95%; cursor:pointer' onclick='close_form(2)'>X</span>";

echo "<input name='table' value=$_GET[table] type='hidden'></input>";

for($x = 0;$x<count($form_names);$x++){
if(in_array($form_names[$x],$fk_col_names)){

  echo "<div>";
echo "<img src='./key.svg' style='width:10px height:10px'>   <span class='details'>$form_names[$x]</span>:  <input name='$form_names[$x]' ></input>";
echo "</div>";


}
else {

  echo "<div>";
echo "<span class='details'>$form_names[$x]</span>:  <input name='$form_names[$x]' ></input>";
echo "</div>";
}

}

echo "<button >Prześlij</button>";
echo "</form>";

}


    ?>

<script src="main4.js?v=<?php echo time(); ?>"></script>

   
  </body>
</html>
