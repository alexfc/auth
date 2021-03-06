##Laravel пакет для сквозной аутентификации и авторизации.

###Установка
Для установки в консоле пишем следующее:

`composer req s25/auth:dev-master --prefer-source`

после установки пакета и зависимостей, выполняем команду 

`php artisan vendor:publish --provider=S25\Auth\ThroughAuthServiceProvider`

В файле config/app.php подключить сервис провайдер \S25\Auth\ThroughAuthServiceProvider

Далее в файле config/auth.php меняем 
```      
'api' => [
    'driver' => 'token',
    'provider' => 'users'
],
```

на 

```      
'api' => [
    'driver' => 'jwt',
    'provider' => 'users',
    'hash' => false,
],
```

и меняем 

```      
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => User::class,
    ],
],
```

на

```      
'providers' => [
    'users' => [
        'driver' => 'redis',
        'model' => S25\Auth\User::class,
    ],
],
```

В файле app/Http/Kernel.php заменяем мидлварь auth на \S25\Auth\Middleware\Authenticate::class
