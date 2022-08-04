# Instalace 

- potřebná verze php 7.4.*
- composer install
- vytvořte databázi "blueghost" a nastavte v .env

## Migace a data
```
 php bin/console doctrine:migrations:migrate  
 php bin/console doctrine:fixtures:load
```

## Assety
- node ve verzi v14.17.0

```
npm install
npm run build
```


## Spuštění

``` PHP
symfony serve //nebo
php -S localhost:8000
```

# Testing 

otestováno na PHPstan level 3
