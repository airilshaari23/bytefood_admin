<?php
    include("database.php");

    $db = getDatabase();

    $id = $_GET['id'];

    $admininfo = $db->getAdminViaId($id);
?>
<?php include 'head.php';?>

<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-12">
      <h2 class="bf-h2-info">Update Admin Form</h2>
      <div class="col-md-12 bf-form-bg">
        <form class="form-horizontal " method="post" action="admin_update_ctrl.php">
        <div class="col-md-6">
            <div class="form-group">
              <label for="name" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="name" name="name" value="<?=isset($admininfo->name) ? $admininfo->name : ''?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="username" class="col-lg-2 control-label">Username</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="username" name="username" value="<?=isset($admininfo->username) ? $admininfo->username : ''?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="age" class="col-lg-2 control-label">Age</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="age" name="age" value="<?=isset($admininfo->age) ? $admininfo->age : ''?>" readonly>
              </div>
            </div> 
            <div class="form-group">
              <label for="email" class="col-lg-2 control-label">Email</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="email" name="email" value="<?=isset($admininfo->email) ? $admininfo->email : ''?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="address" class="col-lg-2 control-label">Address</label>
              <div class="col-lg-10">
                <textarea type="text" class="form-control" id="address" name="address" style="height:200px" readonly><?=isset($admininfo->address) ? $admininfo->address : ''?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="dob" class="col-lg-2 control-label">DOB</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="dob" name="dob" value="<?=isset($admininfo->dob) ? $admininfo->dob : ''?>" readonly>
              </div>
            </div> 
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="photo" class="col-lg-2 control-label">Photo</label>
              <div class="col-lg-10">
                <div class="alert alert-dismissible alert-default cardshadow">
                  <img src="member_img/<?php echo $admininfo->photo?>" width="300"/>
                </div>  
              </div>
            </div> 
            <div class="form-group">
              <label for="status" class="col-lg-2 control-label">Status</label>
              <div class="col-lg-10">
                <select class="form-control" id="status" name="status">
                  <option value="0" <?=$admininfo->status == '0' ? 'selected' : ''?>>In Progress</option>
                  <option value="1" <?=$admininfo->status == '1' ? 'selected' : ''?>>Rejected</option>
                  <option value="2" <?=$admininfo->status == '2' ? 'selected' : ''?>>Approved</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="type" class="col-lg-2 control-label">Type</label>
              <div class="col-lg-10">
                <select class="form-control" id="type" name="type">
                  <option value="1" <?=$admininfo->type == '1' ? 'selected' : ''?>>Admin</option>
                  <option value="2" <?=$admininfo->type == '2' ? 'selected' : ''?>>Customer</option>
                </select>
              </div>
            </div>  
            </div>                                                            
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <a href="admin_list.php?parent=admin" class="btn btn-default">Cancel</a>
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
