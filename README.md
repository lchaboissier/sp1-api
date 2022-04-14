Pour mettre en place l'api : 

composer require laravel/passport

php artisan migrate:fresh --seed

Si jamais nous avons une erreur "duplicate entry" refaire la commande precedente,
car la fabrication du seeder est aléatoire, il peut donc y avoir plusieurs fois
les mêmes valeurs dans la création des "dammages" et on veut qu'elles soient uniques.

php artisan passport:install (à faire impérativement après chaque migration)

php artisan key:generate

php artisan serve --host 0.0.0.0 (pour pouvoir accéder en distant) -> accédé par l'adresse ip de l'API et port 8000

https://stackoverflow.com/questions/28956911/how-can-i-access-my-laravel-app-from-another-pc/32880333
