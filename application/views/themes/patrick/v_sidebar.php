<!-- Header -->
<header class="header">

  <!-- logo -->
  <div class="logo">
    <a href="{BASE_URL}"><span>AS</span></a>
  </div>

  <!-- menu -->
  <div class="top-menu">
    <ul>
      {MENU_NAVIGATION}
    </ul>
  </div>

  <!-- Started socials -->
  <div class="social">
    <!-- <a target="_blank" href="https://dribbble.com/"><span class="icon la la-dribbble"></span></a>
    <a target="_blank" href="https://facebook.com/"><span class="icon la la-facebook"></span></a>
    <a target="_blank" href="https://github.com/"><span class="icon la la-github"></span></a>
    <a target="_blank" href="https://stackoverflow.com/"><span class="icon la la-stack-overflow"></span></a> -->
    <?php
      $data = select("social_media","*","ORDER BY created");
      foreach($data as $i => $r){
        echo '
        <a target="_blank" href="'.$r['link'].'"><span class="icon la la-'.$r['icon'].'"></span></a>';
      }
    ?>
  </div>

  <!-- Mobile Menu -->
  <span class="menu-btn">
    <span class="m-line"></span>
  </span>

</header>