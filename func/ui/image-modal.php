<?php

/**
 * 画像クリックで拡大表示
 *
 * init_image_modal(2.5, '拡大表示');
 */
function init_image_modal($scale = 2.5, $hoverText = '拡大表示')
{
?>
<div class="modal" id="imgModal">
  <img src="" alt="拡大画像">
</div>

<style>
.item-image {
  position: relative;
  cursor: pointer;
}

.item-image::before {
  content: "<?= $hoverText ?>";
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  inset: 0;
  opacity: 0;
  background: rgba(0, 0, 0, 0.69);
  color: #fff;
  font-weight: bold;
  font-size: 1.4rem;
  letter-spacing: 0.08rem;
  transition: opacity 0.4s;
  pointer-events: none;
}

.item-image:hover::before {
  opacity: 1;
}

.item-image img {
  cursor: pointer;
}

.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  inset: 0;
  background: rgba(0, 0, 0, 0.8);
  justify-content: center;
  align-items: center;
}

.modal img {
  max-height: 80%;
  max-width: 90%;
  width: auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  cursor: zoom-in;
  transition: transform 0.3s ease;
}

.modal img.zoomed {
  cursor: grab;
  transition: none;
  max-height: none;
  max-width: none;
}

.modal img.dragging {
  cursor: grabbing;
}
</style>

<script>
jQuery(function($) {
  const $modal = $("#imgModal");
  const $img = $("#imgModal img");
  const scale = <?= $scale ?>;

  let isDragging = false;
  let startX, startY, moveX = 0,
    moveY = 0;

  // モーダルを開く
  $(".item-image").on("click", function() {
    const src = $(this).find("img").attr("src");
    resetModal();
    $img.attr("src", src);
    $modal.fadeIn();
  });

  // モーダルをリセット
  function resetModal() {
    $img.removeClass("zoomed dragging");
    $img.css("transform", "translate(-50%, -50%)");
    moveX = moveY = 0;
  }

  // 画像クリックで拡大/縮小
  $img.on("click", function(e) {
    if (isDragging) return;

    if (!$img.hasClass("zoomed")) {
      // 拡大
      $img.addClass("zoomed").css(
        "transform",
        `translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px)) scale(${scale})`
      );
    } else {
      // 縮小
      resetModal();
    }
  });

  // ドラッグ開始
  $img.on("mousedown", function(e) {
    if (!$img.hasClass("zoomed")) return;

    isDragging = true;
    $img.addClass("dragging");
    startX = e.pageX - moveX;
    startY = e.pageY - moveY;
    e.preventDefault();
  });

  // ドラッグ移動
  $(document).on("mousemove", function(e) {
    if (!isDragging) return;

    moveX = e.pageX - startX;
    moveY = e.pageY - startY;
    $img.css(
      "transform",
      `translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px)) scale(${scale})`
    );
  });

  // ドラッグ終了
  $(document).on("mouseup", function() {
    if (isDragging) {
      isDragging = false;
      $img.removeClass("dragging");
    }
  });

  // 背景クリックで閉じる
  $modal.on("click", function(e) {
    if (e.target.id === "imgModal") {
      $modal.fadeOut();
    }
  });

  // ESCキーで閉じる
  $(document).on("keydown", function(e) {
    if (e.key === "Escape" && $modal.is(":visible")) {
      $modal.fadeOut();
    }
  });
});
</script>
<?php
}
?>