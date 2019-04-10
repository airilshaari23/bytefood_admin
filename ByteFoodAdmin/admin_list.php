<?php
    include("database.php");

    //get session data first for page authentication
    if (!isset($_SESSION['member']))
    {
      //redirect to login_terminated.html
      //access violation of page
      $to = "login_terminated.html";
      
      header('Location: '. $to);
      exit;
    }

    $member = $_SESSION['member'];

    $db = getDatabase();

    $admins = $db->admin_listing();

?>
<?php include 'head.php';?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Admin List
      <a href="admin_add.php?parent=admin" class="btn btn-primary pull-right">
      <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add New Admin
      </a>
      </h2>
      
      <p>&nbsp;</p>
      <div class="alert alert-dismissible bf-form-bg cardshadow">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Age</th>
            <th>Email</th>
            <th>DOB Date</th>
            <th>Photo</th>  
            <th>Status</th>
            <th>Added Date</th>            
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>
            <?php $index = 1; foreach($admins as $row) { ?> 
              <tr>
                  <td class='id-column'><?=$index++?></td>
                  <td><?=ucwords($row->name)?></td>
                  <td><a href='admin_detail.php?parent=admin&id=<?=$row->id?>'><?=$row->username?></a></td>
                  <td><?=$row->age?></td>
                  <td><?=$row->email?></td>
                  <td><span class='label label-default'><?=$row->dob?></span></td>
                  <td><img alt='Click to zoom' src='member_img/<?= $row->photo ?>' width='45' height = '30' onclick="javascript:image('member_img/<?= $row->photo ?>');"/></td>
                  <td>
                    <?php if ($row->status == 0) { ?>
                      <a href='admin_status_ctrl.php?id=<?=$row->id?>&status=0'><span class='label label-default'>In Process</span></a>
                    <?php } else if ($row->status == 1) { ?>
                      <a href='admin_status_ctrl.php?id=<?=$row->id?>&status=1'><span class='label label-danger'>Rejected</span></a>
                    <?php } else if ($row->status == 2) { ?>
                      <a href='admin_status_ctrl.php?id=<?=$row->id?>&status=2'><span class='label label-success'>Approved</span></a> 
                    <?php } ?>
                  </td>
                  <td><span class='label label-default'><?=$row->addeddate?></span></td>
                  <td>
                    <a href='admin_delete.php?id=<?=$row->id?>'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>&nbsp;
                    <a href='admin_update.php?parent=admin&id=<?=$row->id?>'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>&nbsp;
                  </td>
              </tr>
            <?php } ?>       
        </tbody>
        </table>  
        </div>
        <div id="myModal" class="modal">
          <span class="close">&times;</span>
          <img class="modal-content" id="img01">
          <div id="caption"></div>
        </div>  
      </div>
    </div>
  </div>
</div>
  <script>
// Get the modal
var modal = document.getElementById('myModal');
function image(e){
  //alert(e);
  var modalImg = document.getElementById("img01");
    modal.style.display = "block";
    modalImg.src = e;
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>
</body>
</html>
