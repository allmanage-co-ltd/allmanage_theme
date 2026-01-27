<?php
$links = paginate_links(array(
  'total'        => $query->max_num_pages,
  'current'      => $paged,
  'mid_size'     => 2,
  'prev_text'    => '←',
  'next_text'    => '→',
  'type'         => 'array',
));
if ($links) :
?>
<nav class="wp-pager" role="navigation" aria-label="ページナビゲーション">
  <ul class="wp-pager__list">
    <?php foreach ($links as $link) : ?>
    <li class="wp-pager__item"><?= $link; ?></li>
    <?php endforeach; ?>
  </ul>
</nav>
<?php endif; ?>