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

  <div id="home" class="intro route bg-image" style="background-image: url(<?= base_url('img/devfolio/intro-bg.jpg') ?>)">
    <div class="overlay-itro"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <h1 class="intro-title mb-4">Welcome</h1>
          <p class="intro-subtitle"><span class="text-slider-items">Technology,Web Design,Web Developer,Automation</span><strong class="text-slider"></strong></p>
        </div>
      </div>
    </div>
  </div>

  <section id="service" class="services-mf route sect-pt4">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Services
            </h3>
            <p class="subtitle-a">
              We can help you to solve your problem in Technology!
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-ico">
              <span class="ico-circle"><i class="ion-monitor"></i></span>
            </div>
            <div class="service-content">
              <h2 class="s-title">Web Design</h2>
              <p class="s-description text-center">
                Build a stunning UI/UX for your users with no time.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-ico">
              <span class="ico-circle"><i class="ion-code-working"></i></span>
            </div>
            <div class="service-content">
              <h2 class="s-title">Web Development</h2>
              <p class="s-description text-center">
                We provide web development with PHP, JavaScript, Go, C# and Python.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-ico">
              <span class="ico-circle"><i class="ion-camera"></i></span>
            </div>
            <div class="service-content">
              <h2 class="s-title">Photography</h2>
              <p class="s-description text-center">
                Capture your beautiful moment with our professional photographer.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-ico">
              <span class="ico-circle"><i class="ion-android-phone-portrait"></i></span>
            </div>
            <div class="service-content">
              <h2 class="s-title">Responsive Design</h2>
              <p class="s-description text-center">
                Serve your services through various devices, even mobile screen.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-ico">
              <span class="ico-circle"><i class="ion-paintbrush"></i></span>
            </div>
            <div class="service-content">
              <h2 class="s-title">Automation</h2>
              <p class="s-description text-center">
                Automate anything that you want, e.g. server logs extraction for monitoring.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-ico">
              <span class="ico-circle"><i class="ion-stats-bars"></i></span>
            </div>
            <div class="service-content">
              <h2 class="s-title">Marketing Services</h2>
              <p class="s-description text-center">
                We can help your business go to market.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="section-counter paralax-mf bg-image" style="background-image: url(<?= base_url('img/devfolio/counters-bg.jpg') ?>)">
    <div class="overlay-mf"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-checkmark-round"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">450</p>
              <span class="counter-text">WORKS COMPLETED</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ios-calendar-outline"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">15</p>
              <span class="counter-text">YEARS OF EXPERIENCE</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ios-people"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">550</p>
              <span class="counter-text">TOTAL CLIENTS</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ribbon-a"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">36</p>
              <span class="counter-text">AWARD WON</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section id="work" class="portfolio-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Portfolio
            </h3>
            <p class="subtitle-a">
              Here are our latest portfolios.
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
          foreach ($portfolios as $portfolio) {    
        ?>
        <div class="col-md-4">
          <div class="work-box">
            <a href="<?= $portfolio['slug'] ?>">
              <div class="work-img">
                <img src="<?= $portfolio['cover'] ?>" alt="" class="img-fluid" width="100%">
              </div>
              <div class="work-content">
                <div class="row">
                  <div class="col-sm-8">
                    <h2 class="w-title"><?= $portfolio['title'] ?></h2>
                    <div class="w-more">
                      <span class="w-date"><?= date('d M Y', strtotime($portfolio['date'])) ?></span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="w-like">
                      <span class="ion-ios-star-outline"></span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> 
        <?php } ?>       
      </div>
    </div>
  </section>

  <div class="testimonials paralax-mf bg-image" style="background-image: url(<?= base_url('img/devfolio/overlay-bg.jpg') ?>)">
    <div class="overlay-mf"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="testimonial-mf" class="owl-carousel owl-theme">
            <div class="testimonial-box">
              <div class="author-test">
                <img src="<?= base_url('img/devfolio/testimonial-2.jpg') ?>" alt="" class="rounded-circle b-shadow-a">
                <span class="author">Arif Purnomo Aji</span>
              </div>
              <div class="content-test">
                <p class="description lead">
                  Amazing services! Our customers are happy.
                </p>
                <span class="comit"><i class="fa fa-quote-right"></i></span>
              </div>
            </div>
            <div class="testimonial-box">
              <div class="author-test">
                <img src="<?= base_url('img/devfolio/testimonial-4.jpg') ?>" alt="" class="rounded-circle b-shadow-a">
                <span class="author">Marta Socrate</span>
              </div>
              <div class="content-test">
                <p class="description lead">
                  Our server is now going faster after some optimization and automation.
                </p>
                <span class="comit"><i class="fa fa-quote-right"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section id="blog" class="blog-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Articles
            </h3>
            <p class="subtitle-a">
              New Articles
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
          foreach ($articles as $article){
        ?>
        <div class="col-md-4">
          <div class="card card-blog">
            <div class="card-img">
              <a href="<?= $article['slug'] ?>"><img src="<?= $article['cover'] ?>" alt="" class="img-fluid" width="100%"></a>
            </div>
            <div class="card-body">
              <div class="card-category-box">
                <div class="card-category">
                  <a href="<?= $article['category']['slug'] ?>">
                    <h6 class="category"><?= $article['category']['name'] ?></h6>
                  </a>
                </div>
              </div>
              <h3 class="card-title"><a href="<?= $article['slug'] ?>"><?= $article['title'] ?></a></h3>
            </div>
            <div class="card-footer">
              <div class="post-author">
                <a href="#">
                  <img src="<?= base_url('img/devfolio/testimonial-2.jpg') ?>" alt="" class="avatar rounded-circle">
                  <span class="author"><?= $article['author']['name'] ?></span>
                </a>
              </div>
              <div class="post-date">
                <span class="ion-ios-clock-outline"></span> <?= date('d M Y', strtotime($article['created_at'])) ?>
              </div>
            </div>
          </div>
        </div>
      <?php
        }
      ?>
      </div>
    </div>
  </section>

  <section class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(<?= base_url('img/devfolio/overlay-bg.jpg') ?>)">
    <div class="overlay-mf"></div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="copyright-box">
              <div class="socials">
                <ul>
                  <li><a target="<?= $setting->facebook_link == '' | $setting->facebook_link == '#' ? '_self' : '_blank' ?>" href="<?= $setting->facebook_link ?>"><span class="ico-circle"><i class="ion-social-facebook"></i></span></a></li>
                  <li><a target="<?= $setting->instagram_link == '' | $setting->instagram_link == '#' ? '_self' : '_blank' ?>" href="<?= $setting->instagram_link ?>"><span class="ico-circle"><i class="ion-social-instagram"></i></span></a></li>
                  <li><a target="<?= $setting->twitter_link == '' | $setting->twitter_link == '#' ? '_self' : '_blank' ?>" href="<?= $setting->twitter_link ?>"><span class="ico-circle"><i class="ion-social-twitter"></i></span></a></li>
                  <li><a target="<?= $setting->github_link == '' | $setting->github_link == '#' ? '_self' : '_blank' ?>" href="<?= $setting->github_link ?>"><span class="ico-circle"><i class="ion-social-github"></i></span></a></li>
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
