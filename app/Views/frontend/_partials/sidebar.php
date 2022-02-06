<div class="widget-sidebar sidebar-search">
  <h5 class="sidebar-title">Search</h5>
  <div class="sidebar-content">
    <?= form_open(base_url('search')) ?>
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search for..." aria-label="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-secondary btn-search" type="button">
            <span class="ion-android-search"></span>
          </button>
        </span>
      </div>
    <?= form_close() ?>
  </div>
</div>
<div class="widget-sidebar">
  <h5 class="sidebar-title">Random Post For You</h5>
  <div class="sidebar-content">
    <ul class="list-sidebar">
      <?php
        foreach ($feed_articles as $feed_article){
          echo "<li><a href='$feed_article[slug]'>$feed_article[title]</a></li>";
        }
      ?>
    </ul>
  </div>
</div>
<div class="widget-sidebar widget-tags">
  <h5 class="sidebar-title">Tags</h5>
  <div class="sidebar-content">
    <ul>
      <?php 
        foreach ($categories as $category){
          echo "<li><a href='" . base_url($category['slug']) . "'>$category[name]</a></li>";
        }
      ?>
    </ul>
  </div>
</div>