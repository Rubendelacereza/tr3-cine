-- Insertar películas en la tabla peliculas
INSERT INTO peliculas (titulo, imagen_url, duracion, clasificacion, categoria, created_at, updated_at)
VALUES
  ('DUNE: PART2', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRNgijMfbbgqI-PDhoPa4bo64fp90yrboBdgMHbcW9fg05sv4Zx', 160, 5, 'Ciencia Ficción', NOW(), NOW()),
  ('Cualquiera menos tu', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTFrvZI9Xa_HmjtekEl6EZuwA9UmjLz6xkaIdH4W1E975FV1pxR', 103, 4, 'Romance', NOW(), NOW()),
  ('WONKA', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRhr0dEsdB5uqgfEXySWcV5lbDeym0RjBB9LOvCZ-83jQD6NO2Y', 116, 2, 'Ciencia Ficción', NOW(), NOW()),
  ('MIGRACION', 'https://m.media-amazon.com/images/M/MV5BNDY4NTJmNGMtZTU2ZS00MjdkLWIwYTgtNWU5ZWMzZDMwODkyXkEyXkFqcGdeQXVyMTUzMTg2ODkz._V1_FMjpg_UX1000_.jpg', 82, 3, 'Drama', NOW(), NOW()),
  ('Sociedad de la nieve', 'https://images.ctfassets.net/4cd45et68cgf/4HXqHLksKw8jSBeULjWCk0/3829fce17bebf107dace4325f724e4d4/es-ES_sots_main_theatrical_vertical_27x40_cmyk_pre_1.jpg?w=1200', 144, 5, 'Ciencia Ficción', NOW(), NOW()),
  ('Spider-Man: No Way Home', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQExSKCIV-7phwcX9R-yfDSGoA8cFPbYjlH419RF6CHj6LITdrX', 160, 5, 'Acción', NOW(), NOW()),
  ('Avatar 2 (Avatar: The Way of Water)', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSGQUTaBL19fLf8caYxcyNt0mYl9HgpiKPAaGgQxCuz3ZTvAWVI', 103, 4, 'Ciencia Ficción', NOW(), NOW()),
  ('La Montaña Entre Nosotros', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJCpyt8YT9k5PeRDjXRvT5haxxIEAmepd52NcwMy6_uR66Cxf3', 116, 2, 'Romance', NOW(), NOW()),
  ('El Lobo de Wall Street', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTrqI60p3I82Q67Wh6HEyDC24Orl0qFzSWNX7EH6niO1SnvBsPl', 82, 3, 'Drama', NOW(), NOW()),
  ('El renacido', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQyHpNGDe96zaNg7UQj4V-uCXs298s-if7UXI_F4DLS8a5kCafS', 144, 5, 'Drama', NOW(), NOW()),
  ('Interestelar', 'https://t0.gstatic.com/licensed-image?q=tbn:ANd9GcQ7Fs96VWAroj5FnniocLkw2e9AXfcIjZyrvtZ5eGxfF5Q3O6ZuzsjXmTpVSBG0E5u0', 160, 5, 'Ciencia Ficción', NOW(), NOW()),
  ('La teoria del todo', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSga0dkGIsGIb8feeeArnpwiK4JWsAYIyN42A__YXmFij9foijM', 103, 4, 'Drama', NOW(), NOW());

-- Insertar usuarios en la tabla usuarios
INSERT INTO usuarios (nombre, apellido, telefono, correo, created_at, updated_at)
VALUES
  ('Ruben', 'De la Cereza', '123456789', 'ruben@gmail.com', NOW(), NOW()),
  ('Hugo', 'Tripiana', '987654321', 'hugo@gmail.com', NOW(), NOW()),
  ('Josu', 'Largo', '555555555', 'josu@gmail.com', NOW(), NOW());

-- Insertar sesiones en la tabla sesiones
INSERT INTO sesiones (id_pelicula, fecha, hora, created_at, updated_at)
VALUES
  (1, '2024-03-15', '16:00:00', NOW(), NOW()),
  (1, '2024-03-19', '20:00:00', NOW(), NOW()),
  (2, '2024-03-16', '18:00:00', NOW(), NOW()),
  (2, '2024-03-18', '20:00:00', NOW(), NOW()),
  (3, '2024-03-17', '18:00:00', NOW(), NOW()),
  (3, '2024-03-17', '22:00:00', NOW(), NOW()),
  (4, '2024-03-18', '18:00:00', NOW(), NOW()),
  (5, '2024-03-19', '16:00:00', NOW(), NOW());

