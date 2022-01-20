<?php 
include_once 'orders-data.php'; ?>
  <div class="col-md-12">
    <?php
    if(isset($orders) && count($orders)>0)
    {
    ?>
    <table class="table table-hover products-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Products</th>
          <th>Status</th>
          <th>Name</th>
          <th>Address</th>
          <th>Cost</th>
		  <th>Change Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($orders as $orders) {;
        ?>
          <tr>
            <td><?php echo $orders->od_id; ?></td>
            <td><?php echo $orders->od_date; ?></td>
            <td><?php echo $orders->products; ?></td>
            <td><?php echo $orders->od_status; ?></td>
            <td><?php echo $orders->od_name; ?></td>
            <td><?php echo $orders->od_address . '<br>' . $orders->od_city . ' ' . $orders->od_postal_code; ?></td>
            <td>$ <?php echo $orders->od_cost ?></td>
			<td> 
			<a href="orders-data.php?New"> New</a>
			<a href="orders-data.php?Shipped">Shipped</a>
			<a href="orders-data.php?Completed">Completed</a>
			<a href="orders-data.php?Cancelled">Cancelled</a>
			<a href="orders-data.php?delete=<?php echo $orders->od_id ?>"><span class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure you want to delete this order?');"> </span></a>
			</td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    <?php
    }
    else { ?>
      <div class="alert alert-warning"> Didn't find any orders, please add some.</div>
    <?php
    }
    ?>
  </div>