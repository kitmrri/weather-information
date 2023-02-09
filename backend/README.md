
# Laravel and MySQL API for Weather Forecast

This API provides weather forecast information for a given location, in our case, cities in Japan. The API is built using Laravel and MySQL as the backend and can be used by a frontend application to fetch current weather data, 5-day forecast and details of the city provided by Geoapify. 

The data is fetched from the OpenWeatherMap and Geoapify APIs, and is saved in a MySQL database to minimize API calls and improve performance. There is a huge gap in speed when comparing every API call to when just fetching from database.

I created a custom command called `getopenweather` and `getgeoapify` to 'prepare' the data for the 5-day forecast and geoapify. This also ensured the speed to which the data is being served to the frontend. I took advantage of Laravel's `Task Scheduling` to truncate the `weather` table and run the custom command `getopenweather` daily. This makes sure that the 5 Day Forecast data is up-to-date on a daily basis. 

There is a reusable interface called `ApiInterface`, it is a `ServiceProvider` that `OpenWeather` and `OpenGeoapify` is using to create its own use of the function but not altering the `main function` which is inside the ApiInterface.

For cleaning and uniformity of format and spacing of codes, i used `Laravel Pint` to automatically correct the corrections of every php file in backend folder. This free up significant time when cleaning manually. This also adds uniformity if ever another developer updates the application.

## Features
* Fetch current weather data and 5-day forecast for a given location
* Minimize API calls by saving data in a MySQL database
* Improve performance by fetching data from the database instead of the OpenWeatherMap and Geoapify APIs with every request
* Incorporate the SOLID principle by using an ApiInterface that is extended by the OpenWeather and Geoapify services, making the code reusable

## How to Use
The API can be easily integrated into a frontend application by making API calls to the endpoint. 

## Conclusion
This Laravel and MySQL API provides a fast and efficient way to access weather forecast information for a given location. The use of the SOLID principle makes the code scalable and reusable, while the use of a database to store data reduces API calls and improves performance.
