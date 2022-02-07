<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $setting->site_name . ' - ' . $setting->site_description ?></title>
  <meta content="<?= isset($article['title']) ? $article['title'] : $setting->site_name ?>" name="keywords">
  <meta content="<?= isset($article['content']) ? substr(strip_tags($article['content']), 0, 100) : $setting->site_description ?>" name="description">
    <?= view('frontend/_partials/header') ?>
</head>

<body id="page-top">

  <?= view('frontend/_partials/navbar') ?>

  <div class="intro intro-single route bg-image" style="background-image: url(<?= base_url('img/devfolio/overlay-bg.jpg') ?>)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <h2 class="intro-title mb-4">Article Blog</h2>
          <ol class="breadcrumb d-flex justify-content-center">
            <li class="breadcrumb-item">
              <a href="<?= base_url() ?>">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= base_url('blog') ?>">News</a>
            </li>
            <li class="breadcrumb-item active">Articles</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="blog-wrapper sect-pt4" id="blog">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <?php 
            if (count($articles) == 0) {
          ?>
            <center class="mt-5">No articles.</center>
          <?php
            } else {
              foreach ($articles as $article) {
          ?>
          <div class="post-box">
            <div class="post-thumb">
              <img src="<?= $article['cover'] ?>" class="img-fluid" alt="">
            </div>
            <div class="post-meta">
              <h1 class="article-title"><?= $article['title'] ?></h1>
              <ul>
                <li>
                  <span class="ion-ios-person"></span>
                  <a href="#"><?= $article['author']['name'] ?></a>
                </li>
                <li>
                  <span class="ion-pricetag"></span>
                  <a href="#"><?= $article['category']['name'] ?></a>
                </li>
                <li>
                  <span class="ion-chatbox"></span>
                  <a href="#"><?= date('d M Y', strtotime($article['created_at'])) ?></a>
                </li>
              </ul>
            </div>
            <div class="article-content">
              <?= $article['content'] ?>
            </div>
          </div>
          <?php 
              }
              echo $articles_pager->links('articles', 'custom_pager');
            }
          ?>
        </div>
        <div class="col-md-4">
          <?= view('frontend/_partials/sidebar') ?>
        </div>
      </div>
    </div>
  </section>

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
