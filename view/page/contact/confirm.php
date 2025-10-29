<?php
/*
Page Title: 確認
Page Slug: confirm
Page Parent: contact
*/
get_header();
$page = getPageInfo('all');
?>

<main class="">

  <div class="p-kv_under">
    <div class="p-kv_under__inner">
      <div class="c-inner">
        <div class="p-kv_under__ttl">
          <div class="en"><?= $page['slug'] ?></div>
          <div class="jp"><?= $page['title'] ?></div>
        </div>
      </div>
    </div>
  </div>

  <div class="c-inner">
    <?php breadcrumb(); ?>
  </div>

  <section>

  </section>

</main>

<?php
get_footer();

?>