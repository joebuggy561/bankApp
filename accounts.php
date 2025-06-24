<?php 
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include "./components/connect.php";

$email = $_SESSION['email'];

$query = "SELECT id, first_name, last_name, email, account_number, default_wallet FROM REGISTER WHERE email = ?";

$stmt = mysqli_prepare($dbConnect, $query);

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()){
    $full_name = $user['first_name'] . " " . $user['last_name'];    
    $email = $user['email'];    
    $default_wallet = $user['default_wallet'];
    $account_number = $user['account_number'];
}
?>
<?php include './components/header.html' ?>
<div class="container mt-4">
    <div class="row">
        <?php include './components/dashboardsidebar.html' ?>
        <main class="col-md-9 col-md-8">
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong class="text-secondary">Logged in as:</strong>
                    <span class="fw-semibold text-primary">
                        <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row g-4">

                        <!-- Wallet Balance -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Wallet Balance</h5>
                                    <h2 class="fw-bold text-success">$ <?php echo $user['default_wallet']; ?></h2>
                                    <a href="wallet.php" class="btn btn-outline-primary mt-3">View Wallet</a>
                                </div>
                            </div>
                        </div>

                        <!-- Transfers -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Transfers</h5>
                                    <p class="text-muted">Send & receive funds</p>
                                    <a href="transfers.php" class="btn btn-outline-primary">Transfer Money</a>
                                </div>
                            </div>
                        </div>

                        <!-- Deposit -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Deposit</h5>
                                    <p class="text-muted">Add funds to your account</p>
                                    <a href="deposit.php" class="btn btn-outline-success">Make a Deposit</a>
                                </div>
                            </div>
                        </div>

                        <!-- Bank Statement -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Bank Statement</h5>
                                    <p class="text-muted">Download or view recent transactions</p>
                                    <a href="statements.php" class="btn btn-outline-secondary">View Statements</a>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Support -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Support</h5>
                                    <p class="text-muted">Need help? Contact us</p>
                                    <a href="support.php" class="btn btn-outline-danger">Contact Support</a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile / Account Info -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center border-0 shadow-sm rounded-3 h-100">
                                <div class="card-body">
                                    <img src="path/to/profile.jpg" alt="Profile Picture" class="rounded-circle mb-3" width="80" height="80">
                                    <p class="mb-1 fw-semibold text-dark"><?php echo $user['email']; ?></p>
                                    <p class="text-muted">Account Number: <?php echo $user['account_number']; ?></p>
                                    <p class="text-muted">Status: <span class="badge bg-success">Active</span></p>
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
