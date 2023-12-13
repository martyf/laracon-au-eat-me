# eat.me demo app

This app has been developed for my talk "Statamic for Laravel Devs" at Laracon AU.

Check out [Statamic for Laravel Devs](https://www.martyfriedel.com/blog/statamic-for-laravel-devs-at-laracon-au-2023) 
for more details.

This demo includes:
- a basic Livewire app
- [Statamic](https://github.com/statamic/cms) installed on top of the app
- A fully functioning Blog, with focal cropping on images
- Nav configured in Statamic (with a custom Laravel Route fieldtype)
- A "settings" Global for the Footer copyright text
- Content pages, such as Privacy Policy and Contact
- [Runway](https://github.com/duncanmcclean/runway) for viewing/editing Eloquent models in Statamic, by the incredible [Duncan McClean](https://github.com/duncanmcclean)
- [Bard Ipsum](https://github.com/jacksleight/statamic-bard-ipsum), by the awesome [Jack Sleight](https://github.com/jacksleight)

## Set up

When you've got the repo cloned locally, and configured your `.env` - including database details - and you're ready to 
get started:

```shell
composer install

# if you haven't done it yourself
php artisan key:generate

php artisan migrate
php artisan db:seed
php artisan storage:link

npm install
npm run dev
```

All seeded user details (check out the `users` table in the database) have the password of "password". Super secure, right?

These users can all log in to the front end of the website.

## Statamic Control Panel
To get in to the **Statamic Control Panel**, you will need to make a user:

```shell
php please make:user
```

Follow the prompts, and when asked if you want to be a Super User, select yes.

You can access the Control Panel by going to `/cp` on your site.
