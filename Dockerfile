FROM php:8.2-apache

# UID e GID para o www-data
ARG UID=1000
ARG GID=1000

# Atualiza pacotes e instala dependências
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libldap2-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    nano && \
    docker-php-ext-configure ldap && \
    docker-php-ext-install ldap && \
    rm -rf /var/lib/apt/lists/*

# Instala e configura extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install -j$(nproc) gd mysqli soap pdo_mysql pdo zip

# Ativa módulos do Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    a2enmod rewrite


RUN sed -i 's/MaxRequestWorkers\s*[0-9]*/MaxRequestWorkers 250/' /etc/apache2/mods-available/mpm_prefork.conf

# Prepara sessão PHP
RUN mkdir -p /var/lib/php/sessions && \
    chmod -R 700 /var/lib/php/sessions

# Altera GID e UID do www-data
RUN groupmod -g ${GID} www-data || groupadd -g ${GID} www-data && \
    usermod -u ${UID} -g ${GID} www-data

# Dá permissão para sessão PHP ao novo UID
RUN chown -R www-data:www-data /var/lib/php/sessions

# Cria diretórios da aplicação
RUN mkdir -p /var/www/html/media && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 777 /var/www/html && \
    chmod -R 777 /var/www/html/media

# Copia e aplica permissão de execução ao script de entrada
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Define o entrypoint
ENTRYPOINT ["/entrypoint.sh"]

# Define usuário padrão de execução
USER www-data

# Inicia o Apache
CMD ["apache2-foreground"]
