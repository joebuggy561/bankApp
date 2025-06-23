<?php 

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    include "./components/connect.php";

    $query = "SELECT email, password FROM REGISTER WHERE email = '$email'";
    $resp = mysqli_query($dbConnect, $query);
    $rez = mysqli_fetch_assoc($resp);

    if($rez){
        if(password_verify($password, $rez['password'])){
            // before you start a session you have to declare the session start\
            // only pass condition fi you are redirecting to the landing page
            
            session_start();

            $token = bin2hex(random_bytes(16));
            $token_exp = time() + (60 * 2);

            $_SESSION['token'] = $token;
            $_SESSION['token-exp'] = $token_exp;
            $_SESSION['email'] = $email;

            header("Location: dashboard.php");
            exit();
        }else{
            echo "Wrong Credentials";
        }
    }else{
        echo "Invalid Email or Password";
    }
}




?>


   <?php include './components/header.html' ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" placeholder="email" class="form-control" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label" name="password">Password</label>
            <input type="password" name="password" id="password" placeholder="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Submit</button>
         <p class="text-center">Dont have an account? <a href="register.php">Sign Up">Register</a></p>
    </form>


    <?php include './components/footer.html' ?>
    
