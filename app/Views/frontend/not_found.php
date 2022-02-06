<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $setting->site_name . ' - ' . $setting->site_description ?></title>
  <meta content="<?= $setting->site_name ?>" name="keywords">
  <meta content="<?= $setting->site_description ?>" name="description">
    <?= view('frontend/_partials/header') ?>
</head>

<body id="page-top">

  <?= view('frontend/_partials/navbar') ?>

  <div class="intro intro-single route bg-image" style="background-image: url(<?= base_url('img/devfolio/counters-bg.jpg') ?>)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <h2 class="intro-title mb-4">404 Error!</h2>
          <h5 class="text-light mb-4">Requested Page Is Not Found!</h5>
        </div>
      </div>
    </div>
  </div>

  <!--/ Section Contact-Footer Star /-->
  <section class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(<?= base_url('img/devfolio/overlay-bg.jpg') ?>)">
    <div class="overlay-mf"></div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="copyright-box">
              <div class="socials">
                <ul>
                  <li><a href=""><span class="ico-circle"><i class="ion-social-facebook"></i></span></a></li>
                  <li><a href=""><span class="ico-circle"><i class="ion-social-instagram"></i></span></a></li>
                  <li><a href=""><span class="ico-circle"><i class="ion-social-twitter"></i></span></a></li>
                  <li><a href=""><span class="ico-circle"><i class="ion-social-pinterest"></i></span></a></li>
                </ul>
              </div>
              <p class="copyright">&copy; Copyright <strong>DevFolio</strong>. All Rights Reserved</p>
              <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </section>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>
  <?= view('frontend/_partials/script'); ?>

</body>
</html>
