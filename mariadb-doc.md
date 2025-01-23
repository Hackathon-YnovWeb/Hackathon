# Documentation MariaDB Docker

## Structure du Projet

Le projet contient deux fichiers essentiels :
- `Dockerfile-bdd` : Configuration du conteneur MariaDB
- `init.sql` : Script d'initialisation de la base de données

## Configuration de la Base de Données

### Identifiants
- **Super Admin (root)**
  - Utilisateur : root
  - Mot de passe : AdminHackathon

- **Utilisateur Standard**
  - Utilisateur : admin
  - Mot de passe : Hackathon
  - Base de données : hackathon

### Structure de la Base de Données

La base contient trois tables :

1. **messages**
   - id (AUTO_INCREMENT)
   - author (VARCHAR)
   - text (TEXT)
   - time (DATETIME)

2. **info**
   - id (AUTO_INCREMENT)
   - nom (VARCHAR)
   - description (TEXT)
   - niveauDanger (VARCHAR)
   - type (VARCHAR)
   - date (DATETIME)
   - zone (INT)
   - intensite_valeur (DECIMAL)
   - intensite_unite (VARCHAR)

3. **activities**
   - id (AUTO_INCREMENT)
   - nom (VARCHAR)
   - type (VARCHAR)
   - description (TEXT)
   - dateEtHeure (DATETIME)
   - danger (VARCHAR)
   - nombreDeParticipants (INT)
   - zone (INT)

## Instructions d'Utilisation

### Construction de l'Image
```bash
docker build -t mon-mariadb -f Dockerfile-bdd .
```

### Lancement du Conteneur
```bash
docker run -d -p 3307:3306 --name mariadb-server mon-mariadb
```

### Connexion à la Base de Données

#### En tant que Super Admin
```bash
docker exec -it mariadb-server mysql -u root -pAdminHackathon
```

#### En tant qu'Utilisateur Standard
```bash
docker exec -it mariadb-server mysql -u admin -pHackathon hackathon
```

### Commandes SQL Utiles
```sql
-- Afficher les tables
SHOW TABLES;

-- Structure d'une table
DESCRIBE messages;
DESCRIBE info;
DESCRIBE activities;

-- Voir le contenu d'une table
SELECT * FROM activities;
```

### Gestion du Conteneur

#### Arrêter le conteneur
```bash
docker stop mariadb-server
```

#### Supprimer le conteneur
```bash
docker rm mariadb-server
```

#### Reconstruire et relancer
```bash
docker stop mariadb-server
docker rm mariadb-server
docker build -t mon-mariadb -f Dockerfile-bdd .
docker run -d -p 3307:3306 --name mariadb-server mon-mariadb
```

## Accès via phpMyAdmin (optionnel)

Si vous utilisez phpMyAdmin, voici les paramètres de connexion :
- Serveur : localhost:3307
- Utilisateur : admin
- Mot de passe : Hackathon
- Base de données : hackathon

## Notes Importantes

- Le port utilisé est 3307 sur l'hôte et 3306 dans le conteneur
- Les données sont persistantes grâce au volume Docker
- Le fuseau horaire est configuré sur Europe/Paris
