<!DOCTYPE html>
<html>
<?php
$title = "Add New Items";
include_once('config/head.php');
include_once('config/db.php');
global $mysqli;
?>

<body>
  <div class="container">
    <h3><?php echo $title; ?></h3>
    <?php include ('partials/buttons.php'); ?>

    <?php if ($_POST['item']) {

      $item = htmlspecialchars($_POST['item']);
      $price = $_POST['price'];
      $location = htmlspecialchars($_POST['store']);

      $sql = "INSERT INTO grocery_list (item, price, location)
              VALUES ('$item', '$price', '$location')";

      if ($mysqli->query($sql) === TRUE) {
        echo "<em>Item Added! Add Another?</em>";
      } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }

    } else {

    } ?>

    <h4>Add an Item</h4>
    <form action="#" method="post">

       <p>
           <label for="item">Item:</label>
           <input type="text" name="item" id="item">
       </p>

       <p>
           <label for="price">Price:</label>
           <input type="text" name="price" id="price">
       </p>


       <p>
         <label>
           <input name="store" value="Aldi" type="radio" />
           <span>Aldi</span>
         </label>
         &nbsp;
         <label>
           <input name="store" value="Sam's Club" type="radio"  />
           <span>Sam's Club</span>
         </label>
          &nbsp;
         <label>
           <input name="store" value="Target" type="radio" />
           <span>Target</span>
         </label>
          &nbsp;
         <label>
           <input name="store" value="Walmart" type="radio" />
           <span>Walmart</span>
         </label>
       </p>

       <button class="btn waves-effect waves-light" type="submit" name="action">Add Item
         <i class="material-icons left">add</i>
       </button>

   </form>

  </div>
</body>

</html>
