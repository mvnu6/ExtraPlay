# Application Todo List

Une application simple de gestion de tâches construite avec PHP et PostgreSQL.

## 🚀 Fonctionnalités

- Connexion/Inscription
- Lecture, Création, Suppression, Modification d’avis
- 3 jeux fonctionnels
- Persistance des données en base PostgreSQL

## 🛠 Prérequis

- Docker
- Docker Compose
- Git
- Navigateur web pour pgAdmin

## 📦 Installation

1. Clonez le repository :

```bash
git clone [url-du-repo]
cd [nom-du-dossier]
```

2. Lancez l'application avec Docker Compose :

```bash
docker compose up --build
```

## 🌐 Utilisation

Accédez à l'application via votre navigateur : [http://localhost:8080](http://localhost:8080)

## 📊 Accès à pgAdmin

pgAdmin est accessible via votre navigateur : [http://localhost:8081](http://localhost:8081)

## 📁 Structure du projet

```
projet/
├── public/                  # Fichiers publics
    ├── images/
    ├── js/
        └── app.js
│   ├── index.php        # Point d'entrée
│   ├── .htaccess
│   └── css/
│       └── style.css    # Styles CSS
├── rapport/             # Rapports
├── src/                 # Code source
│   ├── Controllers/     # Contrôleurs
│   ├── Models/         # Modèles
│   └── Database/       # Configuration BD
├── templates/           # Templates
│   ├── games/           # Templates pour les jeux
        └── quiz.php
        └── memo.php
        └── motus.php
    ├── partials/
        └── footer.php
        └── header.php
    ├── reviews/
        └── create.php    # Formulaire de création de review
        └── edit.php      # Formulaire d'édition de review
        └── index.php     # Liste des reviews
    ├── construction.php  # Template pour les pages en construction
    ├── games.php       # affichage des jeux
    ├── home.php        # page d'accueil
    ├── register.php    # inscription
    └── login.php       # connexion
├── composer.json        # Dépendances PHP
├── Dockerfile          # Configuration Docker
├── docker compose.yml  # Configuration Docker Compose
└── init.sql           # Initialisation BD
```

## 🔧 Configuration

### Variables d'environnement (docker compose.yml)

```yaml
# PostgreSQL
 environment:
      DB_HOST: db
      DB_PORT: 5432
      DB_NAME: postgres
      DB_USER: postgres
      DB_PASSWORD: password

  db:
    image: postgres:15
    volumes:
      - postgres_data:/var/lib/postgresql/data
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql
    environment:
      POSTGRES_DB: Extraplay
      POSTGRES_USER: postgres
      POSTGRES_PASSWORD: password
# pgAdmin
environment:
  PGADMIN_DEFAULT_EMAIL: admin@admin.com
  PGADMIN_DEFAULT_PASSWORD: admin
```

## 📝 Base de données

La base de données PostgreSQL est initialisée avec la structure suivante :

```sql
-- Supprimer la table utilisateurs si elle existe
DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE IF NOT EXISTS users (
    id_user SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Supprimer la table category si elle existe
DROP TABLE IF EXISTS category CASCADE;
CREATE TABLE IF NOT EXISTS category (
    id_category SERIAL PRIMARY KEY,
    name_category VARCHAR(50) NOT NULL
);

-- Supprimer la table Games si elle existe
DROP TABLE IF EXISTS games CASCADE;
CREATE TABLE IF NOT EXISTS Games (
    id_game SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    id_category INT,
    image_path VARCHAR(255) NOT NULL,
    game_path VARCHAR(255),
    FOREIGN KEY (id_category) REFERENCES category(id_category) ON DELETE CASCADE
);

-- Supprimer la table avis si elle existe
DROP TABLE IF EXISTS review CASCADE;
CREATE TABLE IF NOT EXISTS review (
    id_review SERIAL PRIMARY KEY,
    id_user INT,
    id_game INT,
    note INT CHECK (note BETWEEN 1 AND 5),
    comment TEXT,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_game) REFERENCES Games(id_game) ON DELETE CASCADE
);

INSERT INTO category (name_category) VALUES
('Action'),
('Adventure'),
('Puzzle');

INSERT INTO Games (name, description, id_category, image_path, game_path)
VALUES
('Motus', 'A fun game', 1, '/images/motus1.png', '/games/motus'),
('Quiz', 'An adventure game', 2, '/images/quiz1.jpg', '/games/quiz'),
('Memory Game', 'An adventure game', 2, '/images/cardmemory3.png', '/games/memory')
```

## 🔨 Développement

Pour le développement, les volumes Docker sont configurés pour refléter les changements en temps réel :

```yaml
volumes:
  - ./public:/var/www/html/public
  - ./src:/var/www/html/src
  - ./templates:/var/www/html/templates
```

## 🚀 Commandes utiles

```bash
# Démarrer l'application
docker compose up

# Démarrer l'application en arrière-plan
docker compose up -d

# Arrêter l'application
docker compose down

# Reconstruire les containers
docker compose up --build

# Voir les logs
docker compose logs

# Accéder au container PHP
docker compose exec php bash

# Accéder à la base de données
docker compose exec db psql -U postgres -d postgres

# Accéder à pgAdmin
http://localhost:8081

# Redémarrer pgAdmin si nécessaire
docker compose restart pgadmin
```

### Configuration initiale de pgAdmin

1. Connectez-vous avec :

   - Email: admin@admin.com
   - Mot de passe: admin

2. Pour ajouter le serveur PostgreSQL :

   - Clic droit sur "Servers" → "Register" → "Server"
   - Dans l'onglet "General" :
     - Name: Extraplay
   - Dans l'onglet "Connection" :
     - Host name/address: db
     - Port: 5432
     - Maintenance database: extraplay
     - Username: postgres
     - Password: password

3. Vous pouvez maintenant :
   - Visualiser la structure de la base de données
   - Exécuter des requêtes SQL
   - Gérer les tables et les données
   - Exporter/Importer des données

## 🔨 Services Docker

L'application utilise trois services Docker :

1. **PHP/Apache** : Serveur web et application PHP
2. **PostgreSQL** : Base de données
3. **pgAdmin** : Interface d'administration de la base de données

## 🛡 Sécurité

- Échappement des données HTML
- Requêtes préparées pour la base de données
- Validation des entrées utilisateur

## 🤝 Contribution

1. Fork le projet
2. Créez votre branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 📄 Licence

Distributed under the MIT License. See `LICENSE` for more information.
