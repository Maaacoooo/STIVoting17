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
                        <?php if(filexist($row['img']) && $row['img']): ?>
                          <img src="<?=base_url('uploads/'.$row['img'])?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php else: ?>
                          <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php endif; ?>
                        </a>
                      </td>
                      <td><a href="<?=base_url('sys/candidates/update/' . $row['id'])?>"><?=$row['name']?></a></td>
                      <td><?=$row['position']?> <span class="badge-label <?=$row['color']?>"><?=$row['party']?></span></td>
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

                       <input type="hidden" name="key" value="<?=$this->encryption->encrypt('candidate')?>" />
                     <?=form_close()?>
                   </div><!-- /.card-content -->
                 </div><!-- /.card-panel -->


                 <div class="card-panel">
                   <div class="card-content">
                     <h6 class="strong">
                       Partylists
                     </h6><!-- /.strong -->
                     <?=form_open('sys/candidates')?>
                     <div class="row">
                       <div class="col s5 input-field">
                         <input type="text" name="title" id="title" class="validate" placeholder="Create New Partylist..." required />
                         <label for="title">New Partylist</label>                      
                       </div><!-- /.col s5 input-field -->
                       <div class="input-field col s4">
                           <div class="select-wrapper">  
                              <select name="color" class="browser-default" required>
                                  <option value="" disabled="" selected="">Desired Color...</option>                              
                                  <option value="pink">Pink</option>                                  
                                  <option value="red">Red</option>                                  
                                  <option value="green">Green</option>                                  
                                  <option value="blue">Blue</option>                                  
                                  <option value="black">Black</option>                                  
                                  <option value="orange">Orange</option>                                  
                                  <option value="amber">Amber</option>                                  
                                  <option value="purple">Purple</option>                                  
                                  <option value="cyan">Cyan</option>                                  
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Color</label>
                         </div><!-- /.input-field col s4 --> 
                         <div class="input-field col s3">
                           <button class="btn cyan waves-effect waves-light right" type="submit" name="action">SAVE
                                <i class="mdi-content-send right"></i>
                           </button>
                         </div><!-- /.input-field col s3 -->             
                     </div><!-- /.row -->
                       <input type="hidden" name="key" value="<?=$this->encryption->encrypt('partylist')?>" />                     
                     <?=form_close()?>
                     <div class="divider"></div><!-- /.divider -->

                     <table class="bordered striped">
                       <tbody>
                         <?php if($party):
                         foreach ($party as $par): ?>
                         <tr>
                           <td>
                              <a href="#"><?=$par['title']?></a> 
                              <span class="badge-label <?=$par['color']?>"><?=strtoupper($par['color'])?></span>
                            </td> 
                            <td>
                              <a href="#Update<?=safelink($par['title'])?>" class="modal-trigger amber-text">[<i class="mdi-editor-mode-edit tiny"></i>]</a>
                              <a href="#Delete<?=safelink($par['title'])?>" class="modal-trigger red-text">[<i class="mdi-action-delete tiny"></i>]</a>
                            </td>                         
                         </tr>
                         <?php endforeach;
                         endif; ?>
                       </tbody>
                     </table><!-- /.bordered striped -->
                   </div><!-- /.card-content -->
                 </div><!-- /.card-panel -->

                 <!-- Modals -->
                 <?php if($party):
                  foreach ($party as $par): ?>
                 <div id="Delete<?=safelink($par['title'])?>" class="modal">
                    <?=form_open('sys/candidates/delete_party')?>
                      <div class="modal-content red darken-4 white-text">
                          <p>Are you sure to delete the partylist <span class="strong"><?=$par['title']?></span>?</p>
                          <p>Deleting this party will <span class="strong">DELETE ALL Candidates</span> within this party.</p>
                          <p>You <span class="strong">CANNOT UNDO</span> this action.</p>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($par['title'])?>" />
                        </div>
                        <div class="modal-footer grey darken-4">
                          <a href="#" class="waves-effect waves-red btn-flat amber-text strong modal-action modal-close">Cancel</a>
                          <button type="submit" class="waves-effect waves-red btn red modal-action">Delete</button>
                        </div>
                    <?=form_close()?>
                  </div>

                  <div id="Update<?=safelink($par['title'])?>" class="modal">
                    <?=form_open('sys/candidates/update_party')?>
                      <div class="modal-content grey darken-4 white-text">
                          <p>Please update the party accordingly.</p>
                          <div class="row">
                            <div class="input-field col s8">
                              <input type="text" name="title" id="" class="validate" value="<?=$par['title']?>" />
                              <label for="">Partylist</label>
                            </div><!-- /.input-field col s8 -->
                            <div class="input-field col s4">
                               <div class="select-wrapper">  
                                  <select name="color" class="browser-default black-text" required>
                                      <option value="pink" <?php if($par['color'] == 'pink')echo'selected';?>>Pink</option>                                  
                                      <option value="red" <?php if($par['color'] == 'red')echo'selected';?>>Red</option>                                  
                                      <option value="green" <?php if($par['color'] == 'green')echo'selected';?>>Green</option>                                  
                                      <option value="blue" <?php if($par['color'] == 'blue')echo'selected';?>>Blue</option>                                  
                                      <option value="black" <?php if($par['color'] == 'black')echo'selected';?>>Black</option>                                  
                                      <option value="orange" <?php if($par['color'] == 'orange')echo'selected';?>>Orange</option>                                  
                                      <option value="amber" <?php if($par['color'] == 'amber')echo'selected';?>>Amber</option>                                  
                                      <option value="purple" <?php if($par['color'] == 'purple')echo'selected';?>>Purple</option>                                  
                                      <option value="cyan" <?php if($par['color'] == 'cyan')echo'selected';?>>Cyan</option>                                  
                                  </select>
                                </div><!-- /.select-wrapper -->
                                <label>Color</label>
                             </div><!-- /.input-field col s6 --> 
                          </div><!-- /.row -->
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($par['title'])?>" />
                        </div>
                        <div class="modal-footer black">
                          <a href="#" class="waves-effect waves-amber btn-flat red-text strong modal-action modal-close">Cancel</a>
                          <button type="submit" class="waves-effect waves-amber btn amber modal-action">Update</button>
                        </div>
                    <?=form_close()?>
                  </div>
                  <?php endforeach;
                   endif; ?>

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