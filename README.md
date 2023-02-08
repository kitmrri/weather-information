
# Weather Information Application

The application aims to provide weather information for specific countries in Japan (Tokyo, Yokohama, Kyoto, Osaka, Sapporo and Nagoya). This app displays the current weather and a 5 day forecast of the selected city.

## Technologies Used
- Laravel: A PHP framework for web application development
- Vue: A JavaScript framework for building user interfaces
- Tailwind CSS: A utility-first CSS framework
- MySQL: A relational database management system
- OpenWeather API: A weather API providing current weather data for any location on Earth
- Geoapify Places API: An API for searching for places and addresses worldwide

This application uses the above technologies to provide accurate and up-to-date weather information for users. By utilizing the OpenWeather API and Geoapify Places API, the application is able to provide data on the current weather conditions and forecast for a select locations in Japan.


## Installation

Run the following command to install the dependencies in backend:
```bash
cd backend
npm install
```

and in spa:
```bash
cd spa
npm install
```

Run the migration necessary for the application:
```bash
php artisan migrate
```

We need to populate the city table
```bash
php artisan db:seed --class=CitiesTableSeeder
```
this will populate the `cities` table with the name of the city with its respective coordinates.

Next, run the command to get 5 Day Forecast information from OpenWeatherMap API
```bash
php artisan getopenweather
```
this is a custom command that uses OpenWeather service that I created and fetch data from OpenWeatherMap and then saves it to the database under `weather` table.
* Note that `php artisan getopenweather` will run Daily to get the data from OpenWeatherMap and refreshes the contents of `weather` table. This was done via Laravel Scheduler.

You also need to get necessary data from Geoapify for the Places Details
```bash
php artisan getgeoapify
```

## To start the application
You need to serve the backend, run: (make sure you are in the root folder weather-information/)
```bash
cd backend
```

To fix the code, I incorporated Laravel Pint. You can use it via:
```bash
./vendor/bin/pint
```
and then serve the backend:
```bash
php artisan serve
```

and the frontend
```bash
cd .. (if you are in backend/ path)
cd spa
npm run dev
```