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


INSERT INTO Flights (origen, destino, fecha_salida, precio) VALUES
('Ciudad Juarez', 'Ciudad de Mexico', '2026-10-15 10:00:00', 1500.00),
('Ciudad Juarez', 'Monterrey', '2026-10-16 14:30:00', 1200.00),
('Guadalajara', 'Cancun', '2026-10-20 08:15:00', 2500.00),
('Ciudad de Mexico', 'Nueva York', '2026-11-01 09:00:00', 4500.00),
('Cancun', 'Paris', '2026-11-02 18:30:00', 12500.00),
('Monterrey', 'Tokio', '2026-11-05 23:15:00', 18000.00),
('Ciudad de Mexico', 'Londres', '2026-11-10 14:00:00', 13200.00),
('Nueva York', 'Dubai', '2026-11-12 20:45:00', 21000.00),
('Paris', 'Roma', '2026-11-15 08:20:00', 3500.00),
('Madrid', 'Paris', '2026-11-18 10:30:00', 2800.00),
('Sidney', 'Los Angeles', '2026-11-20 06:15:00', 16500.00),
('Los Angeles', 'Tokio', '2026-11-22 11:00:00', 14000.00),
('Buenos Aires', 'Madrid', '2026-11-25 21:00:00', 15500.00),
('Dubai', 'Sidney', '2026-11-28 02:30:00', 19800.00),
('Roma', 'Londres', '2026-12-01 13:45:00', 4200.00),
('Ciudad de Mexico', 'Buenos Aires', '2026-12-05 22:10:00', 9500.00),
('Guadalajara', 'Los Angeles', '2026-12-10 07:00:00', 5200.00),
('Tokio', 'Sidney', '2026-12-15 19:30:00', 17000.00);
