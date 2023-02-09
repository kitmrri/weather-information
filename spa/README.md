
# Vue.js with Axios and Tailwind

This frontend SPA application is built using Tailwind CSS for styling and Vue.js as the JavaScript framework. Axios is used to make API calls to the backend and access the database. 

I used tailwind because it is a highly optimized and performance-focused CSS framework, providing a fast and efficient way to style the application. This also makes modifying the looks more trivial due to its rich documentation. Tailwind also provides `responsive` variants for the developers to build adaptive interfaces with ease.

Vue.js offers a reactive and flexible approach to frontend development, allowing for smooth and seamless updates to the user interface. This satisfies the `reactive` requirement of the application. Using it with `Axios` makes it very easy and simple to access the backend and database. This allows for a quick and easy retrieval of the required data.

I separated the components into three distinct Vue files for improved readability and modularity, making it easier for other developers to understand and navigate the code structure.

I retrieve the data in the main Vue file and pass only the necessary information to each component through props. This method allows for better data management and maintainability, as well as providing a clear flow of information between components.

I utilized `Axios` for API communication because its simple and intuitive API makes it easy for me to send HTTP requests and handle the responses. It supports advanced features such as request cancellation, response transformation, and error handling, making it a robust solution for API communication. Axios also works with various Javascript framework and libraries, in my case, i used it with Vue. Also, it is widely used and has a large and active community, ensuring easy problem-solving via online help (stackoverflow and the likes) and staying up-to-date with new features and improvements.

## UI/UX Implementation
I styled the application this way for the users to quickly see all the details they are looking for at a glance. I also added a `link to google maps` on each of the Restaurant and Tourist Attractions in the list. There is also a sidebar navigation on the left side for users to quickly change City that they want to look at.

## Features
* Utilizes the power of Tailwind CSS for fast and efficient styling
* Vue.js provides a reactive and efficient way to handle the frontend logic
* Axios makes it easy to make API calls and access the database

## Conclusion
The use of Tailwind CSS, Vue.js, and Axios provides a powerful and efficient solution for the frontend of this application. The combination of these technologies ensures a fast, reactive, and user-friendly experience for the end-user.






