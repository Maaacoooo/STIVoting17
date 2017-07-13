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
          </div>           

          <div class="section">                  
            <div class="row">              
              <div class="col s12 l8">
                <div class="card">
                  <div class="card-content">
                    <h4 class="header">Basic Settings</h4><!-- /.header -->
                    <?=form_open('sys/voting/update_basic_setting')?>
                    <table>
                      <tr>
                        <td>
                          <!-- Switch -->
                          <div class="switch">
                            Publish Vote Results: 
                            <label>
                              Unpublished
                              <input type="checkbox" name="vote_results" value="1" <?php if($vote_results['value']==1)echo'checked';?> onclick="form.submit()">
                              <span class="lever"></span> 
                              Published
                            </label>       
                          </div>  
                        </td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>
                          <!-- Switch -->
                          <div class="switch">
                            Voting System Status : 
                            <label>
                              Off
                              <input type="checkbox" name="vote_status" value="1" <?php if($vote_status['value']==1)echo'checked';?> onclick="form.submit()">
                              <span class="lever"></span> 
                              On
                            </label>
                          </div>  
                        </td>
                        <td></td>
                      </tr>
                    </table>           
                    <?=form_close()?>
                    <h4 class="header">Advanced Settings</h4><!-- /.header -->
                    <div class="row">
                      <div class="col s5">
                        <p>This only clears the votes, without removing the candidates</p>
                      </div><!-- /.col s5 -->
                      <div class="col s7">
                        <a href="#clearVote" class="btn waves-effect waves-light amber modal-trigger"><i class="mdi-action-delete left"></i> Clear Votes</a>
                      </div><!-- /.col s7 -->
                    </div><!-- /.row -->
                    <br />
                    <div class="row">
                      <div class="col s5">
                        <p>Resets everything in the Voting System</p>
                      </div><!-- /.col s5 -->
                      <div class="col s7">
                        <a href="#resetDefault" class="btn waves-effect waves-light red modal-trigger"><i class="mdi-notification-sync-problem left"></i> Reset to Default Settings</a>
                      </div><!-- /.col s7 -->
                    </div><!-- /.row -->
                  </div><!-- /.card-content -->
                </div><!-- /.card -->
              </div><!-- /.col s12 l8 -->           
            </div><!-- /.row -->                   
          </div><!-- /.section -->

          <!-- Modals -->

          <div id="clearVote" class="modal">       
            <?=form_open('sys/voting/settings')?>  
            <div class="modal-content grey darken-3 white-text">
              <h5 class="center">Are you sure to <strong class="amber-text">Clear All Votes?</strong></h5>
              <p class="center"> 
                  This will <strong class="red-text">DELETE ALL VOTES</strong> and <strong class="red-text">VOTING PASSES</strong> and may compromise your on-going Voting event.               
              </p><!-- /.center -->
              <p class="center red-text strong">THIS ACTION CANNOT BE UNDONE.</p><!-- /.center red-text strong -->
              <p class="center">Please input your password to continue.</p><!-- /.center -->
              <div class="row">
                <div class="input-field col s12 l4 offset-l4">
                  <i class="mdi-action-lock-outline prefix"></i>
                  <input id="password" type="password" name="password" class="validate" required>
                  <label for="password" class="">Password</label>
                  <input type="hidden" name="master" value="<?=$this->encryption->encrypt('clearvote')?>" />
                </div>
              </div><!-- /.row -->
            </div>
            <div class="modal-footer amber">
              <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Disagree</a>
              <button type="submit" class="waves-effect waves-green btn-flat modal-action red">Agree</button>
            </div>
            <?=form_close()?>
          </div>

          <div id="resetDefault" class="modal">      
            <?=form_open('sys/voting/settings')?>    
            <div class="modal-content grey darken-3 white-text">
              <h5 class="center">Are you sure to <strong class="red-text">Reset to Default?</strong></h5>
              <p class="center"> 
                  Resetting the Voting System to default will <strong class="red-text">DELETE ALL VOTES</strong>, <strong class="red-text">VOTING PASSES</strong>, <strong class="red-text">CANDIDATES</strong>, <strong class="red-text">POSITIONS</strong>, <strong class="red-text">YEARS</strong>, <strong class="red-text">COURSES</strong> and , <strong class="amber-text">REPLACES the PAGES with its Defaults</strong>. This may compromise your on-going Voting event, and only suitable for re-voting purposes.               
              </p><!-- /.center -->
              <p class="center red-text strong">THIS ACTION CANNOT BE UNDONE.</p><!-- /.center red-text strong -->             
              <p class="center">Please input your password to continue.</p><!-- /.center -->
              <div class="row">
                <div class="input-field col s12 l4 offset-l4">
                  <i class="mdi-action-lock-outline prefix"></i>
                  <input id="password" type="password" name="password" class="validate">
                  <label for="password" class="">Password</label>
                  <input type="hidden" name="master" value="<?=$this->encryption->encrypt('reset')?>" />                  
                </div>
              </div><!-- /.row -->
            </div>
            <div class="modal-footer grey darken-4 white-text">
              <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close amber-text">Disagree</a>
              <button type="submit" class="waves-effect waves-green btn-flat modal-action red">Agree</button>
            </div>
            <?=form_close()?>
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