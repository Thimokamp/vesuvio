<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>La Souris Clone</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        /* TOP BAR */
        .top-bar {
            background: #222;
            color: #fff;
            display: flex;
            justify-content: center;
            gap: 40px;
            padding: 10px 0;
            font-size: 14px;
        }

        /* HEADER */
        header {
            background: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #e60023;
        }

        .search {
            width: 40%;
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .icons span {
            margin-left: 20px;
            cursor: pointer;
            font-size: 16px;
        }

        /* NAV */
        nav {
            background: #e60023;
            display: flex;
            justify-content: center;
            gap: 40px;
            padding: 12px 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 6px 12px;
            border-radius: 4px;
        }

        nav a.active,
        nav a:hover {
            background: #b4001c;
        }

        /* BANNER */
        .banner img {
            width: 100%;
            display: block;
        }

        /* PHOTO BLOCKS */
        .photos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 40px;
        }

        .photo img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>

    <!-- TOP BAR -->
    <div class="top-bar">
        <span>✔ Laagste prijsgarantie</span>
        <span>✔ Bezorging & service aan huis</span>
        <span>✔ 28 winkels</span>
    </div>

    <!-- HEADER -->
    <header>
        <div class="logo">La Souris</div>
        <input type="text" class="search" placeholder="Zoek je een scooter of onderdeel?" />
        <div class="icons">
            <span>🛒 0</span>
            <span>❔ Klantenservice</span>
        </div>
    </header>

    <!-- NAVIGATIE -->
    <nav>
        <a href="#">Scooters</a>
        <a href="#">Fatbikes</a>
        <a href="#">E-Bikes</a>
        <a class="active" href="#">Deals</a>
        <a href="#">Onderdelen</a>
        <a href="#">Winkels</a>
    </nav>

    <!-- HERO BANNER -->
    <section class="banner">
        <img src="img/banner.jpg" alt="Banner" />
    </section>

    <!-- PHOTO BLOCKS -->
    <section class="photos">
        <div class="photo"><img src="img/scooter-vesuvio.jpg" alt="Scooter Vesuvio" /></div>
        <div class="photo"><img src="img/photo2.jpg" alt="Foto 2" /></div>
        <div class="photo"><img src="img/photo3.jpg" alt="Foto 3" /></div>
    </section>

</body>
</html>

