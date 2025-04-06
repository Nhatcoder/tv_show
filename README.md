# TV Show

## Introduction

TV Show is a web application for managing TV show listings, allowing users to view schedules, track favorite shows, and manage personal preferences. This project is developed using main languages and technologies such as CSS, Blade, PHP, and JavaScript.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Directory Structure](#directory-structure)
- [Contribution](#contribution)
- [License](#license)

## Features

- Technologies used: PHP, Laravel, Bootstrap 5, HTML/CSS, JQuery, JavaScript, Ajax, SQL
- CRUD operations for Categories, Subcategories, TV Shows, Brands, TV Show Models
- Revenue statistics and reviews
- Google Login, Login, Registration, Password Recovery, Role Management
- TV Show model details
- Advanced search filtering, pagination, reviews
- Favorite TV shows
- Queue mail sending
- User profile page

## Installation

### Requirements

- Node.js and npm
- Composer
- A web server like Apache or Nginx

### Installation Guide

1. Clone the repository to your machine:

    ```sh
    git clone https://github.com/Nhatcoder/tv_show.git
    ```

2. Install backend dependencies:

    ```sh
    composer install
    ```

3. Install frontend dependencies:

    ```sh
    npm install
    ```

4. Create the `.env` file from the example file `.env.example` and update the necessary configuration information:

    ```sh
    cp .env.example .env
    ```

5. Run migrations and seed data:

    ```sh
    php artisan migrate --seed
    ```

6. Start the server:

    ```sh
    php artisan serve
    npm run dev
    ```

## Usage

After successful installation, you can access the web application at `http://localhost:8000`.

- Register/Login account
- Manage TV shows and categories
- Track favorite TV shows
- Manage user roles and permissions
- View revenue statistics and TV show reviews
- Export schedules to PDF
- Use advanced search filtering and pagination
- Manage favorite TV shows
- Edit personal profile

## Directory Structure

```plaintext
tv_show/
├── app/                # Directory containing backend PHP files
├── public/             # Directory containing static files like images, CSS, JavaScript
├── resources/          # Directory containing Blade templates and frontend source files
├── routes/             # Directory containing route definition files
├── storage/            # Directory containing cache and logs files
├── tests/              # Directory containing test files
├── .env.example        # Example environment configuration file
├── composer.json       # Composer configuration file
├── package.json        # npm configuration file
└── README.md           # This file
