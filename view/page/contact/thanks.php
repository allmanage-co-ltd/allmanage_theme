<?php
/*
Page Title: 完了
Page Slug: thanks
Page Parent: contact
*/
get_header();
?>
<main class="p-contact">

  <div class="p-kv_under">
    <div class="p-kv_under__inner">
      <div class="c-inner">
        <div class="p-kv_under__ttl">
          <div class="en">CONTACT</div>
          <div class="jp">お問い合わせ</div>
        </div>
      </div>
    </div>
  </div>

  <div class="c-inner">
    <?php breadcrumb(); ?>
  </div>

  <section class="l-content -under">
    <!-- <div class="p-contact_head">
      <div class="c-inner">
        <div class="p-contact__inner">
          <div class="p-contact_head__box">
            <h2 class="p-contact_head__ttl">
              テキストテキスト
            </h2>
            <div class="p-contact_head__txt">
              テキストテキストテキストテキストテキストテキスト
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <div id="form" class="p-contact_form">
      <div class="c-inner">
        <div class="p-contact__inner">
          <div class="c-form -thanks">
            <?php the_content() ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>


<?php
get_footer();

?>