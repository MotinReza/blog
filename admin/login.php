<?php

require_once "../config/dbcon.php";

if(isset($_SESSION["email"])){
    header("location: index.php");
}

if(isset($_POST["login"])){
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $error = [];


    if(empty($email)){
        $error["email"] = "This email filed is required!";
    }
    if(empty($password)){
        $error["password"] = "This password filed is required!";
    }

    if(empty($error)){
        
        $email_check = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email' ");
        
        if(mysqli_num_rows($email_check) == 1){
            
            $user_info = mysqli_fetch_assoc($email_check);

            if($user_info["password"] == md5($password)){
                
                if($user_info["status"] == 'active'){
                    
                    $_SESSION["email"] = $email;
                    $_SESSION["u_id"] = $user_info["id"];
                    $_SESSION["name"] = $user_info["name"];

                    header("location: index.php");
                    
                }else{
                    $login_error = "Your account has been banned by an admin. Please contact us if you think this is an error!";
                }

            }else{
                $login_error = "This credentials do not match our records!";
            }
            
        }else{
            $login_error = "This credentials do not match our records!";
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
    <title>Login</title>
    <link rel="stylesheet" href="../assets/frontend_file/home/css/styles.css"/>
</head>
<body></body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-md-3">
                <div class="card mt-5">
                    <div class="card-header"><h2>Login</h2></div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email"  id="email" class="form-control" value="<?= isset($email) ? $email:''; ?>">
                                <span class="text-danger"><?php if(isset($error["email"])){ echo $error["email"]; } ?></span>
                                <span class="text-danger"><?php if(isset($login_error)){ echo $login_error; } ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                                <span class="text-danger"><?php if(isset($error["password"])){ echo $error["password"]; } ?></span>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>