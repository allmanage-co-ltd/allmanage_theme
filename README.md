# Wordpress用のスタートテーマです。
色々なサイトで作成した機能をひとまとめにしたテーマです。
不要なファイルや不要な記述を整理していきたいと思います。

---

## ディレクトリ内容

### .vscode
- Live Sass Compilerを使用する際のコンパイルルール
### build
- Gulpを使用する場合のみ使用（既存public内のソースとの差分に注意）
### functions
- テーマの独自関数の定義ディレクトリ、ルートのfanctions.phpでincludeする
### public
- webサーバから直接アクセスされる静的ファイル（画像・js・コンパイル後のcss等）
### view
- #### components
    - pageで共通化するコンポーネントの格納ディレクトリ
- #### page
    - 固定ページのスラッグに応じたファイル名のphpファイルをpage.phpで読み込み
        - http://domain.com/recruit = /view/page/recruit.php
- #### single
    - 
        - 


