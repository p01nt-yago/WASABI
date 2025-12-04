# WASABIコーポレートサイト制作

WordPressのテーマファイル`WASABI`を開発します。  
WASABIコーポレートサイト制作は既存サイトとリニューアルサイトを共存させます。  

## 🚀開発環境
テスト環境URL：[]()  
本番環境URL：[]()  
  
WordPress管理画面：[]()
| ID | PW |
| --- | --- |
| point | point |

FTP情報
| ホスト名 | ID | PW |
| --- | --- | --- |
|  |  |  |

## 🎨デザインカンプ（Figma）
[https://www.figma.com/design/H3RRBfPj1cvQajLj9oSbpO/tonton_251125?node-id=454-601&t=yVG4GSIDAJ3K45f2-0](https://www.figma.com/design/H3RRBfPj1cvQajLj9oSbpO/tonton_251125?node-id=454-601&t=yVG4GSIDAJ3K45f2-0)

## 👾コーディングルール
### 全体
- 不要なコードや画像は残さない or 最終的に必ず削除する
- サードパーティの読み込みは使う時に都度読み込む（どうせ使うから読み込んでおこうはなし！）
### CSS
- BEM記法で記入すること。しかし、class名は「_」一つで繋げる。  
名前が2つ以上の単語になる場合はキャメルケース記法で命名する。
- ブレイクポイントは767pxとする。(必要であれば500pxを追加)SPを基準にコーディングする。
- 基本、`font-size`などの単位は`vw`、`margin`や`padding`は`%`とする。
- コンテンツ最大幅はPCデザインカンプ（ウィンドウ幅2200pxの時）のコンテンツ幅とする。  
2200pxを超えたらフォントサイズや空きがそれ以上大きくならないようにする。
### WordPress
- 共通パーツは`page-templates`フォルダにファイルを作成し呼び出す。
- 頻繁に使う処理は関数化し、`functions`フォルダにファイルを作成し呼び出す。
### 画像
- 画像は圧縮して、ファイルサイズを削減する。
- `assets`フォルダから読み込む画像は、WebP形式に変換し、`picture`タグで元形式と出し分ける。
- PC・SPで画像を分ける場合は`picture`タグを使用する
- `img`タグには`alt`/`widht`/`height`/`loading="lazy"`属性を指定すること

## ⚙️WordPress導入プラグイン
| 機能 | プラグイン |
| --- | --- |
| カスタムフィールド | Secure Custom Fields |
| カスタム投稿タイプ | Secure Custom Fields |
| SEO対策 | Yoast SEO |

## 🔍ディレクトリ構造
```
.
├── index.php
├── license.txt
├── local-xdebuginfo.php
├── readme.html
├── README.md
├── wp-activate.php
├── wp-admin
├── wp-blog-header.php
├── wp-comments-post.php
├── wp-config-sample.php
├── wp-config.php
├── wp-content
│   └── themes
│       └── wasabi
│           ├── 404.php
│           ├── archive-product.php
│           ├── assets
│           │   ├── css
│           │   │   ├── archive-news.css
│           │   │   ├── archive-news.css.map
│           │   │   ├── archive-seminar.css
│           │   │   ├── archive-seminar.css.map
│           │   │   ├── common.css
│           │   │   ├── common.css.map
│           │   │   ├── home.css
│           │   │   ├── home.css.map
│           │   │   ├── page-login.css
│           │   │   ├── page-login.css.map
│           │   │   ├── page-mypage.css
│           │   │   ├── page-mypage.css.map
│           │   │   ├── page-register.css
│           │   │   ├── page-register.css.map
│           │   │   ├── single-news.css
│           │   │   └── single-news.css.map
│           │   ├── images
│           │   │   ├── archive-news
│           │   │   ├── common
│           │   │   │   ├── logo.svg
│           │   │   │   ├── share_icon_facebook.svg
│           │   │   │   ├── share_icon_link.svg
│           │   │   │   ├── share_icon_x.svg
│           │   │   │   └── videoStart_btn_white.svg
│           │   │   └── home
│           │   ├── js
│           │   │   ├── archive-news.js
│           │   │   └── common.js
│           │   ├── manual
│           │   │   └── manual.pdf
│           │   └── scss
│           │       ├── abstracts
│           │       │   ├── _functions.scss
│           │       │   └── _variables.scss
│           │       ├── archive-news.scss
│           │       ├── archive-seminar.scss
│           │       ├── common.scss
│           │       ├── home.scss
│           │       ├── page-login.scss
│           │       ├── page-mypage.scss
│           │       ├── page-register.scss
│           │       ├── pages
│           │       │   ├── _archive-news.scss
│           │       │   ├── _archive-seminar.scss
│           │       │   ├── _common.scss
│           │       │   ├── _home.scss
│           │       │   ├── _page-login.scss
│           │       │   ├── _page-mypage.scss
│           │       │   ├── _page-register.scss
│           │       │   └── _single-news.scss
│           │       └── single-news.scss
│           ├── category-interview.php
│           ├── category-seminar.php
│           ├── category.php
│           ├── footer.php
│           ├── front-page.php
│           ├── functions.php
│           ├── gulpfile.js
│           ├── header.php
│           ├── home.php
│           ├── index.php
│           ├── lib
│           │   ├── functions
│           │   │   ├── add-link-files.php
│           │   │   ├── admin.php
│           │   │   ├── auth.php
│           │   │   ├── load-more-posts.php
│           │   │   ├── post-ranking.php
│           │   │   └── tinymce-custom.php
│           │   ├── helpers
│           │   │   ├── getVideoId.php
│           │   │   ├── hrefSetting.php
│           │   │   ├── imageInfo.php
│           │   │   └── langCheck.php
│           │   └── js
│           │       └── tinymce-custom-menu.js
│           ├── node_modules
│           ├── package-lock.json
│           ├── package.json
│           ├── page-login.php
│           ├── page-message.php
│           ├── page-mypage.php
│           ├── page-password-reset-complete.php
│           ├── page-password-reset-form.php
│           ├── page-philosophy.php
│           ├── page-reason.php
│           ├── page-register.php
│           ├── page-reset-password.php
│           ├── page-templates
│           │   ├── brandPage-menu.php
│           │   ├── brandPage-whatsFarmind.php
│           │   ├── headline-bg.php
│           │   ├── headline-underline.php
│           │   ├── news
│           │   │   ├── item.php
│           │   │   ├── news-content-default.php
│           │   │   ├── news-content-interview.php
│           │   │   └── news-content-seminar.php
│           │   ├── page-title.php
│           │   ├── product-item.php
│           │   ├── round-btn-arrow.php
│           │   ├── round-btn.php
│           │   └── roundFull-btn.php
│           ├── page-thanks.php
│           ├── screenshot.png
│           ├── single-product.php
│           ├── single.php
│           ├── style.css
│           └── taxonomy-category_product.php
├── wp-cron.php
├── wp-includes
├── wp-links-opml.php
├── wp-load.php
├── wp-login.php
├── wp-mail.php
├── wp-settings.php
├── wp-signup.php
├── wp-trackback.php
└── xmlrpc.php
```