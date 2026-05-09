INSERT INTO users (name,email,password,role,phone,created_at,updated_at) VALUES
('Administrador','admin@admin.com','$2y$12$8dCjtSE3p68iYHBg5o89xOepXiDH22MuHd8M3RrrwIBML09Ao.EhW','admin','910000000',NOW(),NOW());
INSERT INTO restaurants (name,address,phone,email,description,created_at,updated_at) VALUES
('Restaurante Exemplo','Rua Central 123, Lisboa','210000000','contato@restaurante.pt','Espaço para eventos privados.',NOW(),NOW());
INSERT INTO tables (restaurant_id,name,capacity,pos_x,pos_y,width,height,shape,created_at,updated_at) VALUES
(1,'Mesa 1',4,30,40,90,90,'round',NOW(),NOW()),
(1,'Mesa 2',6,150,40,110,90,'rectangle',NOW(),NOW());
INSERT INTO events (restaurant_id,title,description,event_date,start_time,end_time,status,max_capacity,created_at,updated_at) VALUES
(1,'Jantar de Primavera','Evento de degustação sazonal.',DATE_ADD(CURDATE(), INTERVAL 7 DAY),'20:00:00','23:30:00','open',60,NOW(),NOW());
INSERT INTO dishes (name,description,price,is_active,created_at,updated_at) VALUES
('Bacalhau à Brás','Prato tradicional.',18.50,1,NOW(),NOW()),
('Risotto de Cogumelos','Opção vegetariana.',15.00,1,NOW(),NOW());
INSERT INTO event_dishes (event_id,dish_id,price_override,created_at) VALUES (1,1,NULL,NOW()),(1,2,14.50,NOW());
