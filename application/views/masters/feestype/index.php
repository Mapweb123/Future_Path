<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>   <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div id="messages"></div>
          <?php if(in_array('createMaster', $user_permission)): ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Feestypes</button>
          <?php endif; ?>
          <div class="card">
             <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                  </div>
                 
                </div>
            <div class="card-body">
			<div class="table-responsive">
              <table id="manageTable" class="table table-striped">
                <thead>
                <tr>
                  <th>Feestype</th>
                  <th>Amount</th>
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
	  	<h5 class="modal-title">Add Feestype</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>

      <form role="form" action="<?php echo base_url('masters/createFeestype') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name" class="bmd-label-floating">Feestype</label>
            <input type="text" class="form-control" id="feestype_name" name="feestype_name" autocomplete="off" required>
          </div>
          
          <div class="form-group">
            <label for="active">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
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
        <h4 class="modal-title">Edit Feestype</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>

      <form role="form" action="<?php echo base_url('masters/updateFeestype') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="brand_name" class="bmd-label-floating">Feestype</label>
            <input type="text" class="form-control" id="edit_feestype_name" name="edit_feestype_name" autocomplete="off">
          </div>
          
          <div class="form-group">
            <label for="active">Amount</label>
            <input type="text" class="form-control" id="edit_amount" name="edit_amount" autocomplete="off" required>
          </div>
          
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
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
        <h4 class="modal-title">Remove Feestype</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>

      <form role="form" action="<?php echo base_url('masters/removeFeestype') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>