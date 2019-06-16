# Laravel Blog 
This is my first project using laravel 5. It's a simple blog. You can register to the blog and create, edit and delete your own articles.
## Used packages
* [Bouncer](https://github.com/JosephSilber/bouncer).
* [Eloquent-Sluggable](https://github.com/cviebrock/eloquent-sluggable).

## Features
1. Anyone can register and login.
2. Each user has a profile.
3. Users can add articles, edit and delete.
4. Send E-mail to the users whene they create, delete or update their articles.
5. Each user has roles and abilities.
6. All articles are categorized.
7. Many-to-Many relationship between articles and categories.
8. TinyMCE Editor for beatiful article's content.
9. Dahboard for admin.

## Images

![Register](Docs/images/Register.png)


![Login](Docs/images/Login.png)


![Profile](Docs/images/Profile.png)


![Home](Docs/images/Home.png)


![Create](Docs/images/Create.png)


![Category](Docs/images/Category.png)


![Dashboard](Docs/images/Dashboard.png)


![Categories](Docs/images/Categories.png)


![Users](Docs/images/Users.png)

## Installation
1. Download .zip file.
2. Open phpMyAdmin and create new database named `blog`. You can change this name but don't forget to change the database name in `.env` file.
3. Go to Docs directory, there is a file named blog.sql.
4. Import `blog.sql` file in your database(the database you've created in the step 2).([How to import MySQL database and tables using phpMyAdmin? ](https://www.youtube.com/watch?v=jW5lrS6EUPM)).
5. Open the project using any code editor and run `php artisan serve` in the terminal.
6. Open localhost:8000.
7. You need to login as a superadmin. Go to `localhost:8000/login` and login using this informations:
    E-mail: admin@example.com
    Password: 123456.
8. Now, there are three articles and three users and three categories in the database, run `php artisan migrate:refresh` in the terminal to refresh your database.


