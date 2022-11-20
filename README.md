## title
VerySimpleShopBackend

## motivation
I built this Laravel app to prove i am able to make very simple backend in php for frontend app

## framework and libraries
Laravel 9.20.0, Sanctum.

## features
The app is created as REST API with routes serving login, register, and log out to fill authentication purposes with help of tokens issued by Sanctum library.
App has also routes for storing and retrieving carts for logged users.
Shop also is served by separate route, as well route for the search of a single product is present.
The token can be revoked when the user logout from React part.

Program preserved data in MariaDB database and has features such as migrating the database and seeding it with dummy data for testing.
Database and app have the following Models representing data in front: Image, User, Product, and pivot table connecting Product and User Model.
User and Product are connected using ManyToMany relation needed for example to serve cart feature. 
Image and Product fill ManyToOne relation.       
