<?php

/**
 * Cookie同意ポップアップを表示する関数
 *
 * showCookieConsent($days = 365, $link = '/privacypolicy', $acceptBtnBg = '#FF6B00');
 */
function showCookieConsent($days = 365, $link = '/privacypolicy', $acceptBtnBg = '#FF6B00')
{
  $cookieName = 'cookie_consent';

  $buttonPressed = null;
  if (isset($_POST['accept_cookies'])) {
    $buttonPressed = 'accepted';
  } elseif (isset($_POST['cancel_cookies'])) {
    $buttonPressed = 'rejected';
  }

  if ($buttonPressed) {
    $expiry = time() + ($days * 24 * 60 * 60);
    $maxAge = $days * 24 * 60 * 60;
    @setcookie($cookieName, $buttonPressed, $expiry, '/');
    echo "<script>
      document.cookie = '{$cookieName}={$buttonPressed}; path=/; max-age={$maxAge}';
      window.location.href = window.location.href;
    </script>";
    exit;
  }

  if (isset($_COOKIE[$cookieName])) {
    return;
  }
?>
<style>
:root {
  --CookieAcceptBtnBg: <?=$acceptBtnBg ?>;
}

.cookie-consent {
  position: fixed;
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
  width: min(90%, 800px);
  background: #fff;
  color: white;
  padding: 20px;
  text-align: center;
  z-index: 9999;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.cookie-consent p span {
  font-size: 1.8rem;
  font-weight: bold;
}

.cookie-consent p {
  margin: 0 0 15px 0;
  font-size: 14px;
  line-height: 1.6;
  color: #000;
}

.cookie-consent a {
  color: #000;
  text-decoration: underline;
}

.cookie-consent a:hover {
  color: var(--CookieAcceptBtnBg);
}

.cookie-consent button {
  color: white;
  border: none;
  padding: 5px 30px;
  font-size: 16px;
  cursor: pointer;
  border: 1px solid;
  border-radius: 100px;
  transition: all 0.3s ease;
}

.cookie-consent button[name="accept_cookies"] {
  border-color: var(--CookieAcceptBtnBg);
  background: var(--CookieAcceptBtnBg);
}

.cookie-consent button[name="accept_cookies"]:hover {
  background: #fff;
  color: var(--CookieAcceptBtnBg);
}

.cookie-consent button[name="cancel_cookies"] {
  margin-left: 10px;
  background: #666;
  border-color: #666;
}

.cookie-consent button[name="cancel_cookies"]:hover {
  color: #666;
  background: #fff;
}

@media (max-width: 600px) {
  .cookie-consent {
    bottom: 0;
    width: 100%;
    border-radius: 0;
  }

  .cookie-consent button {
    display: block;
    width: 100%;
    margin: 5px 0 !important;
  }
}
</style>

<div class="cookie-consent">
  <p><span>当サイトではCookieを使用します。</span><br>Cookieの使用に関する詳細は「<a
      href="<?= htmlspecialchars($link, ENT_QUOTES, 'UTF-8') ?>">プライバシーポリシー</a>」をご覧ください。</p>
  <form method="post" style="display: inline;">
    <button type="submit" name="accept_cookies">Cookieを許可する</button>
    <button type="submit" name="cancel_cookies">Cookieを拒否する</button>
  </form>
</div>
<?php
}
// showCookieConsent(365, '/privacypolicy');
?>