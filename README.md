# Login & Registration System

This is a login and registration system with role-based access control (admin/user) that demonstrates how PHP, HTML, JavaScript and CSS can be used to build a simple and interesting web application.

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/php-login-system.git
   cd login-form

2. **Setup database**
   CREATE DATABASE user_db;
   USE user_db;

    CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

3. **Access website**
      http://localhost/login-form
