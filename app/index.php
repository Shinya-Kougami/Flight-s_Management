<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AETHER | Premium Flights</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <nav>
        <a href="index.php" class="logo"><i class="fas fa-plane-departure"></i> AETHER</a>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#destinations">Exclusive Destinations</a></li>
            <li><a href="#fleet">Our Fleet</a></li>
            <li><a href="#vip">VIP Services</a></li>
        </ul>
        
        <div class="nav-auth">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="manage_reservations.php" class="nav-links" style="margin-right: 15px; color: var(--gold);">MIS RESERVAS</a>
                <span style="color: white; margin-right: 15px;">HOLA, <span style="color: var(--gold);"><?= strtoupper(htmlspecialchars($_SESSION['user_name'])) ?></span></span>
                <a href="logout.php" class="btn-login"><i class="fas fa-sign-out-alt"></i> SALIR</a>
            <?php else: ?>
                <a href="login.html" class="btn-login"><i class="far fa-user"></i> LOGIN</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Sección del Buscador -->
    <section id="home" class="hero">
        <h1>TRAVEL THE WORLD, REFINED.</h1>
        <p>Premium Flights: Luxury, Comfort & Exclusivity in Every Destination.</p>
        
        <div class="search-container">
            <form action="search_flights.php" method="GET" class="search-form">
                <div class="input-group">
                    <label><i class="fas fa-plane-departure"></i> Origin</label>
                    <select name="origen" class="select-input">
                        <option value="">Todos los origenes</option>
                        <option value="Ciudad Juarez">Ciudad Juarez</option>
                        <option value="Ciudad de Mexico">Ciudad de Mexico</option>
                        <option value="Monterrey">Monterrey</option>
                        <option value="Guadalajara">Guadalajara</option>
                        <option value="Cancun">Cancun</option>
                        <option value="Nueva York">Nueva York</option>
                        <option value="Paris">Paris</option>
                        <option value="Tokio">Tokio</option>
                        <option value="Londres">Londres</option>
                        <option value="Dubai">Dubai</option>
                        <option value="Roma">Roma</option>
                        <option value="Madrid">Madrid</option>
                        <option value="Sidney">Sidney</option>
                        <option value="Los Angeles">Los Angeles</option>
                        <option value="Buenos Aires">Buenos Aires</option>
                    </select>
                </div>
                
                <div class="input-group">
                    <label><i class="fas fa-plane-arrival"></i> Destination</label>
                    <select name="destino" class="select-input">
                        <option value="">Todos los destinos</option>
                        <option value="Ciudad Juarez">Ciudad Juarez</option>
                        <option value="Ciudad de Mexico">Ciudad de Mexico</option>
                        <option value="Monterrey">Monterrey</option>
                        <option value="Guadalajara">Guadalajara</option>
                        <option value="Cancun">Cancun</option>
                        <option value="Nueva York">Nueva York</option>
                        <option value="Paris">Paris</option>
                        <option value="Tokio">Tokio</option>
                        <option value="Londres">Londres</option>
                        <option value="Dubai">Dubai</option>
                        <option value="Roma">Roma</option>
                        <option value="Madrid">Madrid</option>
                        <option value="Sidney">Sidney</option>
                        <option value="Los Angeles">Los Angeles</option>
                        <option value="Buenos Aires">Buenos Aires</option>
                    </select>
                </div>

                <button type="submit" class="btn-search">Search Flights</button>
            </form>
        </div>
    </section>

    <!-- Nuevas Secciones Informativas -->
    <section id="destinations" class="info-section">
        <h2 class="section-title">Exclusive Destinations</h2>
        <div class="card-grid">
            <div class="card" style="background-image: url('https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=600&q=80');">
                <h3>Tokyo</h3>
                <p>Descubre la magia de Asia.</p>
            </div>
            <div class="card" style="background-image: url('https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?auto=format&fit=crop&w=600&q=80');">
                <h3>Maldives</h3>
                <p>El paraíso te espera.</p>
            </div>
            <div class="card" style="background-image: url('https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=600&q=80');">
                <h3>Dubai</h3>
                <p>Lujo sin precedentes.</p>
            </div>
        </div>
    </section>

    <section id="fleet" class="info-section" style="background-color: #111;">
        <h2 class="section-title">Our Fleet</h2>
        <div class="card-grid">
            <div class="card" style="background-image: url('https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=600&q=80');">
                <h3>Gulfstream G650</h3>
                <p>Velocidad y confort.</p>
            </div>
            <div class="card" style="background-image: url('https://images.unsplash.com/photo-1605281317010-fe5ffe798166?auto=format&fit=crop&w=600&q=80');">
                <h3>Bombardier Global 7500</h3>
                <p>Alcance intercontinental.</p>
            </div>
        </div>
    </section>

    <section id="vip" class="info-section">
        <h2 class="section-title">VIP Services</h2>
        <div class="services-container">
            <div class="service-item"><i class="fas fa-concierge-bell"></i><p>24/7 Concierge</p></div>
            <div class="service-item"><i class="fas fa-utensils"></i><p>Gourmet Dining</p></div>
            <div class="service-item"><i class="fas fa-car"></i><p>Chauffeur Transfers</p></div>
            <div class="service-item"><i class="fas fa-glass-cheers"></i><p>Exclusive Lounges</p></div>
        </div>
    </section>

</body>
</html>