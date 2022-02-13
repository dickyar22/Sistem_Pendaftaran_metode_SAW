<!-- Header page -->
<header class="header">
  <div class="header-bottom hidden-tablet-landscape" id="js-navbar-fixed">
      <div class="container">
          <div class="header-bottom">
              <div class="header-bottom-content display-flex">
                  <div class="logo">
                      <a href="index.html">
                          <img src="{BASE_URL}img/logo.png" alt="Image" style="width: 50px; height: 50px;">
                          <img src="{BASE_URL}img/logo2.png" alt="Image" style="width: 150px; height: 20px; margin-top: 10px;">
                      </a>
                  </div>
                  <div class="menu-search display-flex">
                      <nav class="menu">
                          <div>
                              <ul class="menu-primary">
                                {MENU_NAVIGATION}
                                {MENU_HEADER}
                              </ul>
                          </div>
                      </nav>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="hidden-tablet-landscape-up header-mobile">
      <div class="header-top-mobile">
          <div class="container-fluid">
              <div class="logo">
                  <a href="index.html">
                    <img src="{BASE_URL}img/logo.png" alt="Image" style="width: 50px; height: 50px;">
                    <img src="{BASE_URL}img/logo2.png" alt="Image" style="width: 100px; height: 20px; margin-top: 10px;">
                  </a>
              </div>
              <button class="hamburger hamburger--spin hidden-tablet-landscape-up" id="toggle-icon">
                  <span class="hamburger-box">
                      <span class="hamburger-inner"></span>
                  </span>
              </button>
          </div>
      </div>
      <div class="au-nav-mobile">
          <nav class="menu-mobile">
              <div>
                  <ul class="au-navbar-menu">
                    {MENU_NAVIGATION}
                    {MENU_HEADER}
                  </ul>
              </div>
          </nav>
      </div>
      <div class="clear"></div>
  </div>
</header>