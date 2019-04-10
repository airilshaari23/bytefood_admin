<?php
  session_start(); 
  if (!isset($_SESSION['error']))
    $_SESSION['error'] = NULL;
?>
<?php include 'head.php';?>

<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-6">
      <h2>Insert Customer Form</h2>
      <div class="alert alert-dismissible bf-form-bg cardshadow">
        <form class="form-horizontal" method="post" action="customer_add_ctrl.php">
            <?php if ($_SESSION['error']) { ?>
            <div class="alert alert-dismissible alert-warning cardshadow">
            <?php if (strpos($_SESSION['error'],'Duplicate') !== false) { ?>
              Error: <?='Duplicate username. Please choose another username'?>
            <?php } else { ?>
              Error: <?php echo  $_SESSION['error']?>
            <?php } ?>
            </div>
            <?php } ?>
            <div class="form-group">
              <label for="name" class="col-lg-2 control-label">Customer Name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Customer Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="username" class="col-lg-2 control-label">Customer Username</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Customer Username" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-lg-2 control-label">Customer Password</label>
              <div class="col-lg-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Customer Password" required>
              </div>
            </div>                                                                  
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <a href="customer_list.php?parent=customer" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div> 
<?php unset($_SESSION['error']); ?>
</body>
</html>
