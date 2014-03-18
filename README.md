rcSEOCMS
========

Tiny Content Management System with SEO optimizations.


Installation manual
--------------------

1. Extract/copy all files into a directory of your webspace
2. Give read/write permissions for PHP/your webserver to the "data" directory ```chmod -R 766 data```
3. If necessary, also change the file owners to www-data ```chmod -R www-data:www-data data```
4. Edit config.ini and follow the instructions
5. Point your webserver's root directory to public/
6. Set up URL rewriting according to URL Rewriting Configuration (see below) in your webserver
7. You can find your administration interface in /admin/



Installationsanleitung
-----------------------

1. Alle Dateien in ein Verzeichnis des Webspace entpacken/kopieren
2. Das Verzeichnis "data" mit Schreibrechten für PHP bzw. den Webserver versehen ```chmod -R 766 data```
3. Wenn nötig auch den Inhaber der Dateien auf www-data ändern ```chmod -R www-data:www-data data```
4. config.ini editieren und den Anweisungen dort folgen
5. Webserver-Rootverzeichnis auf public/ setzen
6. URL-Rewriting gemäß URL Rewriting Configuration (siehe unten) im Webserver einrichten
7. Administrationsoberfläche ist unter /admin/ zu finden



URL Rewriting configuration
----------------------------

apache
-------
Add the following 3 lines to your website's virtual host configuration file:
```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ /index.php [QSA]
```

lighttpd
---------
Add following line into your website's virtual host configuration file:
```
url.rewrite-if-not-file = ("(.*)" => "/index.php/$0")
```
