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
                    <li><a href="#">Voting System</a></li>         
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
            
          <div class="section">
             <div class="row">
               <div class="col s12 l7">
                 <table class="striped bordered highlight">
                  <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Position &middot; Party</th>
                        <th>Course &middot; Year</th>
                    </tr>
                  </thead>

                  <tbody>                    
                    <?php if($results):
                      foreach($results as $row): ?>
                    <tr>
                      <td>
                        <a href="<?=base_url('sys/candidates/update/' . $row['id'])?>">
                        <?php if($row['img']): ?>
                          <img src="<?=base_url('uploads/'.$row['img'])?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php else: ?>
                          <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php endif; ?>
                        </a>
                      </td>
                      <td><a href="<?=base_url('sys/candidates/update/' . $row['id'])?>"><?=$row['name']?></a></td>
                      <td><?=$row['position']?> <span class="badge-label pink"><?=$row['party']?></span></td>
                      <td><?=$row['course'] . ' ' . $row['year'] ?></td>
                    </tr> 
                    <?php endforeach; 
                      endif; ?>            
                  </tbody>
                </table>
                <div class="right">
                    <?php foreach ($links as $link) { echo $link; } ?>
                </div>
               </div><!-- /.col s12 l7 -->
               <div class="col s12 l5">                
                 <div class="card-panel">
                   <div class="card-content">
                     <h6 class="strong">Register Candidate</h6><!-- /.strong -->
                     <?=form_open_multipart('sys/candidates')?>
                       <div class="row">
                         <div class="input-field col s12 l9">
                            <input id="name" name="name" type="text" class="validate" required>
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
                         <div class="input-field col s6">                        
                            <div class="select-wrapper">  
                              <select class="browser-default" name="year" required>
                                  <option value="" disabled="" selected="">Select Year</option>
                                  <?php 
                                    if($years):
                                    foreach($years as $year):
                                  ?>
                                  <option value="<?=$year['title']?>"><?=$year['title']?></option>
                                  <?php
                                    endforeach;
                                    endif;
                                  ?>
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Year Level</label>
                          </div><!-- /.input-field col s6 -->
                         <div class="input-field col s6">
                           <div class="select-wrapper">  
                              <select class="browser-default" name="course" required>
                                  <option value="" disabled="" selected="">Select Course</option>
                                  <?php 
                                    if($courses):
                                    foreach($courses as $course):
                                  ?>
                                  <option value="<?=$course['title']?>"><?=$course['title']?></option>
                                  <?php
                                    endforeach;
                                    endif;
                                  ?>
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Course</label>
                         </div><!-- /.input-field col s6 -->
                       </div><!-- /.row -->
                       <div class="row">
                         <div class="input-field col s6">
                           <div class="select-wrapper">  
                              <select class="browser-default" name="position" required>
                                  <option value="" disabled="" selected="">Position Desired</option>
                                  <?php 
                                    if($positions):
                                    foreach($positions as $position):
                                  ?>
                                  <option value="<?=$position['title']?>"><?=$position['title']?></option>
                                  <?php
                                    endforeach;
                                    endif;
                                  ?>
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Position</label>
                         </div><!-- /.input-field col s6 -->
                         <div class="input-field col s6">
                           <div class="select-wrapper">  
                              <select class="browser-default" name="party" required>
                                  <option value="" disabled="" selected="">Party Desired</option>
                                  <?php 
                                    if($party):
                                    foreach($party as $par):
                                  ?>
                                  <option value="<?=$par['title']?>"><?=$par['title']?></option>
                                  <?php
                                    endforeach;
                                    endif;
                                  ?>
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Partylist</label>
                         </div><!-- /.input-field col s6 -->
                       </div><!-- /.row -->
                       <div class="row">
                          <div class="input-field col s12">
                                  <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                    <i class="mdi-content-send right"></i>
                                  </button>
                                </div>
                       </div><!-- /.row -->
                     <?=form_close()?>
                   </div><!-- /.card-content -->
                 </div><!-- /.card-panel -->
               </div><!-- /.col s12 l5 -->
             </div><!-- /.row -->
           </div><!-- /.section --> 
         
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