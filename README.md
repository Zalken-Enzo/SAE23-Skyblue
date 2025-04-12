# SAE23-Skyblue

# SkyBlue

Skyblue is a website using CSS, PHP, and JavaScript technologies.
It is a project developed as part of a **first-year academic assignment.**

For this project, we recreated an online store for Blu-ray series and movies.
(This is a purely educational project and not intended for commercial use.)

## Installation

Setting up the Skyblue project is simple. Follow the steps below to get it running locally:
1. Clone or download the project to your local machine.
2. Place the project folder inside your Apache2 server's root directory (e.g., ```/var/www/html/```).
3. Make sure MySQL is running and create a database (e.g., ```skyblue_db```).
4. Import the provided SQL file (usually found in a ```/database``` or ```/sql``` folder) into your MySQL 
database: 
```bash
 mysql -u your_username -p skyblue_db < skyblue.sql
```
5. Update the database connection details in the PHP config file (e.g., ```config.php``` or inside a ```/config``` folder) with your local credentials.
6. Start your Apache2 server and navigate to ```http://localhost/SAE23``` in your browser.

📝 Note: This project is for educational purposes only and is not intended for commercial use.

## 💻 Technologies Used
- **HTML5 / CSS3** – For structuring and styling the web pages

- **JavaScript** – For interactivity and dynamic behaviors

- **PHP** – For server-side logic and data processing

- **MySQL** – For managing the database and storing information

- **Apache2** – As the local development web server
## 🛍️ Key Features

- 📦 Product Catalog: Browse a selection of Blu-ray movies and TV series

- 🔍 Search Functionality: Quickly find titles using a built-in search bar

- 🛒 Shopping Cart System: Add, remove, and view items in your cart

- 👤 User Authentication: Basic login and registration system

- 📄 Product Pages: Individual pages with detailed information about each Blu-ray

- 🧾 Order Summary: Review selected items before checkout (simulation only)

All features are implemented in a simplified way to demonstrate core e-commerce logic as part of a first-year academic project.
