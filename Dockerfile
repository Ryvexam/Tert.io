# Use the specified PHP 8.2 Alpine-based image with Nginx Unit
FROM shinsenter/php:8.2-unit-php-alpine

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container
COPY . .

# Install necessary dependencies
RUN apk add --no-cache \
    git \
    zip \
    unzip

# Expose port 80
EXPOSE 80

# The default command starts Nginx Unit
CMD ["unitd", "--no-daemon", "--control", "unix:/var/run/control.unit.sock"]
