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
      <h2>Insert Menu Form</h2>
      <div class="alert alert-dismissible bf-form-bg cardshadow">
        <form class="form-horizontal" method="post" action="menu_add_ctrl.php">
            <?php if ($_SESSION['error']) { ?>
            <div class="alert alert-dismissible alert-warning cardshadow">
            <?php if (strpos($_SESSION['error'],'Duplicate') !== false) { ?>
              Error: <?='Duplicate menu name. Please choose another menu name'?>
            <?php } else { ?>
              Error: <?php echo  $_SESSION['error']?>
            <?php } ?>
            </div>
            <?php } ?>
            <div class="form-group">
              <label for="menu_name" class="col-lg-2 control-label">Menu Name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Menu Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="menu_type" class="col-lg-2 control-label">Menu Type</label>
              <div class="col-lg-10">
                <select class="form-control" id="menu_type" name="menu_type" onchange="javascript:show(this.options[this.selectedIndex].value)">
                  <option value="food">Food</option>
                  <option value="drink">Drink</option>
                </select>
              </div>
            </div>
            <div class="form-group" id='hiddenFood' style='display: block'>
              <label for="menu_type" class="col-lg-2 control-label">Menu Category</label>
              <div class="col-lg-10">
                <select class="form-control" id="menu_categoryf" name="menu_categoryf">
                  <option value="malay">Malay</option>
                  <option value="western">Western</option>
                  <option value="italian">Italian</option>
                </select>
              </div>
            </div>
            <div class="form-group" id='hiddenDrink' style='display: none'>
              <label for="menu_type" class="col-lg-2 control-label">Menu Category</label>
              <div class="col-lg-10">
                <select class="form-control" id="menu_categoryd" name="menu_categoryd">
                  <option value="hot">Hot</option>
                  <option value="cold">Cold</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="menu_price" class="col-lg-2 control-label">Price</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="menu_price" name="menu_price" placeholder="Price" required>
              </div>
            </div>                                                                  
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <a href="menu_list.php?parent=menu" class="btn btn-default">Cancel</a>
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
