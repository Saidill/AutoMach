<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'address saved!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css">
</head>

<?php include 'user_header.php'; ?>



<section class="form-container">

   <form action="" method="post">
      <h3>your address</h3>
      <input type="text" class="box" placeholder="flat no." required maxlength="50" name="flat">
      <input type="text" class="box" placeholder="building no." required maxlength="50" name="building">
      <input type="text" class="box" placeholder="area name" required maxlength="50" name="area">
      <input type="text" class="box" placeholder="town name" required maxlength="50" name="town">
      <input type="text" class="box" placeholder="city name" required maxlength="50" name="city">
      <input type="text" class="box" placeholder="state name" required maxlength="50" name="state">
      <input type="text" class="box" placeholder="country name" required maxlength="50" name="country">
      <input type="number" class="box" placeholder="pin code" required max="999999" min="0" maxlength="6" name="pin_code">
      <input type="submit" value="save address" name="submit" class="btn">
   </form>

</section>




<script src="script.js"></script>





</body>
</html>