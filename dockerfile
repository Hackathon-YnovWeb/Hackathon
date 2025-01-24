# Utiliser l'image officielle d'Apache avec PHP
FROM php:8.1-apache

# Activer les modules nécessaires pour Apache
RUN a2enmod rewrite

# Copier les fichiers de votre site dans le répertoire approprié dans le conteneur
COPY . /var/www/html/

# Exposer le port 80 (par défaut pour HTTP)
EXPOSE 80

# Lancer Apache en mode premier plan
CMD ["apache2-foreground"]
