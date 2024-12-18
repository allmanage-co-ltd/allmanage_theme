# Wordpress 用のスタートテーマです。

色々なサイトで作成した機能をひとまとめにしたテーマです。
不要なファイルや不要な記述を整理していきたいと思います。

---

## ディレクトリ内容

### .vscode

- Live Sass Compiler を使用する際のコンパイルルール

### build

- コンパイルが必要なファイル群　本番環境では切り離す事を考慮する事

### functions

- テーマの独自関数の定義ディレクトリ、ルートの fanctions.php で include する

### src

- 画像・js・コンパイル後の css 等

### view

- #### parts
  - page で共通化するコンポーネントの格納ディレクトリ
- #### page
  - 固定ページのスラッグに応じたファイル名の php ファイルを page.php で読み込み
    - http://domain.com/recruit = /view/page/recruit.php
- #### single
  - カスタム投稿のスラッグに応じたファイル名の php ファイルを single.php で読み込み
    -
- #### archive
  - カスタム投稿のスラッグに応じたファイル名の php ファイルを single.php で読み込み
    -
