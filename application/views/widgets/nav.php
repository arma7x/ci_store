<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-header-rm d-lg d-xl d-flex justify-content-between font-weight-bold">
      <button class="navbar-toggler"data-toggle="modal" data-target="#ic-modal" data-placement="top" title="<?php echo lang('H_G_INBOX_CHANNEL') ;?>" style="border:0;">
        <i class="material-icons text-dark" style="font-size:1.4em;">&#xe311;</i>
      </button>
      <?php if ($this->uri->segment(1) != NULL): ?>
      <!--
      <button onclick="goHome()" class="navbar-toggler" type="button" style="border:0;padding-left:5px;padding-right:5px;">
        <i class="material-icons text-dark" style="font-size:1.5em;">home</i>
      </button>
      -->
      <button onclick="goBack()" class="navbar-toggler" type="button" style="border:0;padding-left:5px;padding-right:5px;">
        <i class="material-icons text-dark" style="font-size:1.5em;">arrow_back</i>
      </button>
      <?php endif; ?>
      <a onclick="goHome()" class="navbar-brand" data-turbolinks="false">
        <strong class="text-primary"><?php echo $this->container['app_name'] ?></strong>
        <img class="logo" src="/static/img/android-chrome-192x192.png" alt="logo"/>
      </a>
      <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapsed" aria-controls="navCollapsed" aria-expanded="false" aria-label="Toggle navigation" style="border:0;">
        <i id="navmenu_icon" class="material-icons text-dark" style="font-size:1.4em;">menu</i>
      </button>
      <div class="collapse navbar-collapse" id="navCollapsed">
        <ul class="navbar-nav ml-auto">
          <?php if ($this->uri->segment(1) != NULL): ?>
          <!--
          <li class="nav-item">
            <a onclick="goHome()" class="nav-link d-none d-md-block" data-turbolinks="false"><i class="material-icons">home</i> <?php echo lang('H_HOMEPAGE');?></a>
          </li>
          -->
          <li class="nav-item">
            <a onclick="goBack()" class="nav-link d-none d-md-block" data-turbolinks="false"><i class="material-icons">arrow_back</i> <?php echo lang('H_BACK');?></a>
          </li>
          <?php endif; ?>
          <?php if ($this->container['sw_offline_cache'] !== NULL): ?>
          <li class="nav-item">
              <a class="nav-link text-danger"><i class="material-icons">&#xe0ce;</i> <?php echo lang('H_Offline') ?></a>
          </li>
          <?php endif ?>
          <?php if($this->container['sw_offline_cache'] === NULL): ?>
          <!--
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">&#xe8e2;</i> <?php echo lang('L_LANGUAGE') ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" onclick="change_language('english')" data-turbolinks="false"><?php echo lang('L_ENGLISH_LANG') ?></a>
              <a class="dropdown-item" onclick="change_language('malay')" data-turbolinks="false"><?php echo lang('L_MALAY_LANG') ?></a>
            </div>
          </li>
          -->
          <li class="nav-item<?php echo $this->uri->segment(1) == 'store' ? ' active' : ''?>">
            <a class="nav-link<?php echo $this->uri->segment(1) == 'store' ? ' text-primary' : ''?>" onclick="navigate('/store')"><i class="material-icons text-primary">&#xe8d1;</i> <?php echo lang('H_STORE') ?></a>
          </li>
          <?php endif ?>
          <?php foreach($this->container['ei_link'] as $key => $value): ?>
            <?php if ((int) $value['position'] !== 1): ?>
            <li class="nav-item<?php echo '/'.$this->uri->uri_string() == '/'.$value['slug'] ? ' active' : ''?>">
                <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/'.$value['slug'] ? ' text-primary' : ''?>" onclick="navigate('/<?php echo $value['slug'] ?>')"><i class="material-icons"><?php echo $value['material_icon'] ?></i> <?php echo $value['title'] ?></a>
            </li>
            <?php endif ?>
          <?php endforeach ?>
          <?php if($this->container['user'] === NULL): ?>
          <?php if(APP_REGISTRATION === TRUE && $this->container['sw_offline_cache'] === NULL): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">&#xe887;</i> <?php echo lang('L_HELP');?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_activate_account' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_activate_account')"><i class="material-icons">&#xe8e8;</i> <?php echo lang('H_ACTIVATE_ACCOUNT');?></a>
                <a class="dropdown-item<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_forgot_password' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_forgot_password')"><i class="material-icons">&#xe898;</i> <?php echo lang('H_FORGOT_PASSWORD');?></a>
            </div>
          </li>
          <?php endif; ?>
          <?php if($this->container['sw_offline_cache'] === NULL): ?>
          <li class="nav-item<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_login' ? ' active' : ''?>">
            <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_login' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_login')"><i class="material-icons">&#xe879;</i> <?php echo lang('H_LOGIN');?></a>
          </li>
          <?php endif; ?>
          <?php if(APP_REGISTRATION === TRUE && $this->container['sw_offline_cache'] === NULL): ?>
          <li class="nav-item<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_register' ? ' active' : ''?>">
            <a class="nav-link<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_register' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_register')"><i class="material-icons">&#xe7fe;</i> <?php echo lang('H_REGISTER');?></a>
          </li>
          <?php endif; ?>
          <?php endif; ?>
          <?php if($this->container['user'] !== NULL): ?>
          <li class="nav-item" onclick="selectPic()">
            <a id="avatar_pic" class="nav-link" data-turbolinks="false">
              <i class="material-icons">&#xe1bc;</i>
              <?php echo 'Hi, '.$this->container['user']['username']?>
              <img id="avatar" class="rounded-circle avatar"/>
              <script src="/src/user.js" type="text/javascript" async></script>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">&#xe853;</i> <?php echo lang('H_PROFILE') ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item<?php echo '/'.$this->uri->uri_string() == '/authentication/ui_update_password' ? ' text-primary' : ''?>" onclick="navigate('/authentication/ui_update_password')"><i class="material-icons">&#xe62f;</i> <?php echo lang('H_UPDATE_PASSWORD');?></a>
            <a class="dropdown-item<?php echo '/'.$this->uri->uri_string() == '/authentication/manage_token' ? ' text-primary' : ''?>" onclick="navigate('/authentication/manage_token')"><i class="material-icons">&#xe1b1;</i> <?php echo lang('H_LOG_IN_DEVICES');?></a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link text-primary font-weight-bold" onclick="navigate('/dashboard')"><i class="material-icons">&#xe30d;</i> <?php echo lang('H_DASHBOARD');?></a>
          </li>
          <li class="nav-item">
            <a onclick="logout()" class="nav-link" data-turbolinks="false"><i class="material-icons">&#xe879;</i> <?php echo lang('H_LOGOUT');?></a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
