<?php 
session_start();

if(!isset($_SESSION['email'])){
    header("Location: pinpage.php");
    exit();
}


include "./components/connect.php";


// time out session
// session_start();
// if (!issest($_SESSION['token']) || $_SESSION['token_exp'] < time()){
// header("Location: login.php?error=Your session has expired");
// include"/components/connect.php/"
// write a query that will bring the user information from the back end
// $emil = $_SESSION['email'];
// $query = "SESSION username, account_number, wallet, FROM users WHERE email="$email";
// $response = mysqli_fetch_all($response, MYSQLI_ASSOC);
// $user = mysql_fetch_assco($response)
// if($user){
//  print_r($user);
// }
// }




// $query = "SELECT * FROM REGISTER WHERE email = '{$_SESSION['email']}'";
// $query->execute();
// $fetch = $query->fetch();

$email = $_SESSION['email'];

$query = "SELECT id, first_name, last_name, email, account_number, default_wallet FROM REGISTER WHERE email = ?";
$stmt = mysqli_prepare($dbConnect, $query);

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();


if($user = $result->fetch_assoc()){
    $full_name = $user['first_name'] . " " . $user['last_name']; 
    $email = $user['email'];
    $account_number = $user['account_number'];
    $wallet_balance = $user['default_wallet'];
}else{
    echo "User not found";
    exit();
}



// $full_name = $_SESSION['full_name'];
// $email = $_SESSION['email'];
// $account_number = $_SESSION['account_number'];
// $wallet_balance = $_SESSION['wallet_balance'];

// send money 
// recieve money
// integrate paystack
// generate account number
// transaction pin
// add account number field in database
// set transaction pin in the database
// create a pin transaction while creating an account 
// learn update query yourself
// role for user and role for admin 
// get to transfer to another person
?>
<?php include './components/header.html' ?>
<div class="container mt-4">
    <div class="row">
        <?php include './components/dashboardsidebar.html' ?>
        <main class="col-md-9 col-md-8">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <strong class="text-secondary">Logged in as: </strong>
                <span class="fw-semibold text-primary"> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></span>
                </div>
                <div class="card-body">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                    <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                        <div class="card-body">
                        <h5 class="card-title text-muted">Wallet Balance</h5>
                        <h2 class="fw-bold text-dark">$ <?php echo $user['default_wallet']; ?></h2>
                        <a href="my_orders.php" class="btn btn-outline-primary mt-3">View Transfers</a>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                        <!-- this is coming from the backend  -->
                        <div class="card-body">
                        <img src=<?php echo $register['profile_picture'] || 'imge.png'?> alt='User profile picture' class='rounded-circle mb-3' width='80' height='80'> />
                        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="img_update">
                            <button type="file" name="changeDP">Change profile Picture</button>
                        </form>   
                        <p class="mb-1 fw-semibold text-dark"><?php echo $user['email']; ?></p>
                        <p class="text-muted">Account Number: <?php echo $user['account_number']; ?></p>
                        </div>
                    </div>
                    </div>
                </div> <!-- .row -->
                </div> <!-- .card-body -->
            </div>
        </main>
    </div>
</div>


<?php include './components/footer.html' ?>

