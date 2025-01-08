# Use official PHP image (without Apache)
FROM php:8.1-cli

# Set the working directory
WORKDIR /var/www/html

# Install any PHP extensions you might need
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli

# Expose a port (optional, for running PHP's built-in server)
EXPOSE 8080

# Command to run PHP's built-in server when the container starts
CMD ["php", "-S", "0.0.0.0:8080"]
