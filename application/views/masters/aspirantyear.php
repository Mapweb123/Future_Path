<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>   <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <div id="messages"></div>
          
          <?php if(in_array('createMaster', $user_permission)): ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Aspirant Year</button>
            
          <?php endif; ?>


          <div class="card">
             <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                  </div>
                 
                </div>
            <div class="card-body">
			<div class="table-responsive">
              <table id="manageTable" class="table table-striped">
                <thead>
                <tr>
                  <th>Aspirant Year</th>
                  <th>Status</th>
                  <?php if(in_array('updateMaster', $user_permission) || in_array('deleteMaster', $user_permission)){ ?>
                  <th>Action</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php if(in_array('createMaster', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  	<h5 class="modal-title">Add Aspirant Year</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>

      <form role="form" action="<?php echo base_url('masters/createAspirantYear') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name" class="bmd-label-floating">Aspirant Year</label>
            <select class="form-control" id="aspirantyear_name" name="aspirantyear_name" style="width:100%">
                <?php
				//$dates = range('2021', date('Y') + 5);
				$dates = range(date('Y') + 5, '2021');
				foreach($dates as $date){
				    $year = "April ".($date-1) . ' - ' . "March ". $date;
					//$year = "April ".$date . ' - ' . "March ". ($date + 1);
					/*if (date('m', strtotime($date)) <= 6) {//Upto June
						$year = "April ".($date-1) . ' - ' . "March ". $date;
					} else {//After June
						$year = "April ".$date . ' - ' . "March ". ($date + 1);
					}*/
				
					echo "<option value='$year'>$year</option>";
				}
				?>
            </select>
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateMaster', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Aspirant Year</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>

      <form role="form" action="<?php echo base_url('masters/updateAspirantYear') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="brand_name" class="bmd-label-floating">Aspirant Year</label>
            <select class="form-control" id="edit_aspirantyear_name" name="edit_aspirantyear_name" style="width:100%">
                <?php
				//$dates = range('2021', date('Y') + 5);
				$dates = range(date('Y') + 5, '2021');
				foreach($dates as $date){
				    $year = "April ".($date-1) . ' - ' . "March ". $date;
					echo "<option value='$year'>$year</option>";
				}
				?>
            </select>
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteMaster', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove Aspirant Year</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>

      <form role="form" action="<?php echo base_url('masters/removeAspirantYear') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



