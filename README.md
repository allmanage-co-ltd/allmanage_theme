# オルマネテンプレートテーマ

色々なサイトで作成した機能をひとまとめにしたテーマです。
不要なファイルや不要な記述を整理していきたいと思います。

## 必須ルール

1. **案件ごとに新しく git から clone もしくは zip を落として使用してください。**
2. 明確な命名規則やコーディングルールはありませんが、よしなに合わせてください。
3. 不要なソースコードは含めず必要に応じてカスタマイズしてください。
4. ディレクトリ構造の変更は行わないようにお願いいたします。
5. Composer 等は無視で構いませんが積極的に使用してください。

## 必須プラグイン

1. `WPvivid Backup Plugin`
   バックアップ・データ移行

2. `Advanced Custom Fields Pro`
   各種カスタムフィールド・オプションページ
   `\\IODATA-35a52a\disk1\【顧客情報】\■Allmanage自社関連情報\●各種サービス・システム関係\Advanced Custom Fields Pro（ACF）`

3. `XML Sitemap Generator for Google`
   サイトマップ生成

4. `Website LLMs.txt`
   AIO 対策のため導入

## ディレクトリ構成

```
.
├── .php-cs-fixer.dist.php   # php-cs-fixerの設定管理ファイル
├── .phpstan.neon            # phpstanの設定管理ファイル
├── composer.json            # composerの設定管理ファイル
├── .vscode/                 # VSCode設定
│   └── settings.json        # インデント等の共通ルール
│
├── config/                  # 案件ごとに変わる設定等
│
├── dashboard/               # 管理画面に関連するフック等
│
├── func/                    # テーマの独自関数
│
├── img/                     # 画像ファイル管理
│
├── js/                      # スクリプトファイル管理
│
├── style/                   # スタイルファイル管理
│   ├── css/                 # コンパイル後のCSSファイル
│   └── scss/                # SCSSソースファイル
│
└── view/                    # テンプレートファイル
   ├── parts/                # 共通コンポーネント
   │   └── ...               # ヘッダー、フッター等の共通パーツ
   │
   ├── page/                 # 固定ページテンプレート
   │   └── *.php             # スラッグに応じたテンプレート
   │                         # 例: page/recruit.index.php → /recruit
   │                         # 例: page/recruit.php → /recruit
   │
   ├── single/               # 投稿詳細テンプレート
   │   └── *.php             # カスタム投稿タイプに応じた詳細テンプレート
   │
   ├── taxonomy/             # タクソノミーアーカイブテンプレート
   │   └── *.php             # タクソノミーに応じたテンプレート
   │
   └── archive/              # アーカイブテンプレート
       └── *.php             # カスタム投稿タイプのアーカイブテンプレート
```

## セットアップ

- ### Conposer

  php のパッケージマネージャ`composer`のインストールが必要です。

  未インストールの場合は下記を参考にインストールしてください。

  https://kinsta.com/jp/blog/install-composer/

  ```sh
  # conposerインストール後にカレントディレクトリで
  # プロジェクトの依存関係をインストールします。
  composer install
  ```

  `conposer`には npm 同様のコマンド登録機能があります。

  ```json
  {
    "scripts": {
      "cs": "php-cs-fixer fix --dry-run --diff",
      "cs:fix": "php-cs-fixer fix",
      "analyse": "phpstan analyse"
    }
  }
  ```

- ### Sass

  基本は vscode プラグインの`Live Sass Compailer`を使用します。

  コンパイルルール（入出力先）などは`./.vscode/settings.json`に記載してあるのでそのままコンパイルしていただければ問題ありません。

---

## コード品質管理

### Rector

1. Rector
   PHP のバージョンアップに伴うソースの修正対応をある程度自動化できます。
   [参考](https://zenn.dev/m01tyan/articles/3fcf6b59fba070)

```sh
composer rector     # 自動修正点の確認のみ
composer rector:fix # 自動修正を実行
```

### Formatter

1. 独自ルール（`./.vscode/settings.json`で 2 スぺインデントを強制）
   vscode での設定と PHP CS Fixer フォーマットが若干かみ合わずに毎回微修正されます。。。。
2. PHP CS Fixer
   [参考](https://qiita.com/suin/items/4242aec018d086312fe7)

```sh
composer cs     # フォーマットチェックのみ
composer cs:fix # フォーマットを自動修正する
```

### Linter

1. PHPStan
   [参考](https://www.divx.co.jp/media/172)

```sh
composer analyse
```

---

## CI / CD

- CI（継続的インテグレーション）

  - Trigger: staging ブランチへのプルリクエスト
  - Action: PHP CS Fixer, PHPStan の実行及びレポート作成

- CD（継続的デプロイメント）
  - Trigger: staging ブランチへのプルリクエスト
  - Action: 本番環境へ SSH 接続し`git pull`を実行

---
