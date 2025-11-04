<?php

declare(strict_types=1);

/**
 * 管理者権限の管理画面メニューをカスタマイズする
 */


/**
 * 管理バーを非表示にする
 */
if (current_user_can('administrator')) {
  show_admin_bar(false);
}