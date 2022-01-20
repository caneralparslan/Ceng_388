<?php
session_start();
if(isset($_GET['clear'])) 
{
  if ($_GET['clear']) 
  {
    unset($_SESSION['CART']);
    $_SESSION['MSGS'] = array('Your cart has been emptied.');
    session_write_close();
    header("location: cart.php");
    exit();
  }
}

if ( isset($_GET['del']) ) 
{
  foreach($_SESSION['CART'] as $cart_item_ID => $cart_item)
  {
      if($cart_item['pd_id'] == $_GET['del']){
        unset($_SESSION['CART'][$cart_item_ID]);
        $_SESSION['MSGS'] = array('Item remove from your cart.');
        session_write_close();
        header("location: cart.php");
        exit();
      }
  }
}

if(isset($_GET['add']) )
{
  require_once('config.php');
  $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
  if (!$link) {
    die("Cannot access db.");
  }

  $db = mysqli_select_db($link,DB_DATABASE);
  if(!$db) {
    die("Unable to select database");
  }
  $product;
  $res = mysqli_query($link,"SELECT `tbl_product`.*,`tbl_category`.`cat_name`
            FROM `tbl_product`
            INNER JOIN `tbl_category`
            ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
            WHERE `pd_id`=".$_GET['add']." LIMIT 1");

  $product = mysqli_fetch_assoc($res);

  if(!isset( $_SESSION['CART']) ) $_SESSION['CART'] = array();
  
  array_push($_SESSION['CART'], $product );  
  
  if(!in_array($product, $_SESSION['CART'])){
    $_SESSION['MSGS'] = array('Item added to your cart.');
	}
  else{
    $_SESSION['MSGS'] = array('There is also same item in your cart, but added again.');
    }
    session_write_close();
    header("location: store.php");
    exit();
}
?>
<?php
include 'includes/header.php';
include 'includes/nav.php';
include 'includes/profile-data.php';
?>
<div id="main">
  <header class="container">
    <h3 class="page-header">Cart</h3>
  </header>
  <div class="container">
    <?php if(isset($_SESSION['CART'])){ ?>
    <div class="table-responsive">
      <table class="table products-table">
      <thead>
        <tr>
          <th>Preview</th>
          <th>Name</th>
          <th>Description</th>
          <th class="text-center">Category</th>
          <th width="100" class="text-center">Price</th>
          <th class="text-center">Remove</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $_SESSION['total'] = 0;
        foreach ($_SESSION['CART'] as $item) {
          $_SESSION['total'] += $item['pd_price'];
          ?>
          <tr>
            <td><img style="max-width:140px;" src="img/uploads/<?php echo $item['pd_image'] ?>" alt="<?php echo $item['pd_name'] ?>"></td>
            <td><?php echo $item['pd_name'] ?></td>
            <td><?php echo $item['pd_description'] ?  $item['pd_description'] : '<span class="text-muted">No description</span>'; ?></td>
            <td class="text-center"><?php echo $item['cat_name'] ?></td>
            <?php setlocale(LC_MONETARY,'en_US'); ?>
            <td class="text-center">$ <?php echo number_format($item['pd_price'], 2); ?></td>
            <td class="text-center"><a href="cart.php?del=<?php echo $item['pd_id'] ?>"><span class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure you want to delete this item from you cart?');"> </span></a></td>
          </tr>
          <?php
        }
        ?>
        <tr>
          <td colspan="3"></td>
          <td>
            <h4>Total:</h4>
          </td>
          <td colspan="2" class="text-info">
            $ <?php echo number_format($_SESSION['total'], 2); ?>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="pull-right">
      <a href="cart.php?clear=true" class="btn btn-default">Clear <span class="glyphicon glyphicon-shopping-cart"></span></a> 
      <a href="order.php" class="btn btn-primary">Place Order</a>     
    </div>
    
    <?php 
    }
    else
    {
      echo '<div class="alert alert-info">Your Cart is Empty!</div>';
    }
    ?>
  </div>
</div>
<?php
include 'includes/footer.php';
?>