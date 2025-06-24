    <?php include './components/header.html' ?>
    <section class="section-content py-5 my-5">
        <div class="container">

            <!-- Main Content -->
            <main class="col-12">
                <article class="card shadow-sm">
                    <div class="card-body">

                       <img src="./assets/img.jpg" alt="User profile picture" class="rounded-circle mb-3" width="80">

                        <form action="register.php" method="POST" enctype="multipart/form-data">
                            <?php 
                            if(isset($_GET['error'])){
                                echo "<div style='color:red; font-weight:bold;'>" . htmlspecialchars($_GET['error']) . "</div>";
                            }
                            ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="John">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Doe">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone_number"
                                        placeholder="+1234567890">
                                </div>
                                <!-- <div class="col-md-6">
                                    <label class="form-label">Profile Picture</label>
                                    
                                        height="80">
                                </div> -->
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address_line_1"
                                        placeholder="123 Main St">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">Gender</label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                            value="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                            value="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">BVN</label>
                                    <input type="text" class="form-control" name="bvn" placeholder="BVN">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">NIN</label>
                                    <input type="text" class="form-control" name="nin" placeholder="NIN">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="State">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" placeholder="Country">
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" name="apply" class="btn btn-primary">Save</button>
                            </div>

                             <p class="text-center">Already have an account? <a href="login.php">Login In</a></p>
                        </form>
                    </div>
                </article>
            </main>
        </div>
    </section>
    <?php include './components/footer.html' ?>


