<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-svg">
    <link rel="stylesheet" href="css/style.css">
    <title>Catalogue de Jeux</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2ed573 0%, #0c310b 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h1 {
            color: white;
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            font-weight: 300;
        }

        .filters {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            color: white;
            font-weight: 500;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        select,
        input {
            padding: 12px 16px;
            border: none;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        select:focus,
        input:focus {
            outline: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .add-game-btn {
            background: linear-gradient(45deg, #2ed573, #26d0ce);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(46, 213, 115, 0.4);
            transition: all 0.3s ease;
            margin: 20px auto;
            display: block;
        }

        .add-game-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(46, 213, 115, 0.6);
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .game-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .game-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .game-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .genre-tag {
            background: linear-gradient(45deg, #2ed573, #26d0ce);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .year-badge {
            background: rgba(46, 213, 115, 0.2);
            color: #1dd1a1;
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .game-description {
            color: #7f8c8d;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .game-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            flex: 1;
            text-align: center;
        }

        .btn-edit {
            background: #26d0ce;
            color: white;
        }

        .btn-edit:hover {
            background: #1dd1a1;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #ff4757;
            color: white;
        }

        .btn-delete:hover {
            background: #ff3742;
            transform: translateY(-2px);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal h2 {
            margin-bottom: 20px;
            color: #2c3e50;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #34495e;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ecf0f1;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2ed573;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #2ed573, #26d0ce);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 213, 115, 0.4);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        .no-games {
            text-align: center;
            color: white;
            font-size: 1.2rem;
            margin-top: 50px;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .filters {
                flex-direction: column;
                align-items: center;
            }

            .games-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                margin: 10% auto;
                width: 95%;
            }
        }
    </style>
</head>

<body id="content"><!-- NAVBAR -->
    <nav class="navbar">
        <div class="hamburger-menu" id="hamburgerMenu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="http://localhost:8001/home.php">home</a></li>
            <li><a href="http://localhost:8001/jeux.php">Jeux</a></li>
            <li><a href="http://localhost:8001/index.php">Index</a></li>
            <li><a href="http://localhost:8001/liste.php">Liste de Jeux</a></li>
            <li><a href="http://localhost:8001/jeu.php">Jeu</a></li>
            <li><a href="http://localhost:8001/add.php">Ajout jeu</a></li>
            <li><a href="http://localhost:8001/modifier.php">Modifier jeu</a></li>
            <li><a href="http://localhost:8001/home.php">Back to menu</a></li>
        </ul>
    </nav>

    <div class="container">
        <header>
            <h1>Catalogue de Jeux</h1>
            <p class="subtitle">Découvrez et gérez votre collection de jeux vidéo</p>
        </header>

        <div class="filters">
            <div class="filter-group">
                <label for="genreFilter">Genre:</label>
                <select id="genreFilter">
                    <option value="">Tous les genres</option>
                    <option value="Action">Action</option>
                    <option value="Aventure">Aventure</option>
                    <option value="RPG">RPG</option>
                    <option value="Strategie">Stratégie</option>
                    <option value="Sport">Sport</option>
                    <option value="Course">Course</option>
                    <option value="Simulation">Simulation</option>
                    <option value="Puzzle">Puzzle</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="yearFilter">Année:</label>
                <select id="yearFilter">
                    <option value="">Toutes les années</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="searchFilter">Rechercher:</label>
                <input type="text" id="searchFilter" placeholder="Nom du jeu...">
            </div>
        </div>

        <button class="add-game-btn" onclick="openModal()">+ Ajouter un jeu</button>

        <div class="games-grid" id="gamesGrid">
            <!-- Les jeux seront affichés ici -->
        </div>

        <!-- Modal pour ajouter/modifier un jeu -->
        <div id="gameModal" class="modal">
            <div class="modal-content">
                <h2 id="modalTitle">Ajouter un jeu</h2>
                <form id="gameForm">
                    <div class="form-group">
                        <label for="gameName">Nom du jeu:</label>
                        <input type="text" id="gameName" required>
                    </div>
                    <div class="form-group">
                        <label for="gameGenre">Genre:</label>
                        <select id="gameGenre" required>
                            <option value="">Sélectionner un genre</option>
                            <option value="Action">Action</option>
                            <option value="Aventure">Aventure</option>
                            <option value="RPG">RPG</option>
                            <option value="Strategie">Stratégie</option>
                            <option value="Sport">Sport</option>
                            <option value="Course">Course</option>
                            <option value="Simulation">Simulation</option>
                            <option value="Puzzle">Puzzle</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gameYear">Année de sortie:</label>
                        <input type="number" id="gameYear" min="1980" max="2025" required>
                    </div>
                    <div class="form-group">
                        <label for="gameDescription">Description:</label>
                        <textarea id="gameDescription" placeholder="Description du jeu..."></textarea>
                    </div>
                </form>
                <div class="modal-actions">
                    <button type="button" class="btn-primary" onclick="saveGame()">Enregistrer</button>
                    <button type="button" class="btn-secondary" onclick="closeModal()">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let games = [
            {
                id: 1,
                name: "The Legend of Zelda: Breath of the Wild",
                genre: "Aventure",
                year: 2017,
                description: "Un jeu d'aventure en monde ouvert révolutionnaire qui redéfinit la série Zelda."
            },
            {
                id: 2,
                name: "God of War",
                genre: "Action",
                year: 2018,
                description: "L'épopée de Kratos et son fils Atreus dans la mythologie nordique."
            },
            {
                id: 3,
                name: "The Witcher 3: Wild Hunt",
                genre: "RPG",
                year: 2015,
                description: "Un RPG épique suivant les aventures de Geralt de Riv."
            },
            {
                id: 4,
                name: "Civilization VI",
                genre: "Strategie",
                year: 2016,
                description: "Construisez un empire qui résistera à l'épreuve du temps."
            },
            {
                id: 5,
                name: "FIFA 23",
                genre: "Sport",
                year: 2022,
                description: "Le jeu de football le plus réaliste avec les dernières équipes et joueurs."
            }
        ];

        let editingGameId = null;

        function populateYearFilter() {
            const yearFilter = document.getElementById('yearFilter');
            const years = [...new Set(games.map(game => game.year))].sort((a, b) => b - a);

            yearFilter.innerHTML = '<option value="">Toutes les années</option>';
            years.forEach(year => {
                yearFilter.innerHTML += `<option value="${year}">${year}</option>`;
            });
        }

        function displayGames(gamesToShow = games) {
            const gamesGrid = document.getElementById('gamesGrid');

            if (gamesToShow.length === 0) {
                gamesGrid.innerHTML = '<div class="no-games">Aucun jeu trouvé 🎮</div>';
                return;
            }

            gamesGrid.innerHTML = gamesToShow.map(game => `
                <div class="game-card">
                    <div class="game-title">${game.name}</div>
                    <div class="game-info">
                        <span class="genre-tag">${game.genre}</span>
                        <span class="year-badge">${game.year}</span>
                    </div>
                    <div class="game-description">${game.description || 'Pas de description disponible.'}</div>
                    <div class="game-actions">
                        <button class="btn btn-edit" onclick="editGame(${game.id})">Modifier</button>
                        <button class="btn btn-delete" onclick="deleteGame(${game.id})">Supprimer</button>
                    </div>
                </div>
            `).join('');
        }

        function filterGames() {
            const genreFilter = document.getElementById('genreFilter').value;
            const yearFilter = document.getElementById('yearFilter').value;
            const searchFilter = document.getElementById('searchFilter').value.toLowerCase();

            let filteredGames = games.filter(game => {
                const matchesGenre = !genreFilter || game.genre === genreFilter;
                const matchesYear = !yearFilter || game.year.toString() === yearFilter;
                const matchesSearch = !searchFilter || game.name.toLowerCase().includes(searchFilter);

                return matchesGenre && matchesYear && matchesSearch;
            });

            displayGames(filteredGames);
        }

        function openModal(gameId = null) {
            const modal = document.getElementById('gameModal');
            const modalTitle = document.getElementById('modalTitle');

            if (gameId) {
                const game = games.find(g => g.id === gameId);
                modalTitle.textContent = 'Modifier le jeu';
                document.getElementById('gameName').value = game.name;
                document.getElementById('gameGenre').value = game.genre;
                document.getElementById('gameYear').value = game.year;
                document.getElementById('gameDescription').value = game.description || '';
                editingGameId = gameId;
            } else {
                modalTitle.textContent = 'Ajouter un jeu';
                document.getElementById('gameForm').reset();
                editingGameId = null;
            }

            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('gameModal').style.display = 'none';
            editingGameId = null;
        }

        function saveGame() {
            const name = document.getElementById('gameName').value;
            const genre = document.getElementById('gameGenre').value;
            const year = parseInt(document.getElementById('gameYear').value);
            const description = document.getElementById('gameDescription').value;

            if (!name || !genre || !year) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }

            if (editingGameId) {
                const gameIndex = games.findIndex(g => g.id === editingGameId);
                games[gameIndex] = { id: editingGameId, name, genre, year, description };
            } else {
                const newId = Math.max(...games.map(g => g.id)) + 1;
                games.push({ id: newId, name, genre, year, description });
            }

            populateYearFilter();
            displayGames();
            closeModal();
        }

        function editGame(gameId) {
            openModal(gameId);
        }

        function deleteGame(gameId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce jeu ?')) {
                games = games.filter(game => game.id !== gameId);
                populateYearFilter();
                filterGames();
            }
        }

        // Event listeners
        document.getElementById('genreFilter').addEventListener('change', filterGames);
        document.getElementById('yearFilter').addEventListener('change', filterGames);
        document.getElementById('searchFilter').addEventListener('input', filterGames);

        // Fermer le modal en cliquant à l'extérieur
        window.onclick = function (event) {
            const modal = document.getElementById('gameModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Initialisation
        populateYearFilter();
        displayGames();
    </script>

    <!-- * FOOTER -->
    <footer>
        <div class="droits">
            <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_jeux_Vidéos |
                @onlineformapro |
                Mentions légales</h6>
        </div>
    </footer>
    <br />

    <!-- back-to-top section -------------->
    <a href="#content" class="back-to-top">
        <span>top</span>
        <!-- aria-hidden="true" opur masquer l'icon de l'écran -->
        <svg width="10" height="10" viewbox=" 0 0 24 24" aria-hidden="true">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
        </svg>

        <script src="script.js"></script>

</body>

</html>