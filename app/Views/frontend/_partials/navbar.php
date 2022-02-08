<nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll" href="<?= base_url('#page-top') ?>"><?= $setting->site_name ?></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
      aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll <?= uri_string(true) == '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll <?= uri_string(true) == 'page/about' ? 'active' : '' ?>" href="<?= base_url('page/about') ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll <?= uri_string(true) == 'page/services' ? 'active' : '' ?>" href="<?= base_url('page/services') ?>">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll <?= uri_string(true) == 'page/contact' ? 'active' : '' ?>" href="<?= base_url('page/contact') ?>">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll <?= uri_string(true) == 'blog' ? 'active' : '' ?>" href="<?= base_url('blog') ?>">Blog</a>
        </li>
        <li class="nav-item">
          <?php if (user()){ ?>
          <a class="nav-link js-scroll" href="<?= base_url('backend') ?>">Dashboard</a> 
          <?php } else { ?>
          <a class="nav-link js-scroll" href="<?= base_url('login') ?>">Login</a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>