<?php
    include("database.php");

    $db = getDatabase();

    $id = $_GET['id'];

    $menu = $db->getMenuViaId($id);
?>
<?php include 'head.php';?>

<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-6">
      <h2>Update Menu Form</h2>
      <div class="alert alert-dismissible bf-form-bg cardshadow">
        <form class="form-horizontal" method="post" action="menu_update_ctrl.php">

            <div class="form-group">
              <label for="menu_name" class="col-lg-2 control-label">Menu Name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?=isset($menu->menu_name) ? $menu->menu_name : ''?>" required>
              </div>
            </div>
            
            <div class="form-group">
              <label for="menu_type" class="col-lg-2 control-label">Menu Type</label>
              <div class="col-lg-10">
                <select class="form-control" id="menu_type" name="menu_type" onchange="javascript:show(this.options[this.selectedIndex].value)">
                  <option value="food" <?=isset($menu->menu_type) && $menu->menu_type == 'food' ? 'selected' : ''?>>Food</option>
                  <option value="drink" <?=isset($menu->menu_type) && $menu->menu_type == 'drink' ? 'selected' : ''?>>Drink</option>
                </select>
              </div>
            </div>
            <?php $menu->menu_type == 'food' ? $stylef = 'display: block' : $stylef = 'display: none' ?>
            <div class="form-group" id='hiddenFood' style='<?=$stylef?>'>
              <label for="menu_type" class="col-lg-2 control-label">Menu Category</label>
              <div class="col-lg-10">
                <select class="form-control" id="menu_categoryf" name="menu_categoryf">
                  <option value="malay" <?=isset($menu->menu_category) && $menu->menu_category == 'malay' ? 'selected' : ''?>>Malay</option>
                  <option value="western" <?=isset($menu->menu_category) && $menu->menu_category == 'western' ? 'selected' : ''?>>Western</option>
                  <option value="italian" <?=isset($menu->menu_category) && $menu->menu_category == 'italian' ? 'selected' : ''?>>Italian</option>
                </select>
              </div>
            </div>
            <?php $menu->menu_type == 'drink' ? $styled = 'display: block' : $styled = 'display: none' ?>
            <div class="form-group" id='hiddenDrink' style='<?=$styled?>'>
              <label for="menu_type" class="col-lg-2 control-label">Menu Category</label>
              <div class="col-lg-10">
                <select class="form-control" id="menu_categoryd" name="menu_categoryd">
                  <option value="hot" <?=isset($menu->menu_category) && $menu->menu_category == 'hot' ? 'selected' : ''?>>Hot</option>
                  <option value="cold" <?=isset($menu->menu_category) && $menu->menu_category == 'cold' ? 'selected' : ''?>>Cold</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="menu_price" class="col-lg-2 control-label">Price</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="menu_price" name="menu_price" value="<?=isset($menu->menu_price) ? number_format($menu->menu_price,2) : ''?>" required>
              </div>
            </div>    
            <div class="form-group">
              <label for="menu_status" class="col-lg-2 control-label">Menu Status</label>
              <div class="col-lg-10">
                <select class="form-control" id="menu_status" name="menu_status">
                  <option value="A" <?=$menu->menu_status == 'A' ? 'selected' : ''?>>Available</option>
                  <option value="S" <?=$menu->menu_status == 'S' ? 'selected' : ''?>>Sold Out</option>
                </select>
              </div>
            </div>                                                              
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <a href="menu_list.php?parent=menu" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div> 
</body>
</html>
