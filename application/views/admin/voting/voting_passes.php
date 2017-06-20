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
              </div><!-- ./col s12 -->
            </div><!-- ./row -->

           <div class="row card deep-purple">
              <div class="col s12">       
                <div class="card-content">
                  <span class="card-title">Generate Voting Passes</span>
                  <p class="white-text">Generating voting passes may disrupt the on-going voting event. The system will <span class="red-text strong">DELETE ALL VOTES</span> and existing 
                  <span class="red-text strong">VOTING PASSES</span>, and generate a new set of keys.</p><!-- /.white-text -->
                </div>
                <div class="card-action">
                  <div class="row">
                    <a href="#generateModal" class="modal-trigger btn waves-effect yellow darken-1 deep-purple-text right">Generate <i class="mdi-action-autorenew right"></i></a>
                    <a href="<?=base_url('sys/voting/print_page')?>" target="_blank" class="btn waves-effect cyan white-text right">Print <i class="mdi-action-print right"></i></a> </div><!-- /.row -->                  
                  </div>              
              </div><!-- /.col s12 -->
            </div><!-- /.row card -->           
           </div><!-- ./section -->

           <!-- Modals -->

           <div id="generateModal" class="modal">
              <?=form_open('sys/voting/voting_passes')?>
                <div class="modal-content deep-purple darken-2 white-text">
                    <div class="row">
                      <div class="col s12 m6 l8">
                        <h6 class="strong">Are you sure to Generate New Voting Passes?</h6>
                        <p>The system will <span class="red-text strong">DELETE ALL VOTES</span> and existing <span class="red-text strong">VOTING PASSES</span></p>
                        <p>This action cannot be <span class="strong red-text">UNDONE.</span></p>
                      </div><!-- /.col s12 m6 l8 -->
                      <div class="col s12 m6 l4 card black-text">
                        <p>Please input the number of Voting Passes to be generated. <span class="red-text">Only 5,000 Voting Passes</span> can be generated by this system.
                        Exceeding this limit can be done upon request to the Program Developer.</p>
                        <div class="input-field col s12">
                            <input id="number_pass" name="passes" type="number" max="5000" min="1" required>
                            <label for="number_pass" class="">Number of Passes</label>
                        </div>
                      </div><!-- /.col s12 m6 l4 -->
                    </div><!-- /.row -->
                  </div>
                  <div class="modal-footer deep-purple">
                    <a href="#" class="waves-effect waves-red btn-flat red-text strong modal-action modal-close">Cancel</a>
                    <button type="submit" class="waves-effect waves-green btn green modal-action">Generate</button>
                  </div>
              <?=form_close()?>
            </div>


           <!-- end Modals -->

          <div class="section">
            <div class="row indigo">
              <div class="col s12">
                <h6 class="white-text"><span class="strong">Claimed Passes</span> <span class="right"><?=$total_passUsed?>/<?=$total_passes?></span></h6>
                  <div class="progress">
                    <div class="determinate" style="width: <?=(($total_passUsed / $total_passes)*100)?>%"></div>   
                  </div>
              </div><!-- /.col s12 -->
            </div><!-- /.row -->
          
             <div class="row table-passes">
             <?php if($passes): ?>
             <?php foreach($passes as $row): ?>
              <div class="col l2 m4 s6 <?php if($row['is_used']==1)echo 'red lighten-5 grey-text';?>">
                <h5 class="center-align"><?=$row['key']?></h5>
              </div><!-- /.col s12 -->
              <?php endforeach; ?>
              <?php endif; ?>
             </div><!-- /.row table-passes -->
           </div><!-- /.section -->         
          
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