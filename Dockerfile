<<<<<<< HEAD
FROM nginx:1.9.15-alpine
=======
FROM php:7.4.23-apache
WORKDIR /var/www/html
COPY gateway.php gateway.php
RUN echo "<?php echo '<a href=\"gateway.php\">gateway</a>';" > index.php
RUN mkdir q
RUN chown -R www-data:www-data /var/www/html
CMD ["apache2-foreground"]
>>>>>>> 2d53798422dafc56e04a2460fbf0b3fe835c74aa
