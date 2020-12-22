# Craft Coffee Webshop

Developing the webshop for Craft Coffee to sell artisanal coffee, toppings and accessories to hip coffee fans from 18 to 50 years of age in central Europe.

__Technologies:__ XAMPP, Symfony framework, TWIG templating engine and Bootstrap design system

__Additional Tools:__ Trello, draw.io, Affinity Photo, Adobe Stock

__Timeframe:__ 7.12. - 17.12.2020

__Development Team:__ [Marin Balabanov](https://github.com/mbalabanov) and [Zuzana Stichova](https://github.com/ZuzanaStichova) at the [Codefactory](https://codefactory.wien) Backend Web Developer course. This is a clone of the private CodeFactory project repository.

## Project Details
This is the final project for the backend/fullstack course at CodeFactory (CF11). The objective of this project is to develop an online store where customers can browse the product catalog and select the desired products. The selected items will be collected in a shopping cart. At checkout the items from the shopping cart will be displayed and the customer can pay the order. An email notification will be sent to the customer when the order is completed.

Please find the __project presentation__ here: https://github.com/mbalabanov/craftcoffee/blob/main/documentation/craft-coffee-project-17-dec-2020.pdf

Please find the __Trello project plan__ here: https://trello.com/b/Et9sWbhm/craft-coffee-shop

## Installation

Clone the repository and import the DB export from the directory `db-export` into your MySQL database. Set the database path and user credentials in `.env`.

Run `composer install` (an additional `composer update` might be necessary).

To launch the webshop run `php bin/console server:run` and then follow the instructions in the terminal.

### User Accounts
You can register a new user or use the following existing user accounts:

- `user@gmail.com` for a regular user
- `jennifer.lopez@gmail.com` for an admin user.

Both user accounts have the password `123123`

## Screenshots of Finished Shop
![The Craft Coffee Webshop](documentation/screenshots/screenshot1.png)

![The Craft Coffee Webshop](documentation/screenshots/screenshot2.png)

![The Craft Coffee Webshop](documentation/screenshots/screenshot3.png)

## Initial DB Structure
![DB Structure](documentation/02_db-diagram.png)

## Initial Site Structure
![DB Structure](documentation/03_sitemap.png)

## Initial Wireframes
![DB Structure](documentation/04_wireframes.png)


