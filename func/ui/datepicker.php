<?php

/**
 * フォーム設置ページで初期化後、付与したいテキストフィールドにjs-datepickerクラスを付与する
 *
 * init_datepickr(['dateFormat' => 'Y年m月d日']);
 */
function init_datepickr($options = [])
{
  $defaults = [
    'dateFormat' => 'Y年m月d日',
    'locale' => 'ja'
  ];

  $config = array_merge($defaults, $options);
  $configJson = json_encode($config, JSON_UNESCAPED_UNICODE);
  echo <<<HTML
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('.js-datepicker', {$configJson});
        });
    </script>
    HTML;
}