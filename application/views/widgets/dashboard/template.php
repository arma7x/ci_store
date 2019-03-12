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
    <link href="/static/css/trumbowyg.min.css" type="text/css" rel="stylesheet">
    <script src="/static/js/trumbowyg.min.js"></script>
  </head>
  <body class="p-0">
    <?php echo isset($nav) ? $nav : null ?>
    <main class="col" id="main" role="main">
        <div class="row">
            <div id="dashboard-menu" class="col col-12 col-lg-2 px-0 position-fixed dashboard-menu shadow">
            <?php echo isset($menu) ? $menu : null ?>
            </div>
            <div id="dashboard-container" class="col col-12 col-lg-10 offset-lg-2 dashboard-container">
                <?php echo isset($notification) ? $notification : null ?>
                <?php echo isset($content) ? $content : null ?>
                <style>
                    .trumbowyg-modal {
                        z-index: 9999999!important;
                    }
                </style>
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
                function checkLength(src, placeholder) {
                    $(placeholder).text($(src).val().length)
                }
            </script>
        </div>
    </main>
    <?php echo isset($spinner) ? $spinner : null ?>
    <footer class="footer bg-light border-top border-primary">
      <div class="container text-md-right small text-muted">
        <div class="col col-12 col-lg-10 offset-lg-2">
        <!--
        <span class="text-dark small"><?php echo str_replace('%s', $this->benchmark->elapsed_time(), lang('L_F_RENDER_ELAPSED')).'|'.$this->benchmark->memory_usage().'|'.strtoupper(ENVIRONMENT) ?></span>
        </div>
        -->
        <i class="material-icons" style="font-size:1.1em;">&#xe90c;</i> <?php echo date("Y").' '.$this->container['app_name'] ?> | Made By <a href="mailto:arma7x@live.com" class="text-primary">arma7x</a>
      </div>
    </footer>
    <?php echo isset($footer) ? $footer : null ?>
  </body>
</html>
