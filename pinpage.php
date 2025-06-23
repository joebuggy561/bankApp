<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include './components/connect.php';

$email = $_SESSION['email'];

$query = "SELECT  account_number, email FROM REGISTER WHERE email = ?";
$stmt = mysqli_prepare($dbConnect, $query);

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()){
    $account_number = $user['account_number'];

}else{
    header("Location: login.php");
    exit();
}

// query you account

// check if when generating account number their no similar account unumber in the data base
// first query your database ---> $acc_query "SELECT ACCOUNT_NUMBER FROM users WHERE account_number - $acc_no;
// $resp = mysqli_query($dbConnect, $acc_query);
// $rez = mysqli_fetch_all($resp);
// if($rez){
//  print_r($rez);
// }else{
// $upd_query = "UPDATE USERS SET ACCOUNT_NUMBER = '$acc_no' WHERE EMAIL = '$email'";
// }
// }else{
// header("Location: login.php");

// } if(isset($_POST['setPin])){
$upd_query = "UPDATE USERS SET ACCOUNT_NUMBER = '$acc_no', teansacrtion_pin='$tranz_pin' WHERE EMAIL = '$email'";
// }


$pin_1 = $_POST['digit1'];
$pin_2 = $_POST['digit2'];
$pin_3 = $_POST['digit3'];
$pin_4 = $_POST['digit_4'];

$user_pin = $pin_1 . $pin_2 . $pin_3 . $pin_4;

$pin_query = "INSERT INTO REGISTER (user_pin)VALUES($user_pin)";
$response = mysqli_query($dbConnect, $Query);
if($response){
   header ("Location:login.php");
}else{
    echo "You need to assign a Pin to your page";
}
 ?>


<?php include "./components/header.html"?>;
<section class="text-center mx-auto">
    <h3>This is your account number: <?php echo $account_number; ?></h3>
    <p>Set your transaction pin.</p>
    <h1>Enter your Pin</h1>       

    <form action="pinpage.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="digit1" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input1"  class="pin-input" required >
         <input type="text" name="digit2" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input2"  class="pin-input" required >
          <input type="text" name="digit3" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input3"  class="pin-input" required >
           <input type="text" name="digit_4" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input4"  class="pin-input" required >
           <button type="submit" name="pin_submit" class="btn btn-primary">Apply</button>
    </form>
  

</section>
<?php include "./components/footer.html"?>
