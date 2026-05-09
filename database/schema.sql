CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','client') NOT NULL DEFAULT 'client',
  phone VARCHAR(40),
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
);
CREATE TABLE restaurants (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,address VARCHAR(255),phone VARCHAR(40),email VARCHAR(190),description TEXT,created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL);
CREATE TABLE tables (id INT AUTO_INCREMENT PRIMARY KEY,restaurant_id INT NOT NULL,name VARCHAR(80) NOT NULL,capacity INT NOT NULL,pos_x INT DEFAULT 20,pos_y INT DEFAULT 20,width INT DEFAULT 100,height INT DEFAULT 100,shape ENUM('round','square','rectangle') DEFAULT 'round',created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL,FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE);
CREATE TABLE events (id INT AUTO_INCREMENT PRIMARY KEY,restaurant_id INT NOT NULL,title VARCHAR(160) NOT NULL,description TEXT,event_date DATE NOT NULL,start_time TIME NOT NULL,end_time TIME NOT NULL,status ENUM('draft','open','closed','cancelled','finished') DEFAULT 'draft',max_capacity INT DEFAULT 0,created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL,FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE);
CREATE TABLE dishes (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,description TEXT,price DECIMAL(10,2) NOT NULL,is_active TINYINT(1) DEFAULT 1,created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL);
CREATE TABLE event_dishes (id INT AUTO_INCREMENT PRIMARY KEY,event_id INT NOT NULL,dish_id INT NOT NULL,price_override DECIMAL(10,2),created_at DATETIME NOT NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,FOREIGN KEY (dish_id) REFERENCES dishes(id) ON DELETE CASCADE);
CREATE TABLE reservations (id INT AUTO_INCREMENT PRIMARY KEY,event_id INT NOT NULL,user_id INT NULL,customer_name VARCHAR(120) NOT NULL,customer_email VARCHAR(190) NOT NULL,customer_phone VARCHAR(40),number_of_people INT NOT NULL,status ENUM('pending','confirmed','cancelled','checked_in') DEFAULT 'pending',notes TEXT,created_by_admin TINYINT(1) DEFAULT 0,created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL);
CREATE TABLE reservation_guests (id INT AUTO_INCREMENT PRIMARY KEY,reservation_id INT NOT NULL,name VARCHAR(120) NOT NULL,email VARCHAR(190),phone VARCHAR(40),created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL,FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE);
CREATE TABLE guest_dishes (id INT AUTO_INCREMENT PRIMARY KEY,reservation_guest_id INT NOT NULL,event_dish_id INT NOT NULL,quantity INT DEFAULT 1,notes TEXT,created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL,FOREIGN KEY (reservation_guest_id) REFERENCES reservation_guests(id) ON DELETE CASCADE,FOREIGN KEY (event_dish_id) REFERENCES event_dishes(id) ON DELETE CASCADE);
CREATE TABLE table_assignments (id INT AUTO_INCREMENT PRIMARY KEY,event_id INT NOT NULL,table_id INT NOT NULL,reservation_id INT NOT NULL,seats_assigned INT NOT NULL,created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE CASCADE,FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE);
CREATE TABLE email_logs (id INT AUTO_INCREMENT PRIMARY KEY,reservation_id INT,event_id INT,email VARCHAR(190) NOT NULL,type VARCHAR(60) NOT NULL,status VARCHAR(40) NOT NULL,error_message TEXT,sent_at DATETIME,created_at DATETIME NOT NULL,FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE SET NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE SET NULL);
CREATE TABLE settings (id INT AUTO_INCREMENT PRIMARY KEY,`key` VARCHAR(120) UNIQUE,`value` TEXT,created_at DATETIME NOT NULL,updated_at DATETIME NOT NULL);
