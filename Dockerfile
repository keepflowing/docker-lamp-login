# Use the official PHP image with Apache
FROM php:8.2-apache

# Install support for MySQL
RUN docker-php-ext-install mysqli

# Enable the Apache mod_rewrite module
RUN a2enmod rewrite

# Set index.php as the default file to serve
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-available/custom-directoryindex.conf
RUN a2enconf custom-directoryindex

# Copy the 'src' folder contents to the web root
COPY src/ /var/www/html/

# Set appropriate permissions for the web directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
