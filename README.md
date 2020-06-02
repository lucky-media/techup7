# TechUP

The code for the techup.mk website, using Tailwind CSS and Laravel. We also make use of the wonderful Livewire framework to add some dynamic functionalities and the TinyMCE editor for adding course content. This website will be used as a free programming platform that will allow independent professional teachers to add free courses for highschool students. The courses will be in Albanian and Macedonian language, which covers interested students from at least three different countries. The platform is currently functional but it's built with Wordpress and many plugins. Now, we are refactoring the platform with a much better approach and greater customization options.

- Laravel 7
- Livewire
- Tailwind CSS
- TinyMCE

# How to install
- Start by cloning the project
- Duplicate the ".env.example" file and rename it to ".env"
- In the ".env" file, rename the database name to "techup"
- Start your development environment (ex. Laragon, WAMP, XAMPP) and create the techup database

### Then run the following commands:
```
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev
```

# How to use it
`php artisan serve`

### Login
- Admin user: "admin@test.com", password "secret"
- Instructor: "instructor@test.com", password "secret"
- Student: "student@test.com", password "secret"

##### Images not showing
If you have a problem with displaying images, make sure your port number 80 is not blocked and run the following command:
`php artisan serve --port=80`

Then, you can access your site through visiting http://localhost/


# Program Features

## User roles and permissions
- Besides the admin user, we have the instructors and the students.
- The instructors can CRUD courses and lessons, and add comments.
- The instructor has a unique profile page that he can edit but cannot delete or create.
- The students can view courses, lessons and add comments.
- Students don't have profile pages but can view instructors' profile page.
- Each user is automatically a student, but the admin can make a user an instructor.
- Only authenticated users can add comments.
- Comments are automatically posted, but they can be flagged as inappropriate.
- The admin manages inappropriate comments and can delete or approve comments.
- The admin is also responsible for CRUD course categories if needed.

## Courses
- The instructor can create a course with the following fields (user_id, title, slug, body, image, lang, category_id).
- The user_id is automatically assigned for the current authenticated user (instructor).
- The slug is also created at the controller by the title that was given.
- The body is created with a WYSIWYG editor, TinyMCE
- The image is used as a cover and thumbnail for the course.
- The language can be chosen as a dropdown option.
- The category id can be chosen as a dropdown option referring the table categories which has all categories.

## Lessons
- After creating the course, the instructor can add lessons to that course.
- Lessons can have a title and a body, as well as position.
- The body is created with a WYSIWYG editor and multiple images can also be added.
- The position defines the order of displaying the lessons of a particular course.

## Deleting Unused images
While working on the body of the lesson, you can use TinyMCE WYSIWYG editor to add photos.
However, if you delete a photo while working on the body, the photo is already stored in the folder and not deleted.
To delete these unused images we created a command with the name ImageCleanup.
It can be executed through running the command:

`php artisan image:cleanup`

The returned result should display "All unused lesson images are deleted successfully". 
You can also setup a cron job on your server to automatically run this command on a specific time.
Open App/Console/Kernel.php and modify the code to change the time to run the command.
Currently, we have set the cron job for Mondays on 07:00am.

```
$schedule->command('image:cleanup')
                 ->mondays()
                 ->at('07:00');
```
On your server you can also schedule this command by using the following code:

`* * * * * php /techup7/artisan image:cleanup >> /dev/null 2>&1`

Note: You may need to modify the /techup7/ to match the exact folder of your application on the server.
But don't modify the artisan image:cleanup >> /dev/null 2>&1
