FROM php:7.4.23-apache
COPY ./* /var/www/html/
RUN chown -R www-data:www-data /var/www/html
CMD ["start-apache"]
