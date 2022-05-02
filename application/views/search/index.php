<!-- Main content -->
<style>
.greenClass{
	background-color:#FF8080;
}
.redClass{
	background-color:#AEFFAE;
}
</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
      <div id="messages"></div>
        <?php if($this->session->flashdata('errors')){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo validation_errors(); ?> </div>
        <?php } ?>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Search Collages</h4>
          </div>
          <form role="form" action="<?php base_url('search') ?>" method="post" onsubmit="return checkForm();">
            <div class="card-body">
              <div class="row">
              	<div class="col-4">
                  <div class="form-group" id="year_div">
                    <label for="groups" class="bmd-label-floating">Aspirant Year</label>
                    <select class="form-control" id="year" name="year">
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
                    <label for="groups" class="bmd-label-floating">Stream</label>
                    <select class="form-control" id="stream" name="stream" style="width:100%" onchange="getAjaxData('exam',this.value);">
                      <option value="">Select Stream</option>
                      <?php foreach ($stream_data as $k => $v): 
					  if(@$post_data['stream'] == $v['stream_id']) $strStream = 'selected="selected"'; else $strStream = '';
					  ?>
                      <option <?php echo $strStream;?> value="<?php echo $v['stream_id'] ?>"><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group" id="exam_div">
                    <label for="groups" class="bmd-label-floating">Exam</label>
                    <select class="form-control" id="exam" name="exam" style="width:100%" onchange="getAjaxData('cast_category',this.value);">
                      <option value="">Select Exam</option>
                      <?php foreach ($exam_data as $k => $v): 
					  if(@$post_data['exam'] == $v['exam_id']) $strExam = 'selected="selected"'; else $strExam = '';
					  ?>
                      <option <?php echo $strExam;?> value="<?php echo $v['exam_id'] ?>"><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                
                <div class="col-4">
                  <div class="form-group" id="cast_div">
                    <label for="groups" class="bmd-label-floating">Cast Category</label>
                    <select class="form-control" id="cast" name="cast">
                      <option value="">Select Category</option>
                      <?php foreach ($cast_data as $k => $v): 
					  if(@$post_data['cast'] == $v['cast']) $strCate = 'selected="selected"'; else $strCate = '';
					  ?>
                      <option <?php echo $strCate;?> value="<?php echo $v['cast'] ?>"><?php echo $v['cast'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Select Student</label>
                    <select class="form-control" id="student" name="student">
                      <option value="">Select Student</option>
                      <?php foreach ($student_data as $k => $v): 
					  if(@$post_data['student'] == $v['stud_id']) $strStud = 'selected="selected"'; else $strStud = '';
					  ?>
                      <option <?php echo $strStud;?> value="<?php echo $v['stud_id'] ?>"><?php echo $v['fname'].' '.$v['mname'].' '.$v['lname']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <!--<div class="col-4">
                  <div class="form-group" >
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" name="mark_rank" type="radio" value="1" <?php if(@$post_data['mark_rank'] == '1') echo 'checked="checked"';?> >
                          Marks <span class="form-check-sign"> <span class="check"></span> </span> </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" name="mark_rank" type="radio" value="2" <?php if(@$post_data['mark_rank'] == '2') echo 'checked="checked"';?>>
                          Rank <span class="form-check-sign"> <span class="check"></span> </span> </label>
                      </div>
                    </div>
                  </div>
                </div>-->
                <div class="col-4">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Min Marks</label>
                    <input type="text" class="form-control" id="min_marks" name="min_marks" autocomplete="off" value="<?php echo @$post_data['min_marks'];?>">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Actual Marks</label>
                    <input type="text" class="form-control" id="actual_marks" name="actual_marks" autocomplete="off" value="<?php echo @$post_data['actual_marks'];?>">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Max Marks</label>
                    <input type="text" class="form-control" id="max_marks" name="max_marks" autocomplete="off" value="<?php echo @$post_data['max_marks'];?>">
                  </div>
                </div>
                <div class="col-12">
                	<button type="submit" class="btn btn-primary">Get Collage List</button>
              		<a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'];?>">Clear</a>
             	</div>
                <div class="col-12">
                  <?php //echo '<pre>'; print_r($post_data); echo '</pre>';
				  //echo '<pre>'; print_r($collage_data); echo '</pre>';
				if(@$post_data['max_marks'] != ''){?>
                  <br />
                  <br />
                  <div class="table-responsive">
                    <table id="userTable" class="table table-hover text-nowrap">
                      <thead>
                        <tr>                          
                          <th>Sr. No.</th>
                          <th>Exam</th>
                          <th>Program / Code</th>
                          <th>Collage Name</th>
                          <th>NRF Rank / Quota</th>
                          <th>Cut Off Open</th>
                          <th>Cut Off Close</th>
                          <th>Type</th>
                          <th>Intake</th>
                          <th>Total Fee</th>
                          <th>Collage Mo. No.</th>
                          <th>Collage Email</th>
                          <th>Collage Website</th>
                          <th>Mobile (Ex-Student)</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  foreach($collage_data as $k => $data){
						  $strClass = '';
						  if(@$post_data['actual_marks'] <= $data['close_rank'])
						  	$strClass = 'class="greenClass"';
						  else
						  	$strClass = 'class="redClass"';
						  ?>
                          <tr>
                          	  <td <?php echo $strClass;?>><?php echo $k+1;?></td>
                              <td <?php echo $strClass;?>><?php echo $exam_name;?></td>                              
                              <td <?php echo $strClass;?>><?php echo $data['program'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['collage'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['quota'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['open_rank'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['close_rank'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['collage_type'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['intake'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['total_fees'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['collage_mobile'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['collage_email'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['collage_website'];?></td>
                              <td <?php echo $strClass;?>><?php echo $data['exstud_mobile'];?></td>
                            </tr>
                          <?php
					  }
					  ?>
                      <!--<tr>
                        <td>MHT-CET</td>
                        <td>1</td>
                        <td>1103</td>
                        <td>GSMC, Mumbai - MBBS</td>
                        <td>8</td>
                        <td>657</td>
                        <td>2669</td>
                        <td>24000</td>
                        <td>1,56,500</td>
                        <td>9860130199</td>
                        <td>gsmc_mumbai@gmail.com</td>
                        <td>Amol Pawar (9898989898)</td>
                      </tr>-->
                      </tbody>
                    </table>
                  </div>
                  <?php }?>
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