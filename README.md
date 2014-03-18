rcSEOCMS
========

Tiny Content Management System with SEO optimizations.


Installation manual
--------------------

1. Extract/copy all files into a directory of your webspace
2. Give read/write permissions for PHP/your webserver to the "data" directory ("chmod -R 766 data")
2a. If necessary, also change the file owners to www-data ("chmod -R www-data:www-data data")
3. Edit config.ini and follow the instructions
4. Point your webserver's root directory to public/
5. Set up URL rewriting according to REWRITE_CONFIG in your webserver
6. You can find your administration interface in /admin/



Installationsanleitung
-----------------------

1. Alle Dateien in ein Verzeichnis des Webspace entpacken/kopieren
2. Das Verzeichnis "data" mit Schreibrechten für PHP bzw. den Webserver versehen ("chmod -R 766 data")
2a. Wenn nötig auch den Inhaber der Dateien auf www-data ändern ("chmod -R www-data:www-data data")
3. config.ini editieren und den Anweisungen dort folgen
4. Webserver-Rootverzeichnis auf public/ setzen
5. URL-Rewriting gemäß REWRITE_CONFIG im Webserver einrichten
6. Administrationsoberfläche ist unter /admin/ zu finden



URL Rewriting configuration
----------------------------

apache
-------
Add the following 3 lines to your website's virtual host configuration file:

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ /index.php [QSA]


lighttpd
---------
Add following line into your website's virtual host configuration file:

url.rewrite-if-not-file = ("(.*)" => "/index.php/$0")

