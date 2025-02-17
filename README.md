## How It Works

Simply to run this project just follow the steps below:

1- `git clone https://github.com/ELIASDA-Design/ecommerce_task.git`
2- `cd ecommerce_task/`<br/>
3- `composer install` <br/>
4-  `npm install` <br/>
5-  Create Database for the project. <br/>
6- Edit `.env` file with your DB Name, Username, Password : <br/>

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=Database_Name
    DB_USERNAME=DB_Username
    DB_PASSWORD=DB_Password

7- `php artisan migrate` <br/>
8- `php artisan db:seed` <br/>
9- `npm run dev` <br/>
10- `php artisan serve`
