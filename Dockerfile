FROM php:7.4.23-apache
WORKDIR /var/www/html
COPY gateway.php gateway.php
RUN echo "<?php echo '<a href=\"gateway.php\">gateway</a>';" > index.php
RUN mkdir q
RUN chown -R www-data:www-data /var/www/html
CMD ["apache2-foreground"]
