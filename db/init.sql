-- Tabla de Usuarios
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabla de Vuelos
CREATE TABLE Flights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origen VARCHAR(50) NOT NULL,
    destino VARCHAR(50) NOT NULL,
    fecha_salida DATETIME NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Tabla de Reservas
CREATE TABLE Reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    flight_id INT,
    fecha_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (flight_id) REFERENCES Flights(id)
);

-- Insertar algunos vuelos de prueba
INSERT INTO Flights (origen, destino, fecha_salida, precio) VALUES
('Ciudad Juárez', 'Ciudad de México', '2026-10-15 10:00:00', 1500.00),
('Ciudad Juárez', 'Monterrey', '2026-10-16 14:30:00', 1200.00),
('Guadalajara', 'Cancún', '2026-10-20 08:15:00', 2500.00);