<?php
/*
 * Copyright (c)2017, Jenmar "Maco" Cortes
 * Copyright TechDepot PH
 * All Rights Reserved
 * 
 * This license is a legal agreement between you and the Maco Cortes
 * for the use of STI Online Voting Systen referred to as the "Software"
 * By obtaining the Software you agree to comply with the terms and conditions of this license.
 *
 * PERMITTED USE
 * With approval from Maco Cortes, You are permitted to use the program for educational purposes only.
 * 
 * MODIFICATION AND REDISTRIBUTION 
 * Unless with written approval obtained from Maco Cortes, 
 * You are NOT allowed to modify, copy, redistribute, and sell the Software.
 *
 * For any concerns, you may reach Maco Cortes via:
 * maco.techdepot@gmail.com
 * facebook.com/Maaacoooo
 * maco@techdepot-ph.com
 * TechDepot-PH.com
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title><?=$title?> &middot; <?=$site_title?></title>

    <?php $this->load->view('inc/css'); ?>


</head>

<body>
    
    <?php $this->load->view('inc/header'); ?>

    <!-- //////////////////////////////////////////////////////////////////////////// -->


  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <?php $this->load->view('inc/left_nav'); ?>

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title"><?=$title?></h5>
                <ol class="breadcrumb">
                    <li><a href="#">Administrative Options</a></li>       
                    <li><a href="<?=base_url('sys/users/')?>">Users</a></li>
                    <li class="active"><?=$title?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            <div class="row">
              <div class="col s12">
                <?php
                //ERROR ACTION                          
                  if($this->session->flashdata('error')) { ?>
                    <div class="card-panel deep-orange darken-3">
                        <span class="white-text"><i class="mdi-alert-warning tiny"></i> <?php echo $this->session->flashdata('error'); ?></span>
                    </div>
              <?php } ?> 
              <?php
                //SUCCESS ACTION                          
                  if($this->session->flashdata('success')) { ?>
                    <div class="card-panel green">
                        <span class="white-text"><i class="mdi-action-done tiny"></i> <?php echo $this->session->flashdata('success'); ?></span>
                    </div>
              <?php } ?>             
              <?php
                //FORM VALIDATION ERROR
                    $this->form_validation->set_error_delimiters('<p><i class="mdi-alert-warning tiny"></i> ', '</p>');
                      if(validation_errors()) { ?>
                    <div class="card-panel yellow amber">
                        <span class="white-text"> <?php echo validation_errors(); ?></span>
                    </div>
              <?php } ?> 
              </div>
            </div>
            
            <div class="row card">
              <div class="col s12 l3">                
                  <div class="card-content">
                    <?php if(filexist($info['img']) && $info['img']): ?>
                      <img src="<?=base_url('uploads/'.$info['img'])?>" alt="" class="responsive-img">
                    <?php else: ?>
                      <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="responsive-img valign">
                    <?php endif; ?>
                  </div><!-- /.card-content -->           
              </div><!-- /.col s12 l4 card -->
              <div class="col s12 l9">  
                  <?=form_open_multipart('sys/users/update/' . $info['username'], array('class' => 'card-content'))?>
                      <div class="row">
                        <div class="input-field col s12">
                          <input type="text" name="" id="" class="validate" value="<?=$info['username']?>" disabled="" />
                          <label for="">Username</label>
                        </div><!-- /.input-field col s12 -->
                      </div><!-- /.row -->
                       <div class="row">
                         <div class="input-field col s12 l9">
                            <input id="name" name="name" type="text" class="validate" value="<?=$info['name']?>" required>
                            <label for="name">Full Name</label>
                         </div>
                         <div class="input-field col s12 l3">
                           <div class="file-field input-field">
                            <div class="btn">
                              <span>IMG</span>
                              <input type="file" name="img">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text">
                            </div>
                          </div>
                         </div><!-- /.input-field col s12 l3 -->
                       </div><!-- /.row -->
                       <div class="row">
                         <div class="input-field col s12">
                           <div class="select-wrapper">  
                              <select class="browser-default" name="usertype" required>                                  
                                  <?php 
                                    if($usertypes):
                                    foreach($usertypes as $usr):
                                  ?>
                                  <option value="<?=$usr['title']?>" <?php if($usr['title']==$info['usertype'])echo'selected';?>><?=$usr['title']?></option>
                                  <?php
                                    endforeach;
                                    endif;
                                  ?>
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Usertype</label>
                         </div><!-- /.input-field col s6 -->
                       </div><!-- /.row -->
    
                       <div class="row">
                          <div class="input-field col s12">
                                  <button class="btn amber waves-effect waves-light right" type="submit" name="action">Update
                                    <i class="mdi-editor-mode-edit left"></i>
                                  </button>
                          </div>
                       </div><!-- /.row -->
                       <?php if(!$user['username'] == $info['username']): ?>
                       <div class="row">
                         <div class="input-field col s12">
                           <a href="#deleteModal" class="modal-trigger btn waves-effect red right">Delete <i class="mdi-action-delete right"></i></a>
                         </div><!-- /.input-field col s12 -->
                       </div><!-- /.row -->
                       <?php endif; ?>
                      
                      <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['username'])?>" />
                                  
              </div><!-- /.col s12 l8 -->
            </div><!-- /.row -->
            <?=form_close()?>

            <!-- Modals -->
           <?php if(!$user['username'] == $info['username']): ?>
           <div id="deleteModal" class="modal">
              <?=form_open('sys/users/delete')?>
                <div class="modal-content red darken-4 white-text">
                    <p>Are you sure to delete the record of <span class="strong"><?=$info['name']?></span>?</p>
                    <p>You <span class="strong">CANNOT UNDO</span> this action.</p>
                    <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['username'])?>" />
                  </div>
                  <div class="modal-footer grey darken-4">
                    <a href="#" class="waves-effect waves-red btn-flat amber-text strong modal-action modal-close">Cancel</a>
                    <button type="submit" class="waves-effect waves-red btn red modal-action">Delete</button>
                  </div>
              <?=form_close()?>
            </div>
            <?php endif; ?>


           <!-- end Modals -->
         
          </div>
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



     <!-- //////////////////////////////////////////////////////////////////////////// -->

    <?php $this->load->view('inc/footer'); ?>

    <?php $this->load->view('inc/js'); ?>
   
</body>
</html>