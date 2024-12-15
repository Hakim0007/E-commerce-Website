# E-commerce Website Project Setup Guide

This guide will walk you through setting up the E-commerce project on your local machine using XAMPP.

## Prerequisites

- Download and install [XAMPP](https://www.apachefriends.org/index.html) (includes Apache and MySQL).
- Extract the project folder (zip) to your `htdocs` directory in the XAMPP installation directory.

## Steps

### 1. Install and Setup XAMPP

1. **Download and Install XAMPP**:
   - Go to the [XAMPP website](https://www.apachefriends.org/index.html) and download the installer for your operating system.
   - Follow the installation instructions.

2. **Extract the Project**:
   - Extract the downloaded project folder (e.g., `E-commerce Website.zip`) into the `htdocs` directory located in your XAMPP installation folder (typically `C:\xampp\htdocs`).

### 2. Start XAMPP

1. **Run XAMPP as Administrator**:
   - Open the XAMPP Control Panel as Administrator (right-click and select "Run as administrator").

2. **Start Apache and MySQL**:
   - In the XAMPP Control Panel, click on **Start** next to **Apache** and **MySQL** to start the server and database.

### 3. Setup the Database

1. **Open phpMyAdmin**:
   - Once Apache and MySQL are running, click on **Admin** next to **Apache** in the XAMPP Control Panel to open `phpMyAdmin` in your web browser.

2. **Create a New Database**:
   - In phpMyAdmin, click on **New** in the left sidebar to create a new database.
   - Enter the name of the database. This should be the same as the database name specified in the project files (usually mentioned in the project's documentation or configuration file).

3. **Import the SQL File**:
   - In the new database, click on the **Import** tab.
   - Under **File to import**, click **Choose File** and select the `.sql` file located in the `database` folder of the project directory.
   - Click **Go** to import the SQL file into the newly created database.

### 4. Access the E-commerce Website

1. **Access the Project**:
   - Once the database is set up, you can access the project by opening your web browser and navigating to: http://localhost/E-commerce-Website/index.php