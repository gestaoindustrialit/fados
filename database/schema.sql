PRAGMA foreign_keys = ON;

CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  role TEXT NOT NULL DEFAULT 'client' CHECK(role IN ('admin','client')),
  phone TEXT,
  created_at TEXT NOT NULL,
  updated_at TEXT NOT NULL
);
CREATE TABLE restaurants (id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,address TEXT,phone TEXT,email TEXT,description TEXT,created_at TEXT NOT NULL,updated_at TEXT NOT NULL);
CREATE TABLE tables (id INTEGER PRIMARY KEY AUTOINCREMENT,restaurant_id INTEGER NOT NULL,name TEXT NOT NULL,capacity INTEGER NOT NULL,pos_x INTEGER DEFAULT 20,pos_y INTEGER DEFAULT 20,width INTEGER DEFAULT 100,height INTEGER DEFAULT 100,shape TEXT DEFAULT 'round' CHECK(shape IN ('round','square','rectangle')),created_at TEXT NOT NULL,updated_at TEXT NOT NULL,FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE);
CREATE TABLE events (id INTEGER PRIMARY KEY AUTOINCREMENT,restaurant_id INTEGER NOT NULL,title TEXT NOT NULL,description TEXT,event_date TEXT NOT NULL,start_time TEXT NOT NULL,end_time TEXT NOT NULL,status TEXT DEFAULT 'draft' CHECK(status IN ('draft','open','closed','cancelled','finished')),max_capacity INTEGER DEFAULT 0,created_at TEXT NOT NULL,updated_at TEXT NOT NULL,FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE);
CREATE TABLE dishes (id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,description TEXT,price REAL NOT NULL,is_active INTEGER DEFAULT 1,created_at TEXT NOT NULL,updated_at TEXT NOT NULL);
CREATE TABLE event_dishes (id INTEGER PRIMARY KEY AUTOINCREMENT,event_id INTEGER NOT NULL,dish_id INTEGER NOT NULL,price_override REAL,created_at TEXT NOT NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,FOREIGN KEY (dish_id) REFERENCES dishes(id) ON DELETE CASCADE);
CREATE TABLE reservations (id INTEGER PRIMARY KEY AUTOINCREMENT,event_id INTEGER NOT NULL,user_id INTEGER NULL,customer_name TEXT NOT NULL,customer_email TEXT NOT NULL,customer_phone TEXT,number_of_people INTEGER NOT NULL,status TEXT DEFAULT 'pending' CHECK(status IN ('pending','confirmed','cancelled','checked_in')),notes TEXT,created_by_admin INTEGER DEFAULT 0,created_at TEXT NOT NULL,updated_at TEXT NOT NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL);
CREATE TABLE reservation_guests (id INTEGER PRIMARY KEY AUTOINCREMENT,reservation_id INTEGER NOT NULL,name TEXT NOT NULL,email TEXT,phone TEXT,created_at TEXT NOT NULL,updated_at TEXT NOT NULL,FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE);
CREATE TABLE guest_dishes (id INTEGER PRIMARY KEY AUTOINCREMENT,reservation_guest_id INTEGER NOT NULL,event_dish_id INTEGER NOT NULL,quantity INTEGER DEFAULT 1,notes TEXT,created_at TEXT NOT NULL,updated_at TEXT NOT NULL,FOREIGN KEY (reservation_guest_id) REFERENCES reservation_guests(id) ON DELETE CASCADE,FOREIGN KEY (event_dish_id) REFERENCES event_dishes(id) ON DELETE CASCADE);
CREATE TABLE table_assignments (id INTEGER PRIMARY KEY AUTOINCREMENT,event_id INTEGER NOT NULL,table_id INTEGER NOT NULL,reservation_id INTEGER NOT NULL,seats_assigned INTEGER NOT NULL,created_at TEXT NOT NULL,updated_at TEXT NOT NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE CASCADE,FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE);
CREATE TABLE email_logs (id INTEGER PRIMARY KEY AUTOINCREMENT,reservation_id INTEGER,event_id INTEGER,email TEXT NOT NULL,type TEXT NOT NULL,status TEXT NOT NULL,error_message TEXT,sent_at TEXT,created_at TEXT NOT NULL,FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE SET NULL,FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE SET NULL);
CREATE TABLE settings (id INTEGER PRIMARY KEY AUTOINCREMENT,`key` TEXT UNIQUE,`value` TEXT,created_at TEXT NOT NULL,updated_at TEXT NOT NULL);
