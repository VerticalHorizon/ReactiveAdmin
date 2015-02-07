ReactiveAdmin
=============

Fast, Flexible &amp; Secure Admin for Laravel

## Quick start

### Install [Zizaco\Confide](https://github.com/Zizaco/confide) package

- Publish the config files:
```bash
$ php artisan config:publish zizaco/confide
```

Change confide config:
	'login_form' => 'confide::login' to 'login_form' => 'reactiveadmin::login',

- Publish the ReactiveAdmin config:
```bash
$ php artisan config:publish verticalhorizon/reactiveadmin
```

- Publish the ReactiveAdmin assets:
```bash
$ php artisan asset:publish verticalhorizon/reactiveadmin
```

### Creating model config file
//