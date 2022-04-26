      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <h4 class="card-title">Manage Student</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="studentTable" class="table table-hover text-nowrap">
                  <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Photo</th>

                  <?php if(in_array('updateStudent', $user_permission) || in_array('deleteStudent', $user_permission)): ?>
                  <th>Action</th>
                  <?php endif; ?>
                </tr>
                </thead>
                  <tbody>
                  <?php if($student_data): ?>                  
                    <?php foreach ($student_data as $k => $v): ?>
                      <tr>                                                
                        <td><?php echo $v['student_info']['fname'] .' '. $v['student_info']['lname']; ?></td>
                        <td><?php echo $v['student_info']['email_id']; ?></td>
                        <td><?php echo $v['student_info']['mobile']; ?></td>
                        <td>
							<?php 
								//echo $v['student_info']['photo']; 
								if($v['student_info']['photo'] != '')
								{
									?>
                                    <img width="40px;" src="<?php echo base_url('uploads/stud_images/'.$v['student_info']['photo']);?>" />
                                    <?php
								}
							?>                        	
                        </td>

                        <?php if(in_array('updateStudent', $user_permission) || in_array('deleteStudent', $user_permission)): ?>

                        <td>
						 
							
                          <?php if(in_array('updateStudent', $user_permission)): ?>
                            <a href="<?php echo base_url('students/edit/'.$v['student_info']['stud_id']) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                          <?php endif; ?>
                          <?php if(in_array('deleteStudent', $user_permission)): ?>
                            <a href="<?php echo base_url('students/delete/'.$this->atri->en($v['student_info']['stud_id'])) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          <?php endif; ?>
                        </td>
                      <?php endif; ?>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
                </table>
                  </div>
                </div>
              </div>
            </div>
		   </div>
		</div>
	</div>	

