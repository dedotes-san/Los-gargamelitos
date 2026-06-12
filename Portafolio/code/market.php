<?php
session_start();
include "database.php";
if(!isset($_SESSION["user_id"])) { header("Location: inicio.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mercado Rojo - RPG</title>
    <style>
        :root {
            --neon-red: #ff0000;
            --dark-bg: #050505;
            --card-bg: #121212;
            --border-glow: 0 0 10px rgba(255, 0, 0, 0.4);
        }

        body {
            background: var(--dark-bg);
            color: white;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
        }

        /* Botón para volver al Inicio */
        .header-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto 30px;
            border-bottom: 2px solid var(--neon-red);
            padding-bottom: 15px;
        }

        .btn-back {
            text-decoration: none;
            color: var(--neon-red);
            border: 1px solid var(--neon-red);
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: var(--neon-red);
            color: white;
            box-shadow: 0 0 15px var(--neon-red);
        }

        /* CENTRAR CATEGORÍAS */
        .categories-container {
            display: flex;
            justify-content: center; /* Esto centra los botones */
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .cat-btn {
            background: var(--card-bg);
            color: white;
            border: 1px solid #333;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            text-transform: uppercase;
        }

        .cat-btn:hover, .cat-btn.active {
            border-color: var(--neon-red);
            color: var(--neon-red);
            box-shadow: var(--border-glow);
            transform: translateY(-3px);
        }

        /* GRID DE PRODUCTOS */
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .item-card {
            background: var(--card-bg);
            border: 1px solid #222;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: 0.3s;
        }

        .item-card:hover {
            border-color: var(--neon-red);
            box-shadow: var(--border-glow);
        }

        .item-img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 5px rgba(255,0,0,0.5));
        }

        .price {
            color: var(--neon-red);
            font-weight: bold;
            display: block;
            margin: 10px 0;
        }

        .btn-buy {
            background: var(--neon-red);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-buy:hover {
            box-shadow: 0 0 10px var(--neon-red);
        }
    </style>
</head>
<body>

    <div class="header-nav">
        <h1 style="color: var(--neon-red); margin: 0; text-shadow: 0 0 10px rgba(255,0,0,0.5);">MERCADO NEGRO</h1>
        <a href="dashboard.php" class="btn-back">🏠 VOLVER AL INICIO</a>
    </div>

    <div class="categories-container">
        <button class="cat-btn active">🛡️ Armaduras</button>
        <button class="cat-btn">⚔️ Armas</button>
        <button class="cat-btn">🧪 Pociones</button>
        <button class="cat-btn">💍 Accesorios</button>
    </div>

    <div class="items-grid">
        <div class="item-card">
            <img src="uploads/armadura_roja.png" class="item-img" alt="item">
            <h3>Peto de Sangre</h3>
            <span class="price">500 Oro</span>
            <button class="btn-buy">ADQUIRIR</button>
        </div>
        </div>

</body>
</html>
