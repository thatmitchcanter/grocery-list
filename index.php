<!DOCTYPE html>
<html>
<?php
$title = "Mitch's Grocery App";
include_once('config/head.php');
include_once('config/db.php');
global $mysqli;
?>

<body>
  <div class="container">
    <h3><?php echo $title; ?></h3>
    <?php include ('partials/buttons.php');
    if (!$_GET['sort']) {
      $sort = 'item';
    } else {
      $sort = $_GET['sort'];
    }

    if(isset($_GET['clear'])) {

      $sql = "DELETE from grocery_list";

      if ($mysqli->query($sql) === TRUE) {
        echo "<em>List Cleared!</em>";
      } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }

    }

    ?>
    <?php if ($sort == 'item') { ?>
      <h4>Current List</h4><hr />
    <?php } elseif ($sort == 'store') { ?>
      <h4>Items By Store</h4><hr />
    <?php } ?>

    <div class="grocery_list">

      <?php
        $result = $mysqli->query("SELECT * FROM grocery_list ORDER BY item");

        if ($sort == 'store') {
          $stores = array();
          foreach ( $result as $value ) {
              $stores[$value['location']][] = $value;
          }

          if (count($stores) == 0) {

            echo "<p>No Items Added To List.</p>";

          } else {

            foreach ($stores as $store=>$items) { ?>

            <h4><?php echo $store; ?></h4>

            <table>
              <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Price</th>
                    <th scope="col">Location</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $cost = 0;
              $number = count($items);
              if ($items){
                foreach ($items as $item){ ?>
                  <tr>
                    <td><?php echo $item['item']; ?></td>
                    <td>$<?php $cost = $cost + $item['price']; printf("%.2f", $item['price']); ?></td>
                    <td><?php echo $item['location']; ?></td>
                  </tr>
                <?php }
              } else {
                echo "<p>No Results</p>";
              }

              ?>


              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3">Approx. Cost (with tax): <strong style="font-weight: 700">$<?php $cost = $cost * 1.1; printf("%.2f", $cost); ?></strong></td>
                </tr>
                <tr>
                  <td colspan="3">Total Items: <strong style="font-weight: 700"><?php echo $number; ?></strong></td>
                </tr>
              </tfoot>
            </table>

            <?php }

          }

        } else { $number = $result->num_rows; ?>
        <?php if ($number != 0) { ?>
          <table>
            <thead>
              <tr>
                  <th scope="col">Item</th>
                  <th scope="col">Price</th>
                  <th scope="col">Location</th>
              </tr>
            </thead>
            <tbody>
              <?php

                $cost = null;


                if ($result != null){
                  foreach ($result as $result){ ?>
                    <tr>
                      <td><?php echo $result['item']; ?></td>
                      <td>$<?php $cost = $cost + $result['price']; echo $result['price']; ?></td>
                      <td><?php echo $result['location']; ?></td>
                    </tr>
                  <?php }
                } else {
                  echo "<p>No Items Added</p>";
                }
              ?>
            </tbody>
            <?php if ($result){ ?>
            <tfoot>
              <tr>
                <td colspan="3">Approx. Cost (with tax): <strong style="font-weight: 700">$<?php $cost = $cost * 1.1; echo round($cost, 2); ?></strong></td>
              </tr>
              <tr>
                <td colspan="3">Total Items: <strong style="font-weight: 700"><?php echo $number; ?></strong></td>
              </tr>
            </tfoot>
          <?php } ?>
          </table>
          <?php } else { ?>
            <?php echo "<p>No Items Added To List."; ?>
          <?php } ?>
        <?php } ?>

    </div>

    <p><a class="waves-effect waves-light btn" href="http://mitch.local/apps/grocery/?clear"><i class="material-icons left">clear</i>Clear Lists</a></p>

  </div>
</body>

</html>
