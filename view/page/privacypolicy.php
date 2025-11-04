<?php
/*
Page Title: プライバシーポリシー
Page Slug: privacypolicy
*/
get_header();
$page = getPageInfo('all');
$name = 'toku-Noix';
$abb = '当施設';
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

  <div class="l-content p-privacypolicy -under">
    <section>
      <div class="c-inner">
        <div class="p-privacypolicy__head">
          <p class="p-privacypolicy__lead">
            <?= $name ?>（以下「<?= $abb ?>」といいます）は、以下のとおり個人情報保護方針を定め、個人情報保護の仕組みを構築し、全従業員に個人情報保護の重要性の認識と取組みを徹底させることにより、個人情報の保護を推進致します。
          </p>
        </div>
        <div class="p-privacypolicy__body">
          <dl>
            <div class="p-privacypolicy__item">
              <dt>1. 個人情報の管理 </dt>
              <dd>
                <?= $abb ?>は、お客様の個人情報を正確かつ最新の状態に保ち、個人情報への不正アクセス・紛失・破損・改ざん・漏洩などを防止するため、セキュリティシステムの維持・管理体制の整備・社員教育の徹底等の必要な措置を講じ、安全対策を実施し個人情報の厳重な管理を行ないます。
              </dd>
            </div>
            <div class="p-privacypolicy__item">
              <dt>2. 個人情報の利用目的 </dt>
              <dd>お客様からお預かりした個人情報は、当院からのご連絡や業務のご案内やご質問に対する回答として、電子メールや資料のご送付に利用致します。

              </dd>
            </div>
            <div class="p-privacypolicy__item">
              <dt>3. 個人情報の第三者への開示・提供の禁止 </dt>
              <dd><?= $abb ?>は、お客様よりお預かりした個人情報を適切に管理し、次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。
                <ul class="p-privacypolicy__list">
                  <li>お客様の同意がある場合 </li>
                  <li>お客様が希望されるサービスを行なうために<?= $abb ?>が業務を委託する業者に対して開示する場合</li>
                  <li>法令に基づき開示することが必要である場合</li>
                </ul>
              </dd>
            </div>
            <div class="p-privacypolicy__item">
              <dt>4. 個人情報の安全対策</dt>
              <dd><?= $abb ?>は、個人情報の正確性及び安全性確保のために、セキュリティに万全の対策を講じています。 </dd>
            </div>
            <div class="p-privacypolicy__item">
              <dt>5. ご本人の照会 </dt>
              <dd>お客様がご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認の上、対応させていただきます。 </dd>
            </div>
            <div class="p-privacypolicy__item">
              <dt>6. 法令、規範の遵守と見直し</dt>
              <dd><?= $abb ?>は、保有する個人情報に関して適用される日本の法令、その他規範を遵守するとともに、本ポリシーの内容を適宜見直し、その改善に努めます。 </dd>
            </div>
            <div class="p-privacypolicy__item">
              <dt>7. 当サイトでのクッキー（Cookie）の利用について </dt>
              <dd>
                当サイトでは、お客様が当サイトを利用するうえでの利便性向上を目的とした最適なサイト表示、閲覧状況の統計的な調査と分析などのためにクッキーを使用しております。クッキーとは、当サイトにアクセスした際にお客様のコンピューターやスマートデバイスなどのインターネット接続可能な機器上に保存されるファイルや情報のことです。<br>当サイトでは、主に下記の用途でクッキーを使用しております。尚、お客様の個人情報を取得する目的では使用しておりません。
                <ul class="p-privacypolicy__list">
                  <li>最適なウェブサイトの表示、サービス向上のため</li>
                  <li>お客様が入力された情報を一時的に管理するため</li>
                  <li>お客様がアクセスされている国・地域に最適なウェブサイトをご案内するため</li>
                  <li>閲覧状況の統計的な調査と分析のため</li>
                </ul>
              </dd>
            </div>
            <div class="p-privacypolicy__item">
              <dt>8. Googleアナリティクスの使用について</dt>
              <dd>当サイトでは、より良いサービスの提供、またユーザビリティの向上のため、Googleアナリティクスを使用し、当サイトの利用状況などのデータ収集及び解析を行っております。
                その際、「Cookie」を通じて、Googleがお客様のIPアドレスなどの情報を収集する場合がありますが、「Cookie」で収集される情報は個人を特定できるものではありません。
                収集されたデータはGoogleのプライバシーポリシーにおいて管理されます。
                なお、当サイトのご利用をもって、上述の方法・目的においてGoogle及び当サイトが行うデータ処理に関し、お客様にご承諾いただいたものとみなします。
                <div class="p-privacypolicy__ga">
                  <div class="link_box">
                    <div class="ttl">【Googleのプライバシーポリシー】</div>
                    <a href="http://www.google.com/intl/ja/policies/privacy/"
                      target="_blank">http://www.google.com/intl/ja/policies/privacy/</a><br>
                    <a href="http://www.google.com/intl/ja/policies/privacy/partners/"
                      target="_blank">http://www.google.com/intl/ja/policies/privacy/partners/</a>
                  </div>
                </div>
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </section>
  </div>

</main>

<?php
get_footer();

?>