ReactiveAdmin
=============

Fast, Flexible &amp; Secure Admin for Laravel

## Quick start

### Install [Zizaco\Confide](https://github.com/Zizaco/confide) package

- Publish the config files:
	$ php artisan config:publish zizaco/confide
Change confide config:
	'login_form' => 'confide::login' to 'login_form' => 'reactiveadmin::login',

- Publish the ReactiveAdmin config:
	$ php artisan config:publish verticalhorizon/reactiveadmin

- Publish the ReactiveAdmin assets:
	$ php artisan asset:publish verticalhorizon/reactiveadmin

READY!

TODO:
	remove 'singular_title' & 'plural_title'. they should be in the locale file
	'upload' in appropriate folders