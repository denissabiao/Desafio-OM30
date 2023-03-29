
# Setup para o desafio OM-30

### Passo a passo

Clone Repositório
```sh
git clone https://github.com/denissabiao/Desafio-OM30.git
```

comando para iniciar o docker
```sh
sh script-start.sh
```

Acessar o container para executar proximos comandos
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Executar migrations
```sh
php artisan migrate
```

Executar works queue
```sh
php artisan queue:work
```

Testes automatizados
```sh
./vendor/bin/phpunit
```

Api do Desafio 
[http://localhost:36885/api](http://localhost:36885/api)

Link do Desafio 
[https://github.com/OM30/desafio-OM30/blob/master/DesafioPHPBackendLaravel.md]

