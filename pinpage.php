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



$pin_1 = isset($_POST['digit1']) ? trim($_POST['digit1']) : "";
$pin_2 = isset($_POST['digit2']) ? trim($_POST['digit2']) : "";
$pin_3 = isset($_POST['digit3']) ? trim($_POST['digit3']) : "";
$pin_4 = isset($_POST['digit4']) ? trim($_POST['digit4']) : "";

$user_pin = $pin_1 . $pin_2 . $pin_3 . $pin_4;
echo $user_pin;



if(isset($_POST['pin_submit'])){
    include "./components/connect.php";
    $query_ = "UPDATE REGISTER SET user_pin='$user_pin' WHERE email = '$email' ";
    $result = mysqli_query($dbConnect, $query_);
    if($result){
        header("Location: dashboard.php");
        exit();
    }
}else{
    echo "Pin was not updated";
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
           <input type="text" name="digit4" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input4"  class="pin-input" required >
           <button type="submit" name="pin_submit" class="btn btn-primary">Apply</button>
    </form>
  

</section>
<?php include "./components/footer.html"?>
