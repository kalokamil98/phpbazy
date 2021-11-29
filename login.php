<?php 

    session_start();



    if((!isset($_POST['password'])) || (!isset($_POST['login']))){

    header("Location: index.php" );
    exit();
    }
    else{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "users";


    $conn = @new mysqli($servername,$username,$password,$database);
        
    if ($conn->connect_error!=0)
    {
        echo "Error : ".$conn->connect_errno;
    }
    else {



    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * from users WHERE login = '$login' and passwd = '$password'" ;
$result = @$conn->query($sql);

    if($result){


$users_count = $result->num_rows;

    if($users_count > 0)
    {
        $_SESSION['loged_in'] =  true;
        $row = $result->fetch_assoc();
        $_SESSION['id']  = $row['id'];
        $_SESSION['user'] = $row['login'];


    unset($_SESSION['blad']);
        header('Location: show.php');
    }
   else  {   
                echo"elo";          
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');				
			}     

}
else  {   
                echo"elo";          
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');				
			}      



}



$conn->close();

}




?>