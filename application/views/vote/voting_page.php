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

  <!-- Favicons-->
  <link rel="icon" href="<?=base_url('assets/images/favicon/sti_45x45.png')?>" sizes="45x45">

  <link href="<?=base_url('assets/css/page.css')?>" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- CORE CSS-->

  <link href="<?=base_url('assets/css/materialize.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url('assets/css/page-center.css')?>" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?=base_url('assets/css/prism.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="indigo darken-2">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->


    <div class="col s12 m8 l6 z-depth-4 card-panel login-border vote-container">

        <div class="row">
          <div class="input-field col s12 center">
            <img src="<?=base_url('assets/images/sti_header.png')?>" alt="" class="responsive-img valign">
            <p class="center login-form-text"><?=$site_title?></p>
          </div>
        </div>
        <div class="row margin center">  
          <?php
          //SUCCESS ACTION
              $this->form_validation->set_error_delimiters('', '');
               if($this->session->flashdata('success')) { ?>
              <div class="card-panel green">
                 <span class="white-text"><i class="mdi-action-done tiny"></i> <?php echo $this->session->flashdata('success'); ?></span>
              </div>
          <?php } ?>   
            <?php   
             $this->form_validation->set_error_delimiters('', '');          
            if(validation_errors()) { ?>
              <div class="card-panel red">              
                 <span class="white-text"><i class="mdi-alert-warning tiny"></i> <?php echo validation_errors(); ?></span> 
              </div>               
            <?php } ?>  
        </div>      


        
       <?=form_open('vote')?> 

          <?php if($positions):
              foreach($positions as $pos): ?>
            <div class="section card-panel">
              <h4 class="header"><?=$pos['title']?></h4><!-- /.header -->
              <?php 
                if($pos['candidates']):
                foreach($pos['candidates'] as $can): ?>
                <div class="row">
                  <div class="col s3 m6 l2">
                    <?php if($can['img']): ?>
                          <img src="<?=base_url('uploads/'.$can['img'])?>" alt="" class="circle responsive-img valign materialboxed" data-caption="<?=$can['name']?>">
                        <?php else: ?>
                          <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="circle responsive-img valign ">
                    <?php endif; ?>
                  </div><!-- /.col s3 m6 l2 -->
                  <div class="col l8 s6">
                    <h6 class="strong"><?=$can['name']?> </h6>
                    <span><?=$can['course'] . ' ' . $can['year']?></span> <br/>
                    <span class="badge-label <?=$can['color']?>"><?=$can['party']?></span>                               
                  </div><!-- /.col l8 s6 -->
                  <div class="col l2 s3">
                    <input class="with-gap" name="vote[<?=cleancrypt($pos['title'])?>]" type="radio" id="<?=$can['id']?>" value="<?=cleancrypt($can['id'])?>" required>
                    <label for="<?=$can['id']?>">Vote Me!</label>
                  </div><!-- /.col l1 s3 -->
                </div><!-- /.row -->
              <?php endforeach;
              endif; ?>
            </div><!-- /.section -->
          <?php endforeach;
          endif; ?>

        <div class="row valign-wrapper">     
            <button type="submit" class="btn waves-effect green darken-1 col s5 offset-s3">Submit Vote</button>    
            <p class="col s4"><a href="<?=base_url('vote/logout')?>">Submit Later</a></p><!-- /.center -->
        </div>

        <?=form_close()?>

 
      <?php $this->load->view('inc/copy_footer');?>
    </div>


    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="<?=base_url('assets/js/jquery-1.11.2.min.js')?>"></script>
    <!--materialize js-->
    <script type="text/javascript" src="<?=base_url('assets/js/materialize.js')?>"></script>
    <!--prism-->
    <script type="text/javascript" src="<?=base_url('assets/js/prism.js')?>"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?=base_url('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?=base_url('assets/js/plugins.js')?>"></script>

</body>
</html>