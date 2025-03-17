# Use an official PHP runtime as a parent image with Apache
FROM php:7.4-apache

# Install PostgreSQL driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Change ownership of the /var/www/html directory to www-data
RUN chown -R www-data:www-data /var/www/html

# Change permissions of the /var/www/html directory
RUN chmod -R 755 /var/www/html

# Expose port 80 to allow communication to/from the server
EXPOSE 80

# Use custom command to keep the container running
CMD ["apache2-foreground"]
