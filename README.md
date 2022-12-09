CMS written with Laravel Framework
===============================

## Vagrant

Configure a host and database under vagrant
```
nano Homestead.yaml
```
Take effect on changes made in the Vagrantfile with forcing the provisioners to re-run
```
vagrant reload --provision
```
Create and configure guest machines according to the Vagrantfile
```
vagrant up
```
SSH into the running Vagrant machine through the shell
```
vagrant ssh
```

## Settings

Create a .env setting file based on the .env.example file and change the settings inside of it
```
cp .env.example .env
```

## Nova

Put the Laravel Nova directory inside the project 

## Composer

Update the dependencies to the latest versions
```
composer update
```
Update the autoloader to use new classes
```
composer dump-autoload
```

## Database

Run the migrations
```
php artisan migrate
```
Run the seeders
```
php artisan db:seed
```
Refresh all the migrations and seeders
```
php artisan migrate:refresh --seed
```

## Telescope

Publish the Telescope's assets
```
php artisan telescope:publish
```

## Storage

Remove a symbolic link of the storage if exists
```
rm public/storage
```
Create a symbolic link for the directory of the file storage that will be publicly accessible
```
php artisan storage:link
```

## Cache

Flush the application cache
```
php artisan cache:clear
```
Remove the configuration cache file
```
php artisan config:clear
```
Create a cache file for faster configuration loading
```
php artisan config:cache
```

## Npm

Install the dependencies in the local node_modules folder
```
npm install
```
Runs the development command from the package file
```
npm run dev
```
Watch in real time for the updates in JS and CSS files
```
npm run watch
```

## Translations

Delete all the translations from the database
```
php artisan translations:reset
```
Import translations from the files into the database
```
php artisan translations:import
```
Scan the php and twig files for extracting translation key items
```
php artisan translations:find
```
Export the translations from the database into the files
```
php artisan translations:export {group}
```

## Info

Admin area contains the following units:
```
- Dashboard
- Users
- Roles
- Permissions
- Pages
- Snippets
- Menus
- Media
- Slider
- FAQ
- Quotes
- Mails
- Countries
- Settings
- Units
- Translations
```

## Installation

```
- Install the system according to the instructions above
- Change the logo, system name, and admin panel design elements
- Delete not intended to be used elements. Delete only unnecessary controllers, models, views, requests, policies, migrations, and nova resources
- Edit demo elements inside such classes as BlogController, HomeController, DemoObserver, DemoTrait, ComposerServiceProvider, NovaServiceProvider, the home and blog views, etc.
- Edit such system elements as seeders, routes, translations, СSS, JS, fonts, and images
```

## New unit

Adding a new admin unit
```
- Add a migration. Example: CreatePagesTable
- Add a seeder if needed. Example: PageTableSeeder 
- Add a model. Inherit it from BaseModel. Set up the following properties inside it: $title, $fillable, $casts, $files, $attributes, $order, $search, $only if needed. Also add relations, scopes, calculated attributes, constants, traits, and needed functions. Example: the Page model
- Add a controller. Inherit it from AdminController. Inside the index action use the with, defaultOrder, and paginate functions. Example: PageController
- Add a request class. Example: PageRequest
- Add view files. Example: the page views
- Add a Nova resource and all related Nova helper classes if needed. Example: the Page resource
- Add a unit record inside UnitTableSeeder
- Add routes inside the routes/web file
- Add a link to the unit inside the admin.partials.sidebar view
- For email templates use Notifications
```