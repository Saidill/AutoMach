<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css">
</head>

<?php include 'user_header.php'; ?>

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="img/tengkorak.png" alt="">
      </div>

      <form action="" method="post">
         <h3>tell us something!</h3>
         <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required>
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="enter your number" required maxlength="10">
         <input type="email" name="email" maxlength="50" class="box" placeholder="enter your email" required>
         <textarea name="msg" class="box" required placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </form>

   </div>

</section>

<?php include 'footer.php'; ?>





<script src="script.js"></script>




</body>
</html>