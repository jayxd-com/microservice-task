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

This document provides an overview of the roles available in the system and their associated permissions. Ensure that roles are assigned appropriately based on the responsibilities of users within the system.
