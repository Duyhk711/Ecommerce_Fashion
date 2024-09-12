# Project BookingOnline Installation Guide for Laravel

## System Requirements
- PHP >= 8.1
- Composer
- MySQL or PostgreSQL
- Node.js & NPM/Yarn

## Step 1: Clone the Repository
First, clone the repository from GitHub:


## Step 2: Install Composer Packages
Next, install the required packages via Composer:

```bash
composer install
```

## Step 3: Install Node.js Packages
Install the necessary JavaScript packages:

```bash
npm install
# or if you use Yarn
yarn install
```

## Step 4: Configure Environment
Copy the .env.example file to .env:

```bash
cp .env.example .env
```

Edit the .env file to configure the necessary settings (database, mail, etc.).

## Step 5: Generate Application Key
Generate the application key:
```bash
php artisan key:generate
```

## Step 6: Set Up Database
Run the migrate and seed commands to create and initialize the database:

```bash
php artisan migrate

```

## Step 7: Build Front-end Assets
Build the CSS and JavaScript files:

```bash
npm run dev
# or if you use Yarn
yarn dev
```

## Step 8: Run the Application
Start the Laravel development server:

```bash
php artisan serve
```
