# Allmanageテーマ

従来の既存テーマの古い記述や、グローバル関数をひっかきまわす構成を一新して、新たにオブジェクト指向の「クラス」と型定義を取り入れソースが肥えてきたとしてもある程度の管理コストで理解できる塩梅を目指しています。

**作成中**

## 方針

- 何がどこにあるかわからない煩雑なテーマを辞める
- WordPress標準の何でもfunctions.phpに書くことを辞める
- functions.phpにはロジックを書かずに実装を他へ逃がして簡潔にする
- クラスを取り入れてテーマの肥大化に対応することでテーマを資産とする
- ロジックには型定義を積極的に書くことで視覚的負担を減らす
- 古い書き方を辞めてモダンな書き方に触れることでLaravelにもスイッチしやすくする

## コーディングについて
### **日々更新していきますので、必ず、案件ごとに新しく git clone もしくは zip を落として使用してください。**

1. 基本的には`views` `config` `assets` `app/functions.php` だけを見ればコーディング作業ができるように作っていますので、一番最初はこれらのディレクトリをチェックしてください。

2. WordPress標準ではテーマ直下にファイルが散らばりますが、それらをすべて`views`ディレクトリに逃がしていますので、テーマ直下を触る必要はありません。

3. CSSやJSの登録、カスタム投稿・タクソノミーの作成、ページURLの設定は`config`ディレクトリを編集してください。その設定ファイルをもとに`app`ディレクトリの中でロジックを組んでいます。

2. アドバイスや改善点は積極的に提案し、より良いテーマにしたいです。

## 動作環境について

モダンPHPで構成されていますので、本番、テストに関わらず、テーマを動かすには`Conposer`環境が**必須**です。
未インストールの場合は下記を参考にインストールしてください。
[https://kinsta.com/jp/blog/install-composer/](https://kinsta.com/jp/blog/install-composer/)

```sh
# conposerインストール後にテーマ直下のディレクトリで
# シェルで書きコマンドを叩き依存関係をインストールします。
# 問題なくインストールできればテーマが稼働します。
cd allmanage_theme
composer install
```

## Sassについて

基本は vscode プラグインのLive Sass Compailerを使用します。

コンパイルのルール（入出力先）などは`./.vscode/settings.json`に記載してあるのでそのままコンパイルしていただければ問題ありません。

## 必須プラグインについて
1. `WPvivid Backup Plugin` バックアップ・データ移行

2. `Advanced Custom Fields Pro` 各種カスタムフィールド・オプションページ `\\IODATA-35a52a\disk1\【顧客情報】\■Allmanage自社関連情報\●各種サービス・システム関係\Advanced Custom Fields Pro（ACF）`

3. `XML Sitemap Generator for Google` サイトマップ生成

4. `Website LLMs.txt` AIO 対策のため導入

5. `mw wp form` お問い合わせフォーム作成

---

## 起動

テーマ読み込み時に `App\Bootstrap\App` が起動され
各 Hook / Admin / Plugin クラスの `boot()` が呼ばれることで初期化される

```
functions.php
 └─ App\Bootstrap\App::boot()
```

---

## View構成

```
views/
├─ page/
├─ single/
├─ archive/
├─ taxonomy/
├─ component/
└─ layout/
└─ admin/
```

- テンプレート階層は App\Services\Render で解決
- WordPress標準テンプレート階層（テーマ直下）は一切使わない

---

## アプリケーション構成

```
app/
├─ Bootstrap/      アプリ起動
├─ Hooks/          フロント・WPフック
├─ Admin/          管理画面拡張
├─ Plugins/        プラグイン連携
├─ Services/       共通サービス
└─ Services/UI/    表示用ロジック
```
---

### Service クラス

```
App\Services\*
```

- Viewに書きたくないロジックをここに逃がす
- functions.phpを通してViewとの懸け橋になる

---

### Hook クラス

```
App\Hooks\*
```

- add_action
- add_filter
- enqueue
- shortcode
- seo
- theme setup

---

### Admin クラス

```
App\Admin\*
```

- 投稿タイプ登録
- タクソノミー登録
- 管理画面UI制御
- オプションページ

---

### Plugin クラス

```
App\Plugins\*
```

- class_exists チェック必須
- プラグイン未導入でもエラーにしない
- WPに依存した拡張のみを書く

---