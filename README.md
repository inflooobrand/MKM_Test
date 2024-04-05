# Laravel 10 Application

## Introduction

insert/update data into a database, and provide a secure API endpoint for retrieving specific records.

## Installation

## Clone the repository to your local machine:
	git clone <repository-url>


2. Install Composer dependencies:

	composer install

	composer require spatie/simple-excel


3. Copy the `.env.example` file to `.env`:

	cp .env.example .env

	Change the QUEUE_CONNECTION=database In evn file 


4. Set up database connection in the `.env` file:

	Migrate the database:


5. Install JWT authentication:
	composer require tymon/jwt-auth

	configure JWT config/app.php
	'providers' => [ Tymon\JWTAuth\Providers\LaravelServiceProvider::class]

	add  aliases  
	'Jwt' => Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
   	'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class,
   	'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,

   	run the php artisan jwt:secret for getting JWT_SECRET 

6.run the php artisan queue:work

## Usage

1. To process a CSV file and insert/update data into the database, use the following command:

	php artisan csv:upload <file-name(products.csv)>

	POST /api/process 
	PARAM : form-data 
	key:file,
	value:file

	The Above route run the command automatical and insert the data Into DB



2. To test the API endpoint for retrieving a specific record by SKU, send a GET request to the following URL:


	GET /api/products/{sku}
	Ensure that you include a valid JWT token in the request headers for authentication.


## Testing

To run the PHPUnit tests, use the following command:

php artisan test
