<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div id="navCollapsed" class="bg-light collapse navbar-collapse-dashboard shadow">
                    <div class="bg-light">
                      <div class="text-center pt-3">
                        <a onclick="goHome()" data-turbolinks="false">
                            <img class="logo" style="width:60px;height:60px" src="/static/img/android-chrome-192x192.png" alt="logo"/>
                            <h1 class="text-primary"><?php echo $this->container['app_name'] ?></h1>
                        </a>
                      </div>
                      <?php if($this->container['user'] !== NULL): ?>
                      <div class="row p-3">
                          <div class="col col-3">
                            <img id="avatar" onclick="selectPic()" class="rounded-circle shadow-sm" width="45px" height="45px"/>
                            <script src="/src/user.js" type="text/javascript" async></script>
                          </div>
                          <div class="col col-9">
                              <div class="ml-1 font-weight-bolder" style="overflow:hidden">
                                  <?php echo $this->container['user']['username'] ?>
                              </div>
                              <div class="ml-1 small">
                                  <?php echo $this->container['user']['role_alias'] ?>
                              </div>
                          </div>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div id="accordionDashboard" class="accordion bg-light">
                    <div class="autoscroll">
                    <a class="dropdown-item text-uppercase font-weight-bold p-3<?php echo $this->uri->segment(1) == 'store' ? ' text-primary active' : ''?>" onclick="navigate('/store')"><i class="material-icons text-primary">&#xe8d1;</i> <?php echo lang('H_STORE') ?></a>
                      <?php foreach($this->container['ei_link'] as $key => $value): ?>
                        <?php if ((int) $value['position'] !== 1): ?>
                            <a class="dropdown-item text-uppercase font-weight-bold p-3<?php echo '/'.$this->uri->uri_string() == '/'.$value['slug'] ? ' text-primary active' : ''?>" onclick="navigate('/<?php echo $value['slug'] ?>')"><i class="material-icons text-primary"><?php echo $value['material_icon'] ?></i> <?php echo $value['title'] ?></a>
                        <?php endif ?>
                      <?php endforeach ?>
                      <?php if($this->container['user'] !== NULL): ?>
                      <div class="dropdown-item text-uppercase font-weight-bold p-3<?php echo $this->uri->segment(2) == 'ui_update_password' || $this->uri->segment(2) == 'manage_token' ? ' active' : ''?>">
                        <div id="heading_profile" data-toggle="collapse" data-target="#collapse_profile" aria-expanded="false" aria-controls="collapse_profile">
                            <i class="material-icons text-primary">&#xe853;</i> <?php echo lang('H_PROFILE') ?>
                            <i class="material-icons float-right" style="margin-top:2px;">&#xe313;</i> 
                        </div>
                        <div id="collapse_profile" class="<?php echo $this->uri->segment(2) == 'ui_update_password' || $this->uri->segment(2) == 'manage_token' ? '' : 'collapse'?>" aria-labelledby="heading_profile" data-parent="#accordionDashboard">
                          <div class="m-1">
                              <ul class="small nav nav-pills flex-column" style="overflow:hidden">
                                  <li class="nav-item">
                                    <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_update_password' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_update_password')"><i class="material-icons text-primary">&#xe62f;</i> <?php echo lang('H_UPDATE_PASSWORD');?></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/manage_token' ? ' text-primary' : ''?>" onclick="navigate('/authentication/manage_token')"><i class="material-icons text-primary">&#xe1b1;</i> <?php echo lang('H_LOG_IN_DEVICES');?></a>
                                  </li>
                              </ul>
                          </div>
                        </div>
                      </div>
                      <?php endif; ?>
                      <?php if($this->container['user'] === NULL): ?>
                        <a class="dropdown-item text-uppercase font-weight-bold p-3<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_login' ? ' text-primary active' : ''?>" onclick="navigate('/authentication/ui_login')"><i class="material-icons text-primary">&#xe879;</i> <?php echo lang('H_LOGIN');?></a>
                        <?php if(APP_REGISTRATION === TRUE): ?>
                        <a class="dropdown-item text-uppercase font-weight-bold p-3<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_register' ? ' text-primary active' : ''?>" onclick="navigate('/authentication/ui_register')"><i class="material-icons text-primary">&#xe7fe;</i> <?php echo lang('H_REGISTER');?></a>
                        <div class="dropdown-item text-uppercase font-weight-bold p-3<?php echo $this->uri->segment(2) == 'ui_activate_account' || $this->uri->segment(2) == 'ui_forgot_password' ? ' active' : ''?>">
                          <div id="heading_help" data-toggle="collapse" data-target="#collapse_help" aria-expanded="false" aria-controls="collapse_help">
                            <i class="material-icons text-primary">&#xe887;</i> <?php echo lang('L_HELP');?>
                            <i class="material-icons float-right" style="margin-top:2px;">&#xe313;</i> 
                          </div>
                          <div id="collapse_help" class="<?php echo $this->uri->segment(2) == 'ui_activate_account' || $this->uri->segment(2) == 'ui_forgot_password' ? '' : 'collapse'?>" aria-labelledby="heading_help" data-parent="#accordionDashboard">
                            <div class="m-1">
                              <ul class="small nav nav-pills flex-column" style="overflow:hidden">
                                  <li class="nav-item">
                                    <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_activate_account' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_activate_account')"><i class="material-icons text-primary">&#xe8e8;</i> <?php echo lang('H_ACTIVATE_ACCOUNT');?></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_forgot_password' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_forgot_password')"><i class="material-icons text-primary">&#xe898;</i> <?php echo lang('H_FORGOT_PASSWORD');?></a>
                                  </li>
                               </ul>
                            </div>
                          </div>
                        </div>
                        <?php endif; ?>
                      <?php endif; ?>
                      <?php if($this->container['user'] !== NULL): ?>
                        <?php if($this->container['user']['role'] <= 1): ?>
                        <a class="dropdown-item text-uppercase font-weight-bold p-3 text-primary font-weight-bold" onclick="navigate('/dashboard')"><i class="material-icons text-primary">&#xe30d;</i> <?php echo lang('H_DASHBOARD');?></a>
                        <?php endif; ?>
                      <?php endif; ?>
                      <div class="dropdown-item text-uppercase font-weight-bold p-3">
                        <div id="headingLang" data-toggle="collapse" data-target="#collapseLang" aria-expanded="false" aria-controls="collapseLang">
                            <i class="material-icons text-primary">&#xe8e2;</i> <?php echo lang('L_LANGUAGE') ?>
                            <i class="material-icons float-right" style="margin-top:2px;">&#xe313;</i> 
                        </div>
                        <div id="collapseLang" class="collapse" aria-labelledby="headingLang" data-parent="#accordionDashboard">
                          <div class="m-1">
                              <ul class="small nav nav-pills flex-column" style="overflow:hidden">
                                  <li class="nav-item">
                                    <a class="nav-link" onclick="change_language('english')" data-turbolinks="false"><?php echo lang('L_ENGLISH_LANG') ?></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" onclick="change_language('malay')" data-turbolinks="false"><?php echo lang('L_MALAY_LANG') ?></a>
                                  </li>
                              </ul>
                          </div>
                        </div>
                      </div>
                      <?php if($this->container['user'] !== NULL): ?>
                        <a class="dropdown-item text-uppercase font-weight-bold p-3" onclick="logout()"data-turbolinks="false"><i class="material-icons text-primary">&#xe879;</i> <?php echo lang('H_LOGOUT');?></a>
                      <?php endif; ?>
                    </div>
                    </div>
                </div>
