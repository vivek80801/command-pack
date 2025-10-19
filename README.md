# Command Pack

This is laravel package for creating controller, actions, services, repositories and views with brace expansion.you can do php artisan make:createView "{product,roles,category}". It will create `product/index.blade.php`, `product/edit.blade.php`, `product/create.blade.php`, `roles/index.blade.php`, `roles/create.blade.php`, `roles/edit.blade.php`, `category/index.blade.php`, `category/create.blade.php`, `category/edit.blade.php`

## Usage

```bash

#publish stub and config
php artisan vendor:publish --provider="vivek\\CommandPack\\CommandPackServiceProvider" --tag="command-pack-config"

php artisan vendor:publish --provider="vivek\\CommandPack\\CommandPackServiceProvider" --tag="command-pack-stub"

# Create View
php artisan make:createView "{product,role,category}/{index,create,edit}"

# Create Action
php artisan make:createAction "User/{createUser,EditUser}"

# Create Service
php artisan make:createService "UserService"

# Create Repository
php artisan make:createRepository "UserRepository"

```

## Config

```php

    return [
        // Change here action folder
        'actions_folder' => "app/Actions",
        // Change here Service folder
        'services_folder' => "app/Services",
        // Change here Repository folder
        'repositories_folder' => "app/Repositories",
        // Change here Controller folder
        'controller_folder' => "app/Http/Controllers",
        // No need to change this. changing this will do nothing
        'default_namespace' => 'App\\Console\\Commands',
    ];

```
