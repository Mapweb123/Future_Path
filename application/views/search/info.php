<!-- Main content -->

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
      <div id="messages"></div>
        <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Update Collages Information</h4>
          </div>
          <form role="form" name="frm_info" id="frm_info" action="<?php echo base_url().'search/info'; ?>" method="post">
            <div class="card-body">
              <div class="row">
              <div class="col-4">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Aspirant Year</label>
                    <select class="form-control" id="year" name="year" onchange="submitFrom();">
                      <option value="">Select Year</option>
                      <?php foreach ($year_data as $k => $v): 
					  if(@$post_data['year'] == $v['aspirant_year_id'].'#'.$v['title']) $strYear = 'selected="selected"'; else $strYear = '';
					  ?>
                      <option <?php echo $strYear;?> value="<?php echo $v['aspirant_year_id'].'#'.$v['title'] ?>"><?php echo $v['title'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                
              	<div class="col-4">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Select Table</label>
                    <select class="form-control" id="table" name="table">
                      <option value="">Select Table</option>
                      <?php foreach ($table_data as $k => $v): 
					  if(@$post_data['table'] == $v) $strTable = 'selected="selected"'; else $strTable = '';
					  ?>
                      <option <?php echo $strTable;?> value="<?php echo $v; ?>"><?php echo $v; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>                
                <div class="col-4">
                	<button type="submit" class="btn btn-primary" name="btn_get_data">Get Data</button>
              		<a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'];?>">Clear</a>
                    <button type="submit" class="btn btn-primary" name="btn_update_data" value="update_data">Update Data</button>
             	</div>
                <div class="col-12">
                  <?php 
				  //echo '<pre>'; print_r($post_data); echo '</pre>';
				  //echo '<pre>'; print_r($table_data); echo '</pre>';
				  //echo '<pre>'; print_r($update_data); echo '</pre>';
				  ?>
                  <div class="table-responsive">
                    <table id="userTable" class="table table-hover ">
                      <thead>
                        <tr>                          
                          <th>Sr. No.</th>
                          <th style="width:15%;">Collage Name</th>
                          <th style="width:15%;">Program</th>
                          <th>Collage</th>
                          <th>Intake</th>
                          <th>Total Fees</th>
                          <th>Collage Mobile</th>
                          <th>Collage Email</th>
                          <th>Website</th>
                          <th>Mobile (Ex-Student)</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  $i = 1;
					  if(count($update_data) > 0){
						  foreach($update_data as $Key => $Value){
							  ?>
                              <tr>                          
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $Value['collage'];?></td>
                                  <td><?php echo $Value['program'];?></td>
                                  <td><?php echo $Value['collage_type'];?></td>
                                  <td>
                                  <input type="hidden" name="txt_collage[]" value="<?php echo $Value['collage'];?>" />
                                  <input type="hidden" name="txt_program[]" value="<?php echo $Value['program'];?>" />
                                  
                                  <input type="text" name="txt_intake[]" value="<?php echo $Value['intake'];?>" placeholder="Intake" style="width:100%;" /></td>
                                  <td><input type="text" name="txt_total_fees[]" value="<?php echo $Value['total_fees'];?>" placeholder="Total Fees" style="width:100%;" /></td>
                                  <td><input type="text" name="txt_collage_mobile[]" value="<?php echo $Value['collage_mobile'];?>" placeholder="Mobile" style="width:100%;" /></td>
                                  <td><input type="text" name="txt_collage_email[]" value="<?php echo $Value['collage_email'];?>" placeholder="Email" style="width:100%;" /></td>
                                  <td><input type="text" name="txt_collage_website[]" value="<?php echo $Value['collage_website'];?>" placeholder="Website" style="width:100%;" /></td>
                                  <td><input type="text" name="txt_exstud_mobile[]" value="<?php echo $Value['exstud_mobile'];?>" placeholder="Mobile (Ex-Student)"style="width:100%;" /></td>
                              </tr>
                              <?php
							  $i++;
						  }
					  }
					  else{
						  ?>
                          <tr>
                          	<td colspan="100%">Sorry, no records</td>
                          </tr>
                          <?php
					  }
					  ?>
                      </tbody>
                   </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            
            <!--<div class="card-footer">
              <button type="submit" class="btn btn-primary">Get Collage List</button>
              <a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'];?>">Clear</a>
            </div>-->
          </form>
        </div>
        <!-- /.card --> 
      </div>
      <!-- col-md-12 --> 
    </div>
    <!-- /.row --> 
    
  </div>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper -->