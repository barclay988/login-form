<?php 

session_start();
require_once 'config.php';


if(isset($_POST['register'])){

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $conn->real_escape_string($_POST['role']);

    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if($checkEmail->num_rows > 0){
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    }
    else{

        $newUser = $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");

        if($newUser){
            $_SESSION['register_success'] = 'Registration successful! Please login.';
            $_SESSION['active_form'] = 'login';
        }
        else{
            $_SESSION['register_error'] = 'Registration failed!';
            $_SESSION['active_form'] = 'register';
        }
    }

    header("Location: index.php");
    exit();

}

if(isset($_POST['login'])){

    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] === 'admin'){

                header("Location: admin_page.php");
            }
            else{
                header("Location: user_page.php");
            }
            exit();

        }


    }

    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();

}

?>