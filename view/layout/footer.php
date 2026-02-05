    <footer class="footer">

      <div class="contents">
        <div class="footer-logo">
          <a href="<?= home(); ?>"><img src="<?= img_dir(); ?>common/logo-w.png" class="img-fluid" alt=""></a>
        </div>
        <?php
        get_template_part('view/parts/footer-navi');
        ?>
      </div>

    </footer>

    <!-- <div id="js-totop" class="c-totop">
      <svg class="arrow c-totop__icon">
        <use xlink:href="#icon-arrow"></use>
      </svg>
    </div> -->

    <?php wp_footer(); ?>
    </body>

    </html>