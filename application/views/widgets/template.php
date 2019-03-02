<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo isset($description) ? $description : '' ?>">
    <meta name="author" content="">
    <meta name="turbolinks-cache-control" content="no-cache">
    <title><?php echo isset($title) ? $title : 'Codeigniter' ?></title>
    <?php echo isset($header) ? $header : null ?>
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
  </head>
  <body class="p-0">
    <?php echo isset($nav) ? $nav : null ?>
    <main class="col bg-light" id="main" role="main">
        <?php if($this->container['user'] !== NULL): ?>
        <input id="upload-avatar" class="sr-only" type="file" accept="image/*" onChange="resizePicture('upload-avatar', null, 100, 100, .50, 'image/webp', uploadAvatar, null)"/>
        <?php endif; ?>
        <div class="row">
            <div id="dashboard-menu" class="col col-12 col-lg-2 px-0 position-fixed dashboard-menu shadow-rm">
            <?php echo isset($menu) ? $menu : null ?>
            </div>
            <div id="dashboard-container" class="col col-12 col-lg-10 offset-lg-2 dashboard-container pt-5 pt-lg-0">
                <?php echo isset($notification) ? $notification : null ?>
                <?php echo isset($category_nav) ? $category_nav : null ?>
                <?php echo isset($content) ? $content : null ?>
            </div>
            <script>
                $("#navbar-toggler").click(function() {
                    if ($("#navCollapsed").hasClass('show')) {
                        $("#dashboard-container").css('opacity', '1');
                        $("#dashboard-container").off('touchmove wheel click');
                    } else {
                        $("#dashboard-container").css('opacity', '0.5');
                        $("#dashboard-container").on('touchmove wheel click', function(e) {
                            e.preventDefault();
                        }, false);
                    }
                })
            </script>
        </div>
    </main>
    <?php echo isset($spinner) ? $spinner : null ?>
    <footer class="footer bg-light border-top border-primary">
      <?php echo isset($bottom) ? $bottom : null ?>
      <div class="container text-md-right">
        <span class="text-dark small"><?php echo str_replace('%s', $this->benchmark->elapsed_time(), lang('L_F_RENDER_ELAPSED')).'|'.$this->benchmark->memory_usage().'|'.strtoupper(ENVIRONMENT) ?></span>
      </div>
    </footer>
    <?php echo isset($footer) ? $footer : null ?>
  </body>
</html>

