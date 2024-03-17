## Football League Standings API

This API allows users to manage a football league standings, including adding clubs, getting a list of clubs, getting the standings of clubs, and adding and getting matches.

## Technologies Used
- Laravel v9.52.16
- PHP v8.1.6
- Composer 2.4.1
- XAMPP 3.3.0
- MySQL

## Installation

Clone this repository

```bash
https://github.com/riyansetiyadi/klasemen-sepak-bola-api.git
```

Install dependencies

```bash
composer install
```

Set Up Environment Variables
- Copy the .env.example file to .env.
- Generate a new application key

```bash
php artisan key:generate
```

- Configure database in the .env file

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_klasemen_sepak_bola
DB_USERNAME=root
DB_PASSWORD=
```

- Start XAMPP APACHE and MySQL
- Run Migrations

```bash
php artisan migrate
```

Start the Development Server

```bash
php artisan serve
```

Testing the API
- Use an API testing tool like Postman to interact with the API.


### Endpoints

#### 1. Add Club

- **URL:** `/klub`
- **Method:** POST
- **Parameters:**
  - `nama` (string, required): The name of the club.
  - `kota` (string, required): The city of the club.
- **Response:** Club Created

#### 2. Get List of Clubs

- **URL:** `/klub`
- **Method:** GET
- **Response:** List of clubs with city

#### 3. Get Club Standings

- **URL:** `/klasemen`
- **Method:** GET
- **Response:** league Standings

#### 4. Add Match

- **URL:** `/hasil-pertandingan`
- **Method:** POST
- **Parameters:**
  - `klub_tuan_rumah_id` (integer, required): The ID of the home team.
  - `klub_tamu_id` (integer, required): The ID of the away team.
  - `skor_tuan_rumah` (integer, required): The score of the home team.
  - `skor_tamu` (integer, required): The score of the away team.
- **Response:** Match Created

#### 5. Get Matches

- **URL:** `/hasil-pertandingan`
- **Method:** GET
- **Response:** List of matches with their details
