# Starter Kit Docker PHP-PostgreSQL

Ce starter kit vous permet de démarrer rapidement un projet PHP avec une base de données PostgreSQL et pgAdmin, le tout conteneurisé avec Docker.
_______________________________________________________________________________

## Prérequis

- **Docker** & **Docker Compose**
  - Pour Windows/Mac : [Docker Desktop](https://www.docker.com/products/docker-desktop/)
  - Vérifiez l'installation avec :

    ```bash
    docker --version
    docker compose version
    ```
_______________________________________________________________________________

## Structure du projet

```
.
├── docker-compose.yml    # Configuration des services Docker
├── Dockerfile           # Configuration de l'image PHP
├── data/               # Dossier contenant les fichiers SQL
│   └── data.sql       # Fichier SQL pour initialiser la base de données
└── php/                # Dossier contenant les fichiers PHP
    └── index.php      # Point d'entrée de l'application
```

## Configuration

Le projet inclut trois services Docker :

1. **PHP (Apache)** : PHP 8.3 avec Apache

   - Accessible sur `http://localhost:8000`
   - Le contenu du dossier `php/` est synchronisé avec le container

2. **PostgreSQL** : Base de données PostgreSQL

   - Port : 5432
   - Base de données : project_name
   - Utilisateur : test
   - Mot de passe : test
   - Root password : root

3. **pgAdmin** : Interface d'administration PostgreSQL
   - Accessible sur `http://localhost:8082`
   - Email : <admin@admin.com>
   - Mot de passe : admin
_______________________________________________________________________________

## Démarrage rapide
_______________________________________________________________________________

### Première utilisation

1. Clonez ce dépôt :

   ```bash
   git clone [URL_DU_REPO]
   cd [NOM_DU_DOSSIER]
   ```

2. Si vous souhaitez initialiser la base de données, ajoutez vos requêtes SQL dans le fichier `data/data.sql`

3. Construisez l'image PHP avec les extensions nécessaires :

   ```bash
   docker compose build
   ```

4. Lancez les containers :

   ```bash
   docker compose up -d
   ```

5. Accédez à votre application :
   - Application PHP : <http://localhost:8000>
   - pgAdmin : <http://localhost:8080>
_______________________________________________________________________________

### Utilisations suivantes

1. Démarrer les containers :

   ```bash
   docker compose up -d
   ```

2. Accédez à votre application comme d'habitude :

   - Application PHP : <http://localhost:8000>
   - pgAdmin : <http://localhost:8082>

3. Pour arrêter les containers :

   ```bash
   docker compose down
   ```

> **Note** : Si vous modifiez le fichier `data.sql` après la première utilisation et que vous souhaitez réinitialiser la base de données, vous devrez supprimer les volumes Docker. Voici la commande :
>
> ```bash
> docker compose down -v  # Arrête les containers et supprime les volumes
> docker compose up -d    # Redémarre les containers et réinitialise la base de données
> ```
_______________________________________________________________________________

## Base de données

- La base de données `projet` est automatiquement créée au démarrage des containers
- Un fichier `data.sql` vide est fourni dans le dossier `data/`. Vous pouvez le remplacer par votre propre fichier SQL contenant vos tables et données. Ce fichier sera automatiquement exécuté lors de la première initialisation de la base de données
- Cette fonctionnalité est configurée dans le `docker-compose.yml` grâce à la ligne :

  ```yaml
  volumes:
    - './data:/docker-entrypoint-initdb.d'
  ```

- Pour initialiser votre base de données :
  1. Copiez vos requêtes SQL dans le fichier `data/data.sql`
  2. Si les containers sont déjà en cours d'exécution, relancez-les avec :

     ```bash
     docker compose down
     docker compose up -d
     ```

- Les données sont persistantes entre les redémarrages des containers, donc le script `data.sql` ne sera exécuté qu'à la première initialisation
_______________________________________________________________________________

## Développement

1. Placez vos fichiers PHP dans le dossier `src/`
2. Les modifications sont automatiquement prises en compte grâce au montage du volume
3. Pour les modifications de la base de données :
   - Utilisez pgAdmin (<http://localhost:8082>)
   - Ou modifiez directement le fichier `data/data.sql`
_______________________________________________________________________________

## Commandes utiles

```bash
# Démarrer les containers
docker compose up -d

# Arrêter les containers
docker compose down
```
_______________________________________________________________________________

## Extensions PHP installées

- pgsql
- pdo
- pdo_pgsql
_______________________________________________________________________________

## Personnalisation

- Modifier les ports dans `docker-compose.yml` si nécessaire
- Ajouter des extensions PHP dans le `Dockerfile`
- Modifier les credentials de la base de données dans `docker-compose.yml`
_______________________________________________________________________________

## Netlify 

- Status du badge de déploiement : 
[![Netlify Status](https://api.netlify.com/api/v1/badges/17baecc5-35cc-4688-bb62-826b38e8492a/deploy-status)](https://app.netlify.com/projects/fabulous-platypus-fdb4a3/deploys)
