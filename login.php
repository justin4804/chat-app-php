<?php

include "db.php";
session_start();


if(isset($_POST['name']) && isset($_POST["phone"])){
    
    $name = $_POST['name'];
    $phone = $_POST["phone"];

    $q = "SELECT * FROM `users` WHERE name='$name' && phone='$phone'";
    if($rq=mysqli_query($db,$q)){

        if(mysqli_num_rows($rq) == 1){
            $_SESSION["userName"]= $name;
            $_SESSION["phone"]= $phone;
            header("location: index.php");
        }
        else{

            $q = "SELECT * FROM `users` WHERE phone='$phone'";
            if($rq=mysqli_query($db,$q)){
                if(mysqli_num_rows($rq) == 1){
                    echo "<script>alert($phone+' is already registered')</script>";
                }
                else{
                   
                    $q = "INSERT INTO `users`(`name`, `phone`) VALUES ('$name','$phone')";
                    if($rq=mysqli_query($db,$q)){
                        $q = "SELECT * FROM `users` WHERE name='$name' && phone='$phone'";
                        if($rq=mysqli_query($db,$q)){

                            if(mysqli_num_rows($rq) == 1){
                                $_SESSION["userName"]= $name;
                                $_SESSION["phone"]= $phone;
                                header("location: index.php");
                            }
                        }
                    }
                }
            }
        }

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatRoom</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <h1>ChatRoom</h1>
    <div class="login">
        <h2>Login</h2>
        <p>This chatroom project is a chatbot designed using HTML, CSS, Js and PHP</p>
        <form action="" method="post">
            <h3>Username:</h3>
            <input type="text" placeholder="Short name" name="name">

            <h3>Mobile No:</h3>
            <input type="number" placeholder="Enter you no." min="1111111111" max="9999999999" name="phone">
            <button>Login/Reigster</button>
        </form> 
    </div>
</body>

</html>