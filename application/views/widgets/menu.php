<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="col col-12 col-lg-10 offset-lg-1 bg-light pt-2 d-none d-lg-block d-xl-block" style="font-size:0.8em!important;">
                    <ul class="list-inline small">
                    <?php foreach($this->container['sc_link'] as $key => $value): ?>
                        <li class="list-inline-item mb-2">
                            <a class="text-primary" target="_blank" href="<?php echo $value['url'] ?>">
                            <img id="top_sc_<?php echo $value['id'] ?>" class="rounded-circle logo icon-footer" src="/static/img/favicon-32x32.png" alt="<?php echo $value['name'] ?>"/>
                            </a>
                        </li>
                    <?php endforeach ?>
                    </ul>
                    <div class="bg-light">
                      <div class="text-center">
                        <a onclick="goHome()" data-turbolinks="false">
                            <img class="logo" style="width:60px;height:60px" src="/static/img/android-chrome-192x192.png" alt="logo"/>
                            <h1 class="text-primary"><?php echo $this->container['app_name'] ?></h1>
                        </a>
                      </div>
                    </div>
                    
                    <div class="d-flex justify-content-center bg-light text-uppercase">
                        <?php if ($this->container['sw_offline_cache'] !== NULL): ?>
                        <a class="p-3 text-danger"><i class="material-icons">&#xe0ce;</i> <?php echo lang('H_Offline') ?></a>
                        <?php endif ?>
                        <?php if ($this->container['sw_offline_cache'] === NULL): ?>
                        <a class="p-3<?php echo $this->uri->segment(1) == 'store' ? ' text-primary active' : ''?>" onclick="navigate('/store')"><i class="material-icons text-primary">&#xe8d1;</i> <?php echo lang('H_STORE') ?></a>
                        <?php endif ?>

                        <?php foreach($this->container['ei_link'] as $key => $value): ?>
                            <?php if ((int) $value['position'] !== 1): ?>
                                <a class="p-3<?php echo '/'.$this->uri->uri_string() == '/'.$value['slug'] ? ' text-primary active' : ''?>" onclick="navigate('/<?php echo $value['slug'] ?>')"><i class="material-icons"><?php echo $value['material_icon'] ?></i> <?php echo $value['title'] ?></a>
                            <?php endif ?>
                        <?php endforeach ?>

                        <?php if($this->container['user'] !== NULL): ?>
                          <div class="nav-item dropdown p-2">
                            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">&#xe853;</i> <?php echo lang('H_PROFILE') ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                              <a class="dropdown-item<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_update_password' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_update_password')"><i class="material-icons">&#xe62f;</i> <?php echo lang('H_UPDATE_PASSWORD');?></a>
                            <a class="dropdown-item<?php echo '/'.$this->uri->uri_string() == '/authentication/manage_token' ? ' text-primary' : ''?>" onclick="navigate('/authentication/manage_token')"><i class="material-icons">&#xe1b1;</i> <?php echo lang('H_LOG_IN_DEVICES');?></a>
                            </div>
                          </div>
                        <?php endif; ?>

                        <?php if($this->container['user'] === NULL): ?>
                            <!--
                            <a class="p-3<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_login' ? ' text-primary active' : ''?>" onclick="navigate('/authentication/ui_login')"><i class="material-icons">&#xe879;</i> <?php echo lang('H_LOGIN');?></a>
                            -->
                            <?php if(APP_REGISTRATION === TRUE): ?>
                                <a class="p-3<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_register' ? ' text-primary active' : ''?>" onclick="navigate('/authentication/ui_register')"><i class="material-icons">&#xe7fe;</i> <?php echo lang('H_REGISTER');?></a>
                                <div class="p-3<?php echo $this->uri->segment(2) == 'ui_activate_account' || $this->uri->segment(2) == 'ui_forgot_password' ? ' active' : ''?>">
                                  <div id="heading_help" data-toggle="collapse" data-target="#collapse_help" aria-expanded="false" aria-controls="collapse_help">
                                    <i class="material-icons">&#xe887;</i> <?php echo lang('L_HELP');?>
                                    <i class="material-icons float-right" style="margin-top:2px;">&#xe313;</i> 
                                  </div>
                                  <div id="collapse_help" class="<?php echo $this->uri->segment(2) == 'ui_activate_account' || $this->uri->segment(2) == 'ui_forgot_password' ? '' : 'collapse'?>" aria-labelledby="heading_help" data-parent="#accordionDashboard">
                                    <div class="m-1">
                                      <ul class="small nav nav-pills flex-column" style="overflow:hidden">
                                          <li class="nav-item">
                                            <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_activate_account' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_activate_account')"><i class="material-icons">&#xe8e8;</i> <?php echo lang('H_ACTIVATE_ACCOUNT');?></a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_forgot_password' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_forgot_password')"><i class="material-icons">&#xe898;</i> <?php echo lang('H_FORGOT_PASSWORD');?></a>
                                          </li>
                                       </ul>
                                    </div>
                                  </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($this->container['user'] !== NULL): ?>
                            <?php if($this->container['user']['role'] <= 1): ?>
                            <a class="p-3 text-primary font-weight-bold" onclick="navigate('/dashboard')"><i class="material-icons">&#xe30d;</i> <?php echo lang('H_DASHBOARD');?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <!--
                        <div class="nav-item dropdown p-2">
                            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">&#xe8e2;</i> <?php echo lang('L_LANGUAGE') ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                              <a class="dropdown-item" onclick="change_language('english')" data-turbolinks="false"><?php echo lang('L_ENGLISH_LANG') ?></a>
                              <a class="dropdown-item" onclick="change_language('malay')" data-turbolinks="false"><?php echo lang('L_MALAY_LANG') ?></a>
                            </div>
                        </div>
                        -->
                        <?php if($this->container['user'] !== NULL): ?>
                            <a class="p-3" onclick="logout()"data-turbolinks="false"><i class="material-icons">&#xe879;</i> <?php echo lang('H_LOGOUT');?></a>
                        <?php endif; ?>
                    </div>
                    <hr class="star-primary" style="margin-top:8px;margin-bottom:25px;">
                </div>
