<?php include './components/header.html'?>
<!-- confirm pin -->
 <section class="text-center mx-auto">
    <p>Set your transaction pin.</p>
    <h1>Confirm your Pin</h1>       
    <form action="pinpage.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="digit1" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input1"  class="pin-input" required >
         <input type="text" name="digit2" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input2"  class="pin-input" required >
          <input type="text" name="digit3" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input3"  class="pin-input" required >
           <input type="text" name="digit4" maxlength="1" pattern="\d*" inputmode="numeric" id="pincode-input4"  class="pin-input" required >
           <button type="submit" name="pin_submit" class="btn btn-primary">Apply</button>
    </form>
  

</section>
<?php include './components/footer.html'?>