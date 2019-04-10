<?php
    include("database.php");
    //get session data first for page authentication
    if (!isset($_SESSION['member']))
    {
      //redirect to login_terminated.html
      //access violation of page
      $to = "login_terminated.php";
      
      header('Location: '. $to);
      exit;
    }

    $member = $_SESSION['member'];

    isset($_REQUEST['orderdate']) ? $orderdate = $_REQUEST['orderdate'] : $orderdate = date('d-m-Y'); 

  $db = getDatabase();

  $orderhistory = $db->order_listing(date("Y-m-d",strtotime($orderdate)));
?>
<?php include 'head.php';?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Order History</h2>
        <form action="order_list.php?parent=order" method="post" class="form">
            <div class="form-group">
                <div class='input-group date col-md-4'>
                    <input type='text' class="form-control" name="orderdate" id="orderdate" value="<?=$orderdate?>">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </form>
      <p>&nbsp;</p>
      <div class="alert alert-dismissible bf-form-bg cardshadow">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Order Number</th>
            <th>User ID</th>
            <th>Status</th>
            <th>Order Duration</th>
            <th>Total Price</th>
          </tr>
        </thead>
        <tbody>
          <?php $index = 1; foreach( $orderhistory as $row ) { ?> 
            <tr>
              <td class='id-column'><?=$index++?></td>
              <td><a href='order_detail.php?parent=order&orderno=<?=$row->order_no?>&date=<?=$orderdate?>'><?=$row->order_no?></a></td>
              <td><a href='customer_detail.php?parent=customer&id=<?=$row->membership_id?>&date=<?=$orderdate?>&child=order'><?=$row->user_id?></a></td>
              <td>
                <?php if ($row->order_status == '0') { ?>
                  <a href='order_status_ctrl.php?orderno=<?=$row->order_no?>&status=0&date=<?=$orderdate?>'><span class='label label-default'>In Progress</span></a>&nbsp;
                <?php } else if ($row->order_status == '1') { ?>
                  <a href='order_status_ctrl.php?orderno=<?=$row->order_no?>&status=1&date=<?=$orderdate?>'><span class='label label-warning'>In Delivery</span></a>&nbsp;
                <?php } else if ($row->order_status == '2') { ?>
                  <a href='order_status_ctrl.php?orderno=<?=$row->order_no?>&status=2&date=<?=$orderdate?>'><span class='label label-success'>Delivered</span></a>&nbsp;
                <?php } else if ($row->order_status == '3') { ?>
                  <span class='label label-danger'>Cancelled</span>
                <?php } ?>
              </td>
              <td><span class='label label-default'><?=$row->order_date?></span></td>
              <td><?=$row->foodprice?></td>
            </tr>
          <?php } ?>       
        </tbody>
        </table>
        </div>   
      </div>
    </div>
  </div>
</div>
      <script src="js/vendor/jquery-1.11.2.min.js"></script>
      <script src="js/moment.min.js"></script>
      <script src="js/bootstrap-datetimepicker.min.js"></script>    
      <script src="js/app.js"></script>
</body>
</html>
