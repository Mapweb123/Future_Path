<!-- Main content -->

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <?php if($this->session->flashdata('errors')){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo validation_errors(); ?> </div>
        <?php } ?>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Search Collages</h4>
          </div>
          <form role="form" action="<?php base_url('search') ?>" method="post">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Stream</label>
                    <select class="form-control" id="stream" name="stream" style="width:100%">
                      <option value="">Select Stream</option>
                      <?php foreach ($stream_data as $k => $v): 
					  if(@$post_data['stream'] == $v['stream_id']) $strStream = 'selected="selected"'; else $strStream = '';
					  ?>
                      <option <?php echo $strStream;?> value="<?php echo $v['stream_id'] ?>"><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Category</label>
                    <select class="form-control" id="category" name="category">
                      <option value="">Select Category</option>
                      <?php foreach ($category_data as $k => $v): 
					  if(@$post_data['category'] == $v['cat_id']) $strCate = 'selected="selected"'; else $strCate = '';
					  ?>
                      <option <?php echo $strCate;?> value="<?php echo $v['cat_id'] ?>"><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-4">
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
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Marks Lower Limit</label>
                    <input type="text" class="form-control" id="marks_low" name="marks_low" autocomplete="off" value="<?php echo @$post_data['marks_low'];?>">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="groups" class="bmd-label-floating">Marks Upper Limit</label>
                    <input type="text" class="form-control" id="marks_upper" name="marks_upper" autocomplete="off" value="<?php echo @$post_data['marks_upper'];?>">
                  </div>
                </div>
                <div class="col-12">
                  <?php //echo '<pre>'; print_r($post_data); echo '</pre>';
				if(@$post_data['marks_upper'] != ''){?>
                  <br />
                  <br />
                  <div class="table-responsive">
                    <table id="userTable" class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Exam</th>
                          <th>Sr. No.</th>
                          <th>Code</th>
                          <th>Collage Name</th>
                          <th>NRF Rank</th>
                          <th>Cut Off Marks Or %</th>
                          <th>Cut Off AI Rank</th>
                          <th>Mess Hostel Fee</th>
                          <th>Total Fee</th>
                          <th>Collage Mo. No.</th>
                          <th>Collage Email</th>
                          <th>Ex Stud. Cont. No.</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr><tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
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
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <?php }?>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Get Collage List</button>
            </div>
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