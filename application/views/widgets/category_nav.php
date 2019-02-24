<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<style>
.nav-scroller {
  overflow-y: hidden;
  height: 50px;
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
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: .875rem;
}

.nav-scroller a {
  font-size: 13px;
  text-decoration: none;
}

.nav-scroller a:visited {
  text-decoration: none;
}

.nav-scroller a:hover {
  color: var(--pink) !important;
  font-size: 15px;
  text-decoration: none;
  -webkit-transition: all 500ms ease 100ms;
  transition: all 500ms ease 100ms;
}
</style>
<div class="nav-scroller">
    <nav class="nav mt-2">
    <?php foreach($cat_link as $key => $value): ?>
        <a class="p-2 py-1 text-dark text-uppercase" href="/product?category=<?php echo $value['slug'] ?>">
            <img id="cat_<?php echo $value['id'] ?>" class="rounded-circle logo icon-footer" src="/static/img/favicon-32x32.png" alt="<?php echo $value['name'] ?>"/>
            <?php echo $value['name'] ?>
        </a>
    <?php endforeach ?>
    </nav>
    <script src="/src/category.js" type="text/javascript" async></script>
</div>
