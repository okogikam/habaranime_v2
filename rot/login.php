<?php
    if(isset($_GET['direct_url']))
    {
        $url=$_GET['direct_url'];
    }else{
        $url = "../index.php";
    }
include 'function.php';
//    include '../rot/connect.php';

   if(isset($_POST['login']))
    {
        $username = sanitizeString($_POST['username']);
        $password = sanitizeString($_POST['password']);
//       $url = $_POST['url'];
        
       
        $query = "SELECT * FROM user WHERE user_name='$username' OR email = '$username'";
       $result = $conn->query($query);
       if(!$result){
           $error= $conn->error;
           header('Location:../login.php?error=$error');
       }else{   
            $row = $result->fetch_array(MYSQLI_BOTH);
           
            $result->close();
            $salt1 = "qm%h";
            $salt2 = "*7!@";

            $token = hash('ripemd128',"$salt1$password$salt2");
           
            if($password == $row['password'])
            {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['status'] = $row['status'];
                $_SESSION['user_id'] = $row['no'];
                if(isset($_POST['remember'])){
                    ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 3);
                }else
                {
                    ini_set('session.gc_maxlifetime', 60 * 60 * 24);
                }
                

                header("Location:$url");
            }
           else {
            header('Location:../login.php?error=1');
           }
       }
        
    }  
?>