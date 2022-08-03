# Instalace 

##verze

- potřeba php 7.4.*
- composer install
- spust "symfony serve" nebo php buildin server pomocí příkazu "php -S localhost:8000"
- vytvoř databázi "blueghost" a nastav v .env

## Migace a data
```
- php bin/console doctrine:migrations:migrate  
- php bin/console doctrine:fixtures:load
```

## Assety
- node v14.17.0
- npm install
- npm run build
