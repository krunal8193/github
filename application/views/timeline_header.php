<div class="container" style="padding: 0px 30px;margin-top:20px">
  <div class="col-md-3" style="width:200px">
    <div style="height: 200px;
      width: 200px;
      background-image: url('http://i.stack.imgur.com/2OrtT.jpg');
      background-size: cover;background-position: 50% 50%;">
    </div>
    <font size="6"><?php echo $user[0]['user_name'];?></font>
  </div>
  <div class="col-md-2" style="height: 250px;">
    <ul style="list-style-type: none;margin: 0;padding: 0;">
      <li id="listli" style="display: inline;">
      <div id="nedit">
          <div style="padding:10px;">
            <?php form_open('signin/update_user'); ?>
            <i class="fa fa fa-venus-mars fa-2x" aria-hidden="true"></i> 
            <?php echo $user[0]['user_gender'];?>
          </div>
          <div style="padding:10px;">
            <i class="fa fa-birthday-cake fa-2x" aria-hidden="true"></i> 
            <?php echo $user[0]['user_dob'];?>
          </div>
          <div style="padding:10px;">
            <i class="fa fa-phone fa-2x" aria-hidden="true"></i> 
            <?php echo $user[0]['user_number'];?>
          </div>
          <div style="padding:10px;">
            <i class="fa fa-home fa-2x" aria-hidden="true"></i> 
            <?php echo $user[0]['user_hometown'];?>
          </div>
          <div style="padding:10px;">
            <button class="btn btn-primary" id="edit"><i class="fa fa-edit" aria-hidden="true"></i></button>
            <a href="<?php echo site_url('login/logout');?>" >
              <button class="btn btn-primary"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
            </a>
          </div>
        </div>
        <form method="post" action="<?php echo site_url(); ?>/signin/update_user">
        <div id="fedit" style="display:none;">
          <div style="padding:10px;">
            <select class="form-control" name="gender">
              <option value="male" selected>Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div style="padding:10px;">
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="dob" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
          </div>
          <div style="padding:10px;">
            <input type="text" class="form-control" id="number" name="number" value="<?php echo $user[0]['user_number'];?>" />
          </div>
          <div style="padding:10px;">
            <input type="text" class="form-control" id="ht" name="ht" value="<?php echo $user[0]['user_hometown'];?>" />
          </div>
          <div style="padding:10px;">
            <input type="submit" name="save" class="btn btn-primary">
          </div>
        </div>
        </form>
      </li>
    </ul>
  </div>
  <div class="col-md-7" style="height:200px;float: right;">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-6">
          <center><a href="#" class="active" id="imgvid">Image/Video</a></center>
        </div>
        <div class="col-xs-6">
          <center><a href="#" id="images">Images</a></center>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-lg-12">
          <?php
            if (isset($_SESSION['errorImage'])) {
              foreach ($this->session->flashdata('errorImage') as $errorImage) {
                echo $errorImage;
              }
            }
            if (isset($_SESSION['success'])) {
              echo $this->session->flashdata('success');
            }
          ?>
          <div id="imgvid-form" style="display: block;" >
            <?php echo form_open_multipart('userpost/imgvid'); ?>
              <div class="form-group">
                <input type="text" name="desc" tabindex="1" class="form-control" placeholder="Write something about post...">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6">
                    <input type="file" name="images" tabindex="2" class="form-control">
                  </div>
                  <div class="col-sm-4 col-sm-offset-1">
                    <input type="submit" name="images-submit" tabindex="4" class="form-control btn btn-login" value="Post Image/Video">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div id="images-form" style="display: none;" >
            <?php echo form_open_multipart('userpost/images'); ?>
              <div class="form-group">
                <input type="text" name="desc" tabindex="1" class="form-control" placeholder="Write something about post...">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6">
                    <input type="file" multiple name="images[]" tabindex="2" accept="image/*" class="form-control">
                  </div>
                  <div class="col-sm-4 col-sm-offset-1">
                    <input type="submit" name="images-submit" tabindex="4" class="form-control btn btn-login" value="Post Album">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>