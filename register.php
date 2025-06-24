<?php

// Process the form data and save it to the database

if(isset($_POST['apply'])){
    

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = $_POST['phone_number'];
    // $profile_picture = $_POST['profile_picture'];
    $address_line_1 = $_POST['address_line_1'];
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $country = trim($_POST['country']);
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $email = $_POST['email'];
    $bvn = $_POST['bvn'];
    $nin = $_POST['nin'];

    $valid_gender = ["male", "female"];


    if ($first_name == '' || $last_name == '' || $password == '' || $confirm_password == '' || $phone_number == '' || $address_line_1 == '' || $city == '' 
    || $state == '' || $country == '' || $gender == '' || $email == '' || $bvn == '' || $nin == '') {
        echo "All fields are required";
        die();
    }

    if(!preg_match("/^[a-zA-Z]+$/", $first_name)){
        header("Location: index.php?error=First name must letters only");
        die();
    }

    if(!preg_match("/^[a-zA-Z]+$/", $last_name)){
        header("Location: index.php?error=Last name must letters only");
        die();
    }

    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)){
        header("Location: index.php?error=Password is not strong enough");
        die();
    }


    if($password != $confirm_password){
        header("Location: index.php?error=Password does not match");
        die();
    }

   if (!preg_match('/^\+[0-9]{10,}$/', $phone_number)) {
        header("Location: index.php?error=Phone number is not valid");
    die();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: index.php?error=Email is not valid");
        die();
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $city)) {
        header("Location: index.php?error=City must contain only letters and spaces.");
        die();
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $state)) {
       header("Location: index.php?error=State must contain only letters and spaces.");
        die();
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $country)) {
        header("Location: index.php?error=Country must contain only letters and spaces.");
        die();
    }

    if(!in_array($gender, $valid_gender)){
        header("Location: index.php?error=Gender is not valid");
        die();
    }

    if (!preg_match("/^[0-9]{10,}$/", $nin)) {
        header("Location: index.php?error=NIN must be 11 digits.");
        die();
    }


    if(!preg_match("/^[A-Za-z]{2}[0-9]{10}$/", $bvn)){
        header("Location: index.php?error=BVN is not valid");
        die();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $phone_number = preg_replace('/\D/', '', $phone_number);
    $phone_number_last = substr($phone_number, -8);
    $account_number = "50" . $phone_number_last;


    $query_db = "SELECT account_number FROM REGISTER WHERE account_number = ?";
    include './components/connect.php';
    if($account_number){
        $stmt = mysqli_prepare($dbConnect, $query_db);
        $stmt->bind_param("s", $account_number);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows >0){
            header("Location: index.php?error=Account number already exist");
            die();
        }else{
            header("Location: pinpage.php");
            $stmt->close();
        }
    }
   
    // $query_db = "SELECT * FROM REGISTER WHERE account_number = '$account_number'";

    
   

    $default_wallet = 10000;

    

    echo $first_name . " " . $last_name . " " .  $hashed_password . " " . $phone_number . " " . $address_line_1 . " " . $city . " " . $state . " " . $country . " " . $gender . " " . $email . " " . $bvn . " " . $nin . " " . $account_number . " " . $default_wallet;
    echo "Form submitted successfully!";

    include './components/connect.php';

    $Query = "INSERT INTO REGISTER(first_name, last_name, password, phone_number, address_line_1, city, state, country, gender, email, bvn, nin, account_number, default_wallet) VALUES('$first_name', '$last_name', '$hashed_password', '$phone_number', '$address_line_1', '$city', '$state', '$country', '$gender', '$email', '$bvn', '$nin', '$account_number', '$default_wallet')";

    // $Query2 = "SELECT * FROM REGISTER(first_name, last_name, password, phone_number, address_line_1, city, state, country, gender, email, bvn, nin) VALUES('$first_name', '$last_name', '$hashed_password', '$phone_number', '$address_line_1', '$city', '$state', '$country', '$gender', '$email', '$bvn', '$nin')";
    // as we have for email 1602 can we get similar option for data not in the exsisting php docs such for phone numbers or random numbers

    $response = mysqli_query($dbConnect, $Query);

    if($response){
        session_start();
        $_SESSION['email'] = $email;
        header("Location:pinpage.php");
    }else{
        if (mysqli_errno($dbConnect) == 1062) {
            header("Location: index.php?error=Email already exists");
            exit();
        }
        echo "Error: " . mysqli_error($dbConnect);
        echo mysqli_errno($dbConnect);
        exit();
    }






}
?>