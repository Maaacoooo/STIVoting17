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

            <?php if($positions):
              foreach($positions as $pos): ?>
            <div class="section">
              <h4 class="header"><?=$pos['title']?></h4><!-- /.header -->
              <?php 
                if($pos['candidates']):
                foreach($pos['candidates'] as $can): ?>
                <div class="row">
                  <div class="col s4 m6 l1">
                    <?php if($can['img']): ?>
                          <img src="<?=base_url('uploads/'.$can['img'])?>" alt="" class="circle responsive-img valign materialboxed" data-caption="<?=$can['name']?>">
                        <?php else: ?>
                          <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="circle responsive-img valign ">
                    <?php endif; ?>
                  </div><!-- /.col s4 m6 l1 -->
                  <div class="col l10 s6">
                    <h6 class="strong"><?=$can['name']?> </h6>
                    <span><?=$can['course'] . ' ' . $can['year']?></span>
                    <span class="badge-label <?=$can['color']?>"><?=$can['party']?></span>
                    <div class="progress">
                      <div class="determinate" style="width: <?=round(($can['votes']/$total_passUsed)*100)?>%"></div>   
                    </div>                    
                  </div><!-- /.col l10 s6 -->
                  <div class="col l1 s2">
                    <h3><?=$can['votes']?></h3>
                  </div><!-- /.col l1 s2 -->
                </div><!-- /.row -->
              <?php endforeach;
              endif; ?>
            </div><!-- /.section -->
          <?php endforeach;
          endif; ?>
            

         
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