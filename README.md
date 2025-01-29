Contact Book

Description:
Contact Book is a web application that allows users to securely manage their contacts. Users must first sign up and log in to access the system. Once authenticated, they can add, view, edit, and delete contacts. Each contact includes a name, email, and profile picture. Only registered and active users can manage their contacts.

Features:
User Authentication: Sign up and log in to access the system.

Add Contacts: Users can add new contacts with name, email, and profile picture.

View Contacts: Users can see a list of all their saved contacts.

Edit Contacts: Users can update contact details.

Delete Contacts: Users can remove contacts from their list.

Access Control: Only registered and active users can manage contacts.

Technologies Used:
Frontend: HTML, CSS, Bootstrap

Backend: PHP

Database: MySQL

Authentication: Session-based authentication

Installation:
Prerequisites:
PHP installed
MySQL configured

Setup

1.Clone the repository:

git clone https://github.com/priya-nb695/contactsBook.git

cd contactsBook

Set up the database:

2.Create a database in MySQL

CREATE DATABASE contactsbook;

Switch to the database:

USE contactsbook;

Create the users table:

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    profile_img VARCHAR(255),
    password VARCHAR(255) NOT NULL

);

Create the contacts table:

CREATE TABLE contacts (

    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    photo VARCHAR(255),
    status ENUM('active', 'inactive') NOT NULL,
    owner_id INT,
    FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE CASCADE

);

3.Start the server:

If using XAMPP, place the project in the htdocs folder and start Apache & MySQL

Open http://localhost/contactsBook in your browser
Usage

Sign Up: Create an account.

Log In: Access your dashboard.

Manage Contacts: Add, update, or remove contacts.

Logout: Securely end your session.


