<nav class="l-header__navi">
  <div id="js-drawerMenu" class="slideout-menu slideout-menu-left">

    <div class="l-gnavi">

      <div class="l-gnavi__logo u-visible_tb">
        <img src="<?= get_template_directory_uri(); ?>/img/common/logo.svg" alt="<?= get_bloginfo('name'); ?>">
      </div>

      <ul class="l-gnavi__menu">

        <li class="l-gnavi__item">
          <a href="<?= get_url('top') ?>" class="l-gnavi__link">
            <div class="jp">トップ</div>
            <!-- <div class="en"></div> -->
          </a>
        </li>

      </ul>
      <ul class="l-gnavi__list -sub u-visible_tb">

        <li class="l-gnavi__item">
          <a target="_blank" href="<?= get_url('top'); ?>" class="l-gnavi__link ">
            <!--  -->
          </a>
        </li>

      </ul>
    </div>

  </div>

  <button type="button" class="l-header__hamburger slideout-hamburger so_toggle u-hidden_pc" id="js-drawerToggle">
    <span></span>
  </button>
</nav>