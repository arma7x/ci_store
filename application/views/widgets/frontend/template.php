<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo isset($description) ? $description : '' ?>">
    <meta name="author" content="">
    <meta name="turbolinks-cache-control" content="no-cache">
    <title><?php echo isset($title) ? $title : 'Codeigniter' ?></title>
    <?php echo $this->load->view('widgets/common/header', $this, TRUE) ?>
  </head>
  <body class="p-0">
    <style>
        hr.star-dark,
        hr.star-primary {
          max-width: 15rem;
          padding: 0;
          text-align: center;
          border: none;
          border-top: solid 0.25rem;
          margin-top: 2.5rem;
          margin-bottom: 2.5rem;
          margin-left: auto;
          margin-right: auto;
        }
        hr.star-dark:after,
        hr.star-primary:after {
          position: relative;
          top: -.83em;
          display: inline-block;
          padding: 0 0.25em;
          content: '\e047';
          font-family: "Material Icons";
          font-weight: 900;
          font-size: 1em;
        }
        hr.star-dark {
          border-color: #000;
        }
        hr.star-dark:after {
          color: #000;
          background-color: transparent;
        }
        hr.star-primary {
          border-color: var(--red);
        }
        hr.star-primary:after {
          color: var(--red);
          background-color: transparent;
        }
        .btn-primary {
            background: var(--pink);
            border-color: var(--pink);
        }
        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary:focus {
            background: var(--red)!important;
            border-color: var(--red)!important;
        }
        .no-border:focus{
            outline: none!important;
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
    </style>
    <?php echo $this->load->view('widgets/frontend/nav', $this, TRUE) ?>
    <main id="main" class="col pt-5 pt-lg-0" role="main">
        <?php if($this->container['user'] !== NULL): ?>
        <input id="upload-avatar" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-avatar', null, 100, 100, .50, 'image/webp', uploadAvatar, null)"/>
        <?php endif; ?>
        <div class="mt-0">
        <?php echo $this->load->view('widgets/common/notification', $this, TRUE) ?>
        <?php echo $this->load->view('widgets/frontend/menu', $this, TRUE) ?>
        <?php if ($this->container['sw_offline_cache'] === NULL): ?>
        <?php echo $this->load->view('widgets/frontend/category_nav', $this, TRUE) ?>
        <?php endif ?>
        <div class="p-0 col col-12 col-lg-10 offset-lg-1">
        <?php echo isset($content) ? $content : null ?>
        </div>
        </div>
    </main>
    <?php echo $this->load->view('widgets/common/spinner', $this, TRUE) ?>
    <footer class="footer border-top border-primary">
      <?php echo $this->load->view('widgets/frontend/bottom', $this, TRUE) ?>
      <div class="container text-md-right small text-muted">
        <!--
        <span class="text-dark small"><?php echo str_replace('%s', $this->benchmark->elapsed_time(), lang('L_F_RENDER_ELAPSED')).'|'.$this->benchmark->memory_usage().'|'.strtoupper(ENVIRONMENT) ?></span>
        -->
        <i class="material-icons" style="font-size:1.1em;">&#xe90c;</i> <a onclick="navigate('/authentication/ui_login')"><?php echo date("Y").' '.$this->container['app_name'] ?></a> | Made By <a href="mailto:arma7x@live.com" class="text-primary">arma7x</a>
      </div>
    </footer>
    <?php echo $this->load->view('widgets/common/footer', $this, TRUE) ?>
  </body>
</html>
