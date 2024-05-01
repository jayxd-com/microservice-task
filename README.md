## Dev Steps
- Install `composer require laravel/passport`



### How to use?

- Create Passport Personal Token and save it to .env `php artisan passport:client --personal`



## Roles Documentation

This document outlines the roles available in the system along with their respective permissions.

### Roles

#### 1. Admin

- **ID:** 1
- **Permissions:**
    - Create User
    - Read User
    - Update User
    - Delete User
    - Create Product
    - Read Product
    - Update Product
    - Delete Product

#### 2. Manager

- **ID:** 2
- **Permissions:**
    - Create Product
    - Read Product
    - Update Product
    - Delete Product

#### 3. User

- **ID:** 3
- **Permissions:**
    - Read Product

### Permissions Legend

- **Create User:** Ability to create new users.
- **Read User:** Ability to view user information.
- **Update User:** Ability to update user information.
- **Delete User:** Ability to delete users.
- **Create Product:** Ability to create new products.
- **Read Product:** Ability to view product information.
- **Update Product:** Ability to update product information.
- **Delete Product:** Ability to delete products.

### Note
- Each role is assigned a unique ID for identification purposes.
- Permissions define the actions a role can perform within the system.


## Microservice API Overview

### Registration Endpoint
POST /register: Allows new users to register by providing their name, email, and password.

### Login Endpoint
POST /login: Authenticates users and returns an access token.

### Logout Endpoint
POST /logout: Invalidates the user's current access token to log them out.

### User Details and Authorization Check
GET /user: Retrieves user details and verifies if the user is authorized, based on the provided token.

### Authentication Notes
- JWTs (JSON Web Tokens) are used for secure authentication.
- Users must pass their token in the HTTP Authorization header for access to protected endpoints.


## Product Management API Overview

### Create Product
POST /product: Allows authorized users to add new products by providing necessary details such as SKU, name, description, price, and quantity.
### Read Product
GET /product/{id}: Retrieves details of a specific product identified by its unique ID. Useful for viewing product specifics.
### Update Product
PUT /product/{id}: Enables authorized users to update existing product details such as name, price, or quantity for a specified product ID.
### Delete Product
DELETE /product/{id}: Allows authorized users to remove a product from the system using the product's ID.

### General Notes on Product API
- Access to product management endpoints requires authentication and appropriate authorization.
- Requests should include a valid JWT in the HTTP Authorization header to ensure secure access.
