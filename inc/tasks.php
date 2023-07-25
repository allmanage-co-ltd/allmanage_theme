<?php

// タスク状態と担当者のメタボックスの追加
add_action('add_meta_boxes', 'tasks_add_meta_boxes');
function tasks_add_meta_boxes()
{
  add_meta_box('tasks_status_box', 'タスクの状態', 'display_tasks_status_box', 'tasks', 'side', 'high');

  // 担当者を設定する各役職のリスト
  $staff_roles = array('DR', 'DE', 'PG', '仕さん', 'TOP_D', '下層＆SP_D', 'PC/TOP_M', 'PC/下層_M', 'SP/TOP_M', 'SP/下層_M', 'WP/PG', 'その他');
  foreach ($staff_roles as $role) {
    add_meta_box('assign_staff_' . $role, $role . '', 'display_assign_staff_metabox', 'tasks', 'side', 'high', array('role' => $role));
  }
}


function display_tasks_status_box($post)
{
  $values = get_post_custom($post->ID);
  $selected = isset($values['tasks_status']) ? esc_attr($values['tasks_status'][0]) : '';
  wp_nonce_field('tasks_status_box_nonce', 'meta_box_nonce');
?>
  <p>
    <label for="tasks_status">状態</label>
    <select name="tasks_status" id="tasks_status">
      <option value="pending" <?php selected($selected, 'pending'); ?>>作業中</option>
      <option value="in_progress" <?php selected($selected, 'in_progress'); ?>>処理中</option>
      <option value="completed" <?php selected($selected, 'completed'); ?>>完了済み</option>
    </select>
  </p>
<?php
}

function display_assign_staff_metabox($post, $metabox)
{
  $role = $metabox['args']['role'];
  $values = get_post_custom($post->ID);
  $selected = isset($values['post_staff_' . $role]) ? unserialize($values['post_staff_' . $role][0]) : array();
  wp_nonce_field('assign_staff_nonce_' . $role, 'meta_box_nonce_' . $role);

  // カスタムタクソノミー「staff」から全スタッフを取得
  $args = array(
    'taxonomy' => 'staff',
    'hide_empty' => false,
  );
  $staff_terms = get_terms($args);

  // 選択ボックスの生成
  echo '<select name="post_staff_' . $role . '[]" id="post_staff_' . $role . '" multiple>';
  echo '<option value="">担当者なし</option>';
  foreach ($staff_terms as $term) {
    echo '<option value="' . $term->term_id . '" ' . (in_array($term->term_id, $selected) ? 'selected' : '') . '>' . $term->name . '</option>';
  }
  echo '</select>';
}

// カスタムフィールド値の保存
add_action('save_post', 'tasks_save_post');
function tasks_save_post($post_id)
{
  // 自動保存時は何もしない
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  // nonceチェック
  if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'tasks_status_box_nonce')) return;

  // ユーザー権限の確認
  if (!current_user_can('edit_post', $post_id)) return;

  // タスク状態と担当者の保存
  if (isset($_POST['tasks_status']))
    update_post_meta($post_id, 'tasks_status', sanitize_text_field($_POST['tasks_status']));

  // 担当者を設定する各役職のリスト
  $staff_roles = array('DR', 'DE', 'PG', '仕さん', 'TOP_D', '下層＆SP_D', 'PC/TOP_M', 'PC/下層_M', 'SP/TOP_M', 'SP/下層_M', 'WP/PG', 'その他');
  foreach ($staff_roles as $role) {
    // nonceチェック
    if (!isset($_POST['meta_box_nonce_' . $role]) || !wp_verify_nonce($_POST['meta_box_nonce_' . $role], 'assign_staff_nonce_' . $role)) continue;

    // 担当者の保存
    if (isset($_POST['post_staff_' . $role]))
      update_post_meta($post_id, 'post_staff_' . $role, serialize($_POST['post_staff_' . $role])); // 配列として保存
  }
}
?>