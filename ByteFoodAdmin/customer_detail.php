<?php
    include("database.php");

    $db = getDatabase();

    $id = $_GET['id'];

    $customerinfo = $db->getCustomerViaId($id);

    isset($_GET['child']) ? $child = $_GET['child'] : $child = '';
?>
<?php include 'head.php';?>

<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-12">
      <h2>Customer Detail</h2>
      <div class="alert alert-dismissible bf-form-bg cardshadow">
        <form class="form-horizontal" method="post" action="customer_update_ctrl.php">
        <div class="col-md-6">
            <div class="form-group">
              <label for="name" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="name" name="name" value="<?=isset($customerinfo->name) ? $customerinfo->name : ''?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="username" class="col-lg-2 control-label">Username</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="username" name="username" value="<?=isset($customerinfo->username) ? $customerinfo->username : ''?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="age" class="col-lg-2 control-label">Age</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="age" name="age" value="<?=isset($customerinfo->age) ? $customerinfo->age : ''?>" readonly>
              </div>
            </div> 
            <div class="form-group">
              <label for="email" class="col-lg-2 control-label">Email</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="email" name="email" value="<?=isset($customerinfo->email) ? $customerinfo->email : ''?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="address" class="col-lg-2 control-label">Address</label>
              <div class="col-lg-10">
                <textarea type="text" class="form-control" id="address" name="address" style="height:200px" readonly><?=isset($customerinfo->address) ? $customerinfo->address : ''?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="dob" class="col-lg-2 control-label">DOB</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="dob" name="dob" value="<?=isset($customerinfo->dob) ? $customerinfo->dob : ''?>" readonly>
              </div>
            </div>
            <?php 
              if ($customerinfo->status == 0){
                $customerstatus = 'In Progress';
              } 
              else if ($customerinfo->status == 1){
                $customerstatus = 'Rejected';
              }
              else if ($customerinfo->status == 2){
                $customerstatus = 'Approved';
              }
              else{
                $customerstatus = '';
              }

              if ($customerinfo->type == 1){
                $customertype = 'Admin';
              } 
              else if ($customerinfo->type == 2){
                $customertype = 'Customer';
              }
              else{
                $customertype = '';
              }
            ?>
            <div class="form-group">
              <label for="status" class="col-lg-2 control-label">Status</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="status" name="status" value="<?=isset($customerstatus) ? $customerstatus : ''?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="type" class="col-lg-2 control-label">Type</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="type" name="type" value="<?=isset($customertype) ? $customertype : ''?>" readonly>
              </div>
            </div> 
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="photo" class="col-lg-2 control-label">Photo</label>
              <div class="col-lg-10">
                <div class="alert alert-dismissible alert-default cardshadow">
                  <img src="../ByteFood/member_img/<?php echo $customerinfo->photo?>" width="300"/>
                </div>  
              </div>
            </div>  
            </div>                                                             
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <?php if ($child == 'order') { ?>
                  <a href="order_list.php?parent=order&orderdate=<?=$_GET['date']?>" class="btn btn-default">Back</a>
                <?php } else { ?>
                  <a href="customer_list.php?parent=customer" class="btn btn-default">Back</a>
                <?php } ?>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div> 
</body>
</html>
