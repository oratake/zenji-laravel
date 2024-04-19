# Zenji (Laravel)

Zenji

## 環境構築

[Composer依存関係のインストール](https://readouble.com/laravel/11.x/ja/sail.html#installing-composer-dependencies-for-existing-projects)
↑ `docker run --rm \ ...` とある部分を全て実行。
Dockerインストール済であれば実行可能。PHPのインストールは不要。
git cloneしただけではComposerの依存関係はインストールされていないので、

開発環境はsailを利用する
```
$ ./vendor/bin/sail up
```

※毎回vendorうんぬんと記述するのは手間なのでエイリアスで `sail up` のように起動できるようにするには[この説明](https://readouble.com/laravel/11.x/ja/sail.html#configuring-a-shell-alias)を読む。
