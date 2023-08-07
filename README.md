# Symfony学習
## 参照
The Fast Track - 基礎から最速で学ぶ Symfony 入門
https://symfony.com/doc/6.2/the-fast-track/ja/index.html

## 手順
### 開始
```
cd プロジェクトルート
symfony server:start -d
symfony open:local
```

### 終了
```
cd プロジェクトルート
symfony server:stop
```

# 進行
完了 コントローラーを作成する
次 データベースをセットアップする https://symfony.com/doc/6.2/the-fast-track/ja/7-database.html

# TIPS
## homebrew xdebug 再インストール
### 以下のようにxdebugインストールが失敗する場合

```
pecl uninstall xdebug
pecl install xdebug
　・
　・
Warning: mkdir(): File exists in /opt/homebrew/Cellar/php/8.2.8/share/php/pear/System.php on line 294
ERROR: failed to mkdir /opt/homebrew/Cellar/php/8.2.8/pecl/20220829
```

peclシンボリックリンクがあるが実体は存在しない

```
ls -al /opt/homebrew/Cellar/php/8.2.8
total 136
-rw-r--r--   1 skanno  admin   6840  8  7 10:29 INSTALL_RECEIPT.json
-rw-r--r--   1 skanno  admin   3204  7  4 23:52 LICENSE
-rw-r--r--   1 skanno  admin  38363  7  4 23:52 NEWS
-rw-r--r--   1 skanno  admin   5222  7  4 23:52 README.md
drwxr-xr-x  12 skanno  admin    384  8  7 10:29 bin
-rw-r--r--   1 skanno  admin    781  8  7 10:29 homebrew.mxcl.php.plist
-rw-r--r--   1 skanno  admin    272  8  7 10:29 homebrew.php.service
drwxr-xr-x   3 skanno  admin     96  7  4 23:52 include
drwxr-xr-x   4 skanno  admin    128  7  4 23:52 lib
lrwxr-xr-x   1 skanno  admin     26  8  7 10:29 pecl -> /opt/homebrew/lib/php/pecl
drwxr-xr-x   3 skanno  admin     96  8  7 10:29 sbin
drwxr-xr-x   4 skanno  admin    128  7  4 23:52 share
```

削除することで再インストール可能

```
rm /opt/homebrew/Cellar/php/8.2.8/pecl

pecl install xdebug
```

### インストール後のxdebug利用設定
pecl installによってphp.iniに設定が追加されるが、xdebug.soの場所が間違っているためエラーとなる

php.ini 場所確認

```
php -i | grep php.ini
　・
　・
Loaded Configuration File => /opt/homebrew/etc/php/8.2/php.ini
```

php.iniの先頭にいかが追加されているので削除する

```
zend_extension="xdebug.so"
```

実際にインストールされたxdebug.soの場所を指定してphp.iniに設定追加

```
[xdebug]
zend_extension="/opt/homebrew/Cellar/php/8.2.8/pecl/20220829/xdebug.so"
xdebug.mode=debug,develop
;xdebug.file_link_format="phpstorm://open?file=%f&line=%l"
```
