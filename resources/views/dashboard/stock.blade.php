<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard - Stock</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        />
        <style>
            :root {
                --primary-color: #5BCC90FF;
                --secondary-color: #276749;
                --light-bg: #f7fafc;
                --sidebar-width: 280px;
                --sidebar-collapsed-width: 70px;
                --navbar-height: 70px;
            }

            body {
                font-family: "Poppins", sans-serif;
                background-color: var(--light-bg);
                display: flex;
                min-height: 100vh;
                margin: 0;
                padding-top: var(--navbar-height);
            }

            a {
                text-decoration: none;
                color: inherit;
            }

            a:hover,
            a:focus {
                color: inherit;
            }

            .top-navbar {
                height: var(--navbar-height);
                background-color: white;
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                z-index: 1030;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 2rem;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar {
                width: var(--sidebar-width);
                background-color: white;
                color: #2d3748;
                padding-top: 1.5rem;
                transition: all 0.3s ease;
                position: fixed;
                height: calc(100vh - var(--navbar-height));
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
                z-index: 1020;
                top: var(--navbar-height);
                display: flex;
                flex-direction: column;
            }

            .sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
            }

            .sidebar .logo {
                text-align: center;
                margin-bottom: 1rem;
                padding: 0 1rem;
                flex-shrink: 0;
            }

            .sidebar .logo h4 {
                color: var(--primary-color);
                font-weight: 600;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            .sidebar .logo i {
                font-size: 1.5rem;
            }

            .sidebar ul {
                list-style: none;
                padding: 0;
                margin: 0;
                flex-grow: 1;
            }

            .sidebar ul li {
                padding: 0.8rem 1.5rem;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 12px;
                transition: all 0.3s ease;
                margin: 4px 8px;
                border-radius: 8px;
            }

            .sidebar ul li i {
                font-size: 1.2rem;
                width: 24px;
                text-align: center;
            }

            .sidebar ul li:hover {
                background-color: var(--primary-color);
                color: white;
            }

            .sidebar.collapsed .logo h4 span,
            .sidebar.collapsed ul li span {
                display: none;
            }

            .collapse-toggle {
                position: relative;
                margin: 20px auto;
                cursor: pointer;
                background-color: var(--primary-color);
                color: white;
                padding: 8px;
                border-radius: 50%;
                transition: all 0.3s ease;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .collapse-toggle:hover {
                background-color: var(--secondary-color);
            }

            .sidebar.collapsed .collapse-toggle {
                transform: rotate(180deg);
            }

            .content {
                flex-grow: 1;
                padding: 2rem;
                margin-left: var(--sidebar-width);
                transition: all 0.3s ease;
            }

            .content.collapsed {
                margin-left: var(--sidebar-collapsed-width);
            }

            .search-bar {
                position: relative;
                max-width: 400px;
            }

            .search-bar i {
                position: absolute;
                left: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #A6D8C1FF;
            }

            .search-bar input {
                padding-left: 40px;
                border-radius: 20px;
                border: 1px solid #e2e8f0;
                background-color: #f7fafc;
            }

            .user-info {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .user-info .avatar {
                width: 40px;
                height: 40px;
                background-color: var(--primary-color);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                cursor: pointer;
            }

            .user-info span {
                color: #2d3748;
                font-weight: 500;
            }

            .dropdown-menu {
                border: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                min-width: 120px;
            }

            .dropdown-item {
                padding: 8px 16px;
                color: #2d3748;
            }

            .dropdown-item:hover {
                background-color: #f7fafc;
                color: var(--primary-color);
            }

            .welcome-section {
                background-color: white;
                border-radius: 12px;
                padding: 2rem;
                margin-bottom: 2rem;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }

            .welcome-section h2 {
                color: #2d3748;
                font-weight: 600;
                margin-bottom: 1rem;
            }

            .welcome-section p {
                color: #718096;
                margin-bottom: 0;
            }

            /* Styles pour le tableau des produits */
            .filter-section {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .filter-group {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .filter-group label {
                font-weight: 500;
                color: #2d3748;
                white-space: nowrap;
            }

            .filter-group select {
                padding: 0.5rem;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                background-color: #f7fafc;
                font-size: 1rem;
                color: #2d3748;
                transition: border-color 0.3s ease;
            }

            .filter-group select:focus {
                border-color: var(--primary-color);
                outline: none;
            }

            #sort-button {
                background-color: var(--primary-color);
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.3s ease;
                white-space: nowrap;
            }

            #sort-button:hover {
                background-color: var(--secondary-color);
            }

            .product-table {
                width: 100%;
                border-collapse: collapse;
                background-color: white;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }

            .product-table th,
            .product-table td {
                padding: 1rem;
                text-align: left;
                border-bottom: 1px solid #e2e8f0;

            }

            .product-table th {
                background-color: var(--primary-color);
                color: white;
                font-weight: 600;
            }

            .product-table tbody tr:hover {
                background-color: #e2f3e8;
                transform: scale(1.02);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .product-table tbody tr:last-child td {
                border-bottom: none;
            }

            .product-table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .product-table td {
                margin-right: 8px;
                /* color: var(--primary-color); */
                color: black; /* Texte en noir */

            }
            .i{
                color: var(--color-green-50)
            }

            .action-buttons {
                display: flex;
                gap: 8px;
            }

            .action-buttons button {
                padding: 0.5rem;
                border: none;
                border-radius: 8px;
                background-color: var(--primary-color);
                color: white;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .action-buttons button:hover {
                background-color: var(--secondary-color);
            }

            @media (max-width: 768px) {
                .sidebar {
                    width: var(--sidebar-collapsed-width);
                    transform: translateX(-100%);
                }

                .sidebar.collapsed {
                    transform: translateX(0);
                }

                .content {
                    margin-left: 0;
                }

                .content.collapsed {
                    margin-left: var(--sidebar-collapsed-width);
                }
            }

            #loading-screen {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.9);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            #loading-video {
                width: 200px;
                height: 200px;
            }

            #main-content {
                display: none;
            }
        </style>
    </head>
    <body>

    <div id="loading-screen">
            <video id="loading-video" autoplay loop muted>
                <source src="{{ asset('loading.mp4') }}" type="video/mp4" />
            </video>
        </div>
        <nav class="top-navbar">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    placeholder="Rechercher..."
                    class="form-control"
                />
            </div>
            <div class="user-info">
                <span>John Doe</span>
                <div class="dropdown">
                    <div
                        class="avatar"
                        id="userDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="fas fa-user"></i>
                    </div>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#"
                                ><i class="fas fa-user-cog me-2"></i>Profil</a
                            >
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"
                                ><i class="fas fa-cog me-2"></i>Paramètres</a
                            >
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <a class="dropdown-item" href="#"
                                ><i class="fas fa-sign-out-alt me-2"></i
                                >Déconnexion</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="sidebar" id="sidebar">
            <div class="logo">
                <h4>
                    <i class="fas fa-leaf"></i>
                    <span>Agro Stock</span>
                </h4>
                <hr />
            </div>
            <ul>
                <li>
                    <a href="/dashboard">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="/produit">
                        <i class="fas fa-box"></i>
                        <span>Produits</span>
                    </a>
                </li>
                <li>
                    <a href="/stockage">
                        <i class="fas fa-warehouse"></i>
                        <span>Stock</span>
                    </a>
                </li>
                <li>
                    <a href="/transaction">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Commandes</span>
                    </a>
                </li>
                <li>
                    <a href="/statistique">
                        <i class="fas fa-chart-bar"></i>
                        <span>Rapports</span>
                    </a>
                </li>
            </ul>
            <div class="collapse-toggle" id="collapseToggle">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>

        <div class="content" id="content">
            <div class="welcome-section">
                <h2>Produits disponibles</h2>
                <div class="filter-section">
                    <div class="filter-group">
                        <label for="sort-by">Trier par :</label>
                        <select id="sort-by" class="form-control">
                            <option value="type">Selectionner</option>
                            <option value="type">Type</option>
                            <option value="status">Statut</option>
                        </select>
                    </div>
                    <button id="sort-button" class="btn btn-primary">
                        <i class="fas fa-sort"></i> Trier
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Nom du produit</th>
                            <th>Type</th>
                            <th>Quantité (kg)</th>
                            <th>Date de récolte</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        <!-- Les lignes des produits seront ajoutées ici dynamiquement -->
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const collapseToggle = document.getElementById("collapseToggle");

            collapseToggle.addEventListener("click", () => {
                sidebar.classList.toggle("collapsed");
                content.classList.toggle("collapsed");
            });

            // Données de test
            const products = [
                {
                    name: "Tomates",
                    type: "Légumes",
                    quantity: 150.5,
                    harvestDate: "2023-10-01",
                    status: "Stocké",
                },
                {
                    name: "Bananes",
                    type: "Fruits",
                    quantity: 200.0,
                    harvestDate: "2023-09-25",
                    status: "Vendu",
                },
                {
                    name: "Riz",
                    type: "Céréales",
                    quantity: 500.0,
                    harvestDate: "2023-10-05",
                    status: "Distribué",
                },
                {
                    name: "Pommes",
                    type: "Fruits",
                    quantity: 300.0,
                    harvestDate: "2023-09-30",
                    status: "Stocké",
                },
            ];

            function renderProducts(products) {
                const tbody = document.getElementById("product-table-body");
                tbody.innerHTML = "";

                products.forEach((product) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td><i class=""></i>${product.name}</td>
                        <td><i class=""></i>${product.type}</td>
                        <td>${product.quantity}</td>
                        <td>${product.harvestDate}</td>
                        <td>${product.status}</td>
                        <td>
                            <div class="action-buttons">
                                <button onclick="increaseQuantity('${product.name}')">
                                    <i class="fas fa-plus caret-violet-50"></i>
                                </button>
                                <button onclick="decreaseQuantity('${product.name}')">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }

            // Trier les produits
            function sortProducts(by) {
                const sortedProducts = [...products].sort((a, b) => {
                    if (a[by] < b[by]) return -1;
                    if (a[by] > b[by]) return 1;
                    return 0;
                });
                renderProducts(sortedProducts);
            }

            // Augmenter la quantité
            function increaseQuantity(productName) {
                const product = products.find((p) => p.name === productName);
                if (product) {
                    product.quantity += 10;
                    renderProducts(products);
                }
            }

            // Diminuer la quantité
            function decreaseQuantity(productName) {
                const product = products.find((p) => p.name === productName);
                if (product && product.quantity >= 10) {
                    product.quantity -= 10;
                    renderProducts(products);
                }
            }

            // Gérer le clic sur le bouton de tri
            document.getElementById("sort-button").addEventListener("click", () => {
                const sortBy = document.getElementById("sort-by").value;
                sortProducts(sortBy);
            });

            // Afficher les produits au chargement de la page
            document.addEventListener("DOMContentLoaded", () => {
                renderProducts(products);
            });
        </script>

<script>
            window.addEventListener("load", function () {
                const loadingScreen = document.getElementById("loading-screen");
                const mainContent = document.getElementById("main-content");

                setTimeout(() => {
                    loadingScreen.style.display = "none";
                    mainContent.style.display = "block";
                }, 2000);
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
