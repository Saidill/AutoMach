<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'add_cart.php';

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


<section class="home">
            <div class="area">
                <div class="content">
                    <span>Start Your Engine</span>
                    <h3>Drive Beyond.</h3>
                     <a href="menu.php" class="btn">See Items</a>
                 </div>
                <div class="image">
                    <img src="img/mobil.png" alt="">
                </div>
            </div>
</section>


<section class="category">

    <h1 class="title">Items Category</h1>

    <div class="box-container">

    <a href="category.php?category=spare parts" class="box">
        <img src="img/car-engine.png" alt="">
        <h3>Spare Parts</h3>
    </a>

    <a href="category.php?category=sport car" class="box">
        <img src="img/sport-car.png" alt="">
        <h3>Sport Car</h3>
    </a>

    <a href="category.php?category=sport bike" class="box">
        <img src="img/motorbike.png" alt="">
        <h3>Sport Bike</h3>
    </a>

    <a href="category.php?category=accessories" class="box">
        <img src="img/helmet.png" alt="">
        <h3>Accessories</h3>
    </a>

    </div>

</section>

<section class="products">

   <h1 class="title">Latest Items</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fa-solid fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">View All</a>
   </div>

</section>




<?php include 'footer.php'; ?>





<script src="script.js"></script>




</body>
</html>