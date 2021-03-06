<!-- START LEFT SIDEBAR NAV -->
      <aside id="left-sidebar-nav">
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
              <li class="user-details grey lighten-5">
                  <div class="row">
                      <div class="col col s4 m4 l4">
                        <?php
                        //USER PROFILE IMG                          
                          if($user['img'] != NULL)    {
                            echo '<img src="'.base_url('uploads/'.$user['img']).'" alt="" class="circle responsive-img valign profile-image">';
                          } else {
                            echo '<i class="mdi-social-person medium grey lighten-2 circle"></i>';
                          }
                        ?>
                          

                          
                      </div>
                      <div class="col col s8 m8 l8">
                          <ul id="profile-dropdown" class="dropdown-content">                    
                              <li><a href="<?=base_url('sys/settings/profile')?>"><i class="mdi-action-settings"></i>Profile</a>
                              </li>                              
                              <li class="divider"></li>                              
                              <li><a href="<?=base_url('sys/dashboard/logout')?>"><i class="mdi-hardware-keyboard-tab"></i>Logout</a>
                              </li>
                          </ul>
                          <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?=$user['name']?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                          <p class="user-roal"><?=$user['usertype']?></p>
                      </div>
                  </div>
              </li>
              <li class="bold"><a href="<?=base_url('sys/dashboard')?>" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a></li>             
              <?php if($user['usertype'] == 'Administrator'): ?>     
              <li class="li-hover"><div class="divider"></div></li>
              <li class="li-hover"><p class="ultra-small margin more-text">ADMIN OPTIONS</p></li>       
              <li class="bold"><a href="<?=base_url('sys/users/')?>" class="waves-effect waves-cyan"><i class="mdi-action-account-child"></i> System Users</a></li>       
              <?php endif; ?> 

              <li class="li-hover"><div class="divider"></div></li>
              <li class="li-hover"><p class="ultra-small margin more-text">VOTING SYSTEM OPTIONS</p></li>
              <li class="bold"><a href="<?=base_url('sys/candidates/')?>" class="waves-effect waves-cyan"><i class="mdi-social-school"></i> Candidates</a></li>       
              <li class="bold"><a href="<?=base_url('sys/voting/voting_passes/')?>" class="waves-effect waves-cyan"><i class="mdi-communication-vpn-key"></i> Voting Passes</a></li> 
              <li class="bold"><a href="<?=base_url('sys/voting/results/')?>" class="waves-effect waves-cyan"><i class="mdi-editor-insert-chart"></i> Voting Results</a></li> 
              <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-settings"></i> Voting Settings</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="<?=base_url('sys/voting/pages')?>">Pages</a></li>                                       
                                  <li><a href="<?=base_url('sys/voting/settings')?>">System Settings</a></li>                  
                              </ul>
                          </div>
                      </li>
                    </ul>
              </li> 
          </ul>         
          <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only grey darken-4"><i class="mdi-navigation-menu" ></i></a>
      </aside> 
      <!-- END LEFT SIDEBAR NAV-->


     