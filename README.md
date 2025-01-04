# Wordpress 用のスタートテーマです。

色々なサイトで作成した機能をひとまとめにしたテーマです。
不要なファイルや不要な記述を整理していきたいと思います。

---

## セットアップ

- ### Conposer

  phpのパッケージマネージャ`composer`のインストールが必要です。

  未インストールの場合は下記を参考にインストールしてください。

  https://kinsta.com/jp/blog/install-composer/

  ```sh
  # conposerインストール後にカレントディレクトリで
  # プロジェクトの依存関係をインストールします。
  composer install
  ```
  `conposer`にはnpm同様のコマンド登録機能があります。
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

  基本はvscodeプラグインの`Live Sass Compailer`を使用します。

  コンパイルルール（入出力先）などは`./.vscode/settings.json`に記載してあるのでそのままコンパイルしていただければ問題ありません。

---

## コード品質管理

### Formatter
1. 独自ルール（`./.vscode/settings.json`で2スぺインデントを強制）
  - vscodeでの設定とPHP CS Fixerフォーマットが若干かみ合わずに毎回微修正されます。。。。
2. PHP CS Fixer
```sh
# 参考サイト（随時追加してください。）
# https://qiita.com/suin/items/4242aec018d086312fe7

composer cs     # フォーマットチェックのみ
composer cs:fix # フォーマットを自動修正する
```

### Linter
1. PHPStan
```sh
# 参考サイト（随時追加してください。）
# https://www.divx.co.jp/media/172

composer analyse
```

---

## CI / CD

- CI（継続的インテグレーション）
  - Trigger: stagingブランチへのプルリクエスト
  - Action: PHP CS Fixer, PHPStanの実行及びレポート作成

- CD（継続的デプロイメント）
  - Trigger: stagingブランチへのプルリクエスト
  - Action: 本番環境へSSH接続し`git pull`を実行

---

## ディレクトリ構成
```
.
├── .php-cs-fixer.dist.php   # php-cs-fixerの設定管理ファイル
├── .phpstan.neon            # phpstanの設定管理ファイル
├── composer.json            # composerの設定管理ファイル
├── .vscode/                 # VSCode設定
│   └── settings.json        # インデント等の共通ルール
│
├── admin/                   # 管理画面用ディレクトリ
│
├── functions/               # テーマの独自関数
│   └── ...                  # functions.phpでincludeされる関数ファイル群
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
   │                         # 例: recruit.php → /recruit
   │
   ├── single/               # 投稿詳細テンプレート
   │   └── *.php             # カスタム投稿タイプに応じたテンプレート
   │
   └── archive/              # アーカイブテンプレート
       └── *.php             # カスタム投稿タイプのアーカイブテンプレート
```

---