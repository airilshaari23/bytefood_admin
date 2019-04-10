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

  $db = getDatabase();

  $menufood = $db->menufood_listing();
  $menudrink = $db->menudrink_listing();

?>
<?php include 'head.php';?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Menu List
      <a href="menu_add.php?parent=menu" class="btn btn-primary pull-right">
      <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add New Menu
      </a>
      </h2>
      
      <p>&nbsp;</p>
      <div class="bf-form-bg bf-opc">
        <h3 class="bf-h2-info">Food List</h3>
         <div class="table-responsive">
        <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Menu Name</th>
            <th>Menu Price</th>
            <th>Status</th>
            <th>Added Date</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody>
            <?php $index = 1; $category = ''; foreach($menufood as $mf) { ?> 
              <?php if ($mf->menu_category != $category) { ?>
                <?php $category = $mf->menu_category; ?>
                <tr>
                  <td colspan='6' class='cat'><?=strtoupper($category)?> FOOD</td>
                </tr>
              <?php } ?>
                <tr>
                  <td class='id-column'><?=$index++?></td>
                  <td><?=ucwords($mf->menu_name)?></td>
                  <td><?=$mf->menu_price?></td>
                  <td>
                  <?php if ($mf->menu_status == 'A'){ ?>
                    <a href='menu_status_ctrl.php?id=<?=$mf->id?>&status=A'><span class='label label-success'>Available</span></a>
                  <?php } else if ($mf->menu_status == 'S'){ ?>
                    <a href='menu_status_ctrl.php?id=<?=$mf->id?>&status=S'><span class='label label-danger'>Sold Out</span></a>
                  <?php } ?>
                  </td>
                  <td><span class='label label-default'><?=$mf->addeddate?></span></td>
                  <td>
                    <a href='menu_delete.php?id=<?=$mf->id?>'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>&nbsp;
                    <a href='menu_update.php?parent=menu&id=<?=$mf->id?>'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                  </td>
                </tr>
            <?php } ?>        
        </tbody>
        </table>
        </div>    
      </div>
      <div class="bf-form-bg bf-opc">
        <h3 class="bf-h2-info">Drink List</h3>
        <div class="table-responsive">
        <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Menu Name</th>
            <th>Menu Price</th>
            <th>Status</th>
            <th>Added Date</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody>
            <?php $index = 1; $category = ''; foreach($menudrink as $md) { ?> 
              <?php if ($md->menu_category != $category) { ?>
                <?php $category = $md->menu_category; ?>
                <tr>
                  <td colspan='6' class='cat'><?=strtoupper($category)?> DRINK</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class='id-column'><?=$index++?></td>
                  <td><?=ucwords($md->menu_name)?></td>
                  <td><?=$md->menu_price?></td>
                  <td>
                  <?php if ($md->menu_status == 'A'){ ?>
                    <a href='menu_status_ctrl.php?id=<?=$md->id?>&status=A'><span class='label label-success'>Available</span></a>
                  <?php } else if ($md->menu_status == 'S'){ ?>
                    <a href='menu_status_ctrl.php?id=<?=$md->id?>&status=S'><span class='label label-danger'>Sold Out</span></a>
                  <?php } ?>
                  </td>
                  <td><span class='label label-default'><?=$md->addeddate?></span></td>
                  <td>
                    <a href='menu_delete.php?id=<?=$md->id?>'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>&nbsp;
                    <a href='menu_update.php?parent=menu&id=<?=$md->id?>'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                  </td>
                </tr>
            <?php } ?>        
        </tbody>
        </table>   
        </div> 
      </div>
    </div>
  </div>
</div>

</body>
</html>
