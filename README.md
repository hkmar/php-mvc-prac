A simple post sharing website built on top of a customized TraversyMVC by Brad Traversy.
Uses PHP, Bootstrap, MySQL.

# Getting started
1. Download and install [XAMPP](https://www.apachefriends.org).
2. Copy the contents from `src` folder into `<XAMPP_INSTALLED_DIR>/htdocs/postzilla` .
3. Setup the database (see [database setup](#database-setup)).
4. Add your DB user and password to `postzilla/config/config.php`.
5. Navigate to `localhost/postzilla` in your browser.

# Database Setup

## Create a `postzilla` database
```sql
CREATE DATABASE IF NOT EXISTS `postzilla` DEFAULT CHARACTER SET utf8mb4;
```

## Create the `users` table
```sql
CREATE TABLE `postzilla`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) NOT NULL , 
  `email` VARCHAR(255) NOT NULL , 
  `password` VARCHAR(255) NOT NULL , 
  `created_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
```

## Create the `posts` table
```sql
CREATE TABLE `postzilla`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `user_id` INT NOT NULL , 
  `title` VARCHAR(255) NOT NULL , 
  `body` VARCHAR(255) NOT NULL , 
  `created_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
```
