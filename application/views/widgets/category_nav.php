<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<style>
.nav-scroller {
  overflow-y: hidden;
  height: 40px;
}

.nav-scroller::-webkit-scrollbar {
  width: 5px;
  height: 5px;
}

.nav-scroller::-webkit-scrollbar-track {
  background: var(--light) !important;
}

.nav-scroller::-webkit-scrollbar-thumb {
  background: var(--pink) !important;
}

.nav-scroller::-webkit-scrollbar-thumb:hover {
  background: var(--red) !important;
}

.nav-scroller .nav {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  overflow-x: auto;
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.nav-scroller .nav-link {
  font-size: .875rem;
}

.nav-scroller a {
  font-size: 13px;
  font-weight: 600;
  text-decoration: none;
}

.nav-scroller a:visited {
  text-decoration: none;
}

.nav-scroller a:hover {
  color: var(--pink) !important;
  font-size: 13px;
  text-decoration: none;
  transition: transform 250ms ease-in-out;
}

.nav-scroller a:after {
  display:block;
  content: '';
  border-top: solid 2px #ffffff;
  border-bottom: solid 3px var(--pink);
  transform: scaleX(0);  
  transition: transform 250ms ease-in-out;
}

.nav-scroller a:hover:after {
  transform: scaleX(1);
}

.nav-scroller .active {
  color: var(--pink) !important;
}
</style>
<div class="nav-scroller d-flex justify-content-center mt-3 mx-2">
    <nav class="nav">
    <?php foreach($cat_link as $key => $value): ?>
        <a id="active_<?php echo $value['id'] ?>" class="p-2 py-1 text-muted" href="/store?category=<?php echo $value['id'] ?>">
            <img id="cat_<?php echo $value['id'] ?>" class="rounded-circle logo icon-footer" src="<?php echo $value['icon'] ?>" alt="<?php echo $value['name'] ?>"/>
            <?php echo $value['name'] ?>
        </a>
    <?php endforeach ?>
    </nav>
    <script>
      $(document).ready(function() {
        if (getQueryStringValue('category') != '') {
          $('#active_'+getQueryStringValue('category')).addClass('active')
        }
      })
    </script>
</div>
