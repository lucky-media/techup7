# TechUP

The code for the techup.mk website, using Tailwind CSS and Laravel. This website will be used as a free programming platform that will allow independent professional teachers to add free courses for highschool students. The courses will be in Albanian and Macedonian language, which covers interested students from at least three different countries. The platform is currently functional but it's built with Wordpress and many plugins. Now, we are refactoring the platform with a much better approach and greater customization options.

- Laravel 7
- Tailwind CSS

# How to install
- Start by cloning the project
- Duplicate the ".env.example" file and rename it to ".env"
- In the ".env" file, rename the database name to "techup"
- Start your development environment (ex. Laragon, WAMP, XAMPP) and create the techup database

### Then run the following commands:

- composer install
- npm install
- php artisan key:generate
- php artisan migrate --seed
- npm run dev


# How to use it
- php artisan serve

### Login
- Admin user: "admin@test.com", password "secret"
- Instructor: "instructor@test.com", password "secret"
- Student: "student@test.com", password "secret"

##### Images not showing
If you have a problem with displaying images, make sure your port number 80 is not blocked and run the following command:
- php artisan serve --port=80

Then, you can access your site through visiting http://localhost/