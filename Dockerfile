FROM php:7.4.23-apache
COPY gateway.php /var/www/html/gateway.php
RUN chown www-data:www-data /var/www/html/gateway.php
CMD ["apache2", "-D", "FOREGROUND"]
