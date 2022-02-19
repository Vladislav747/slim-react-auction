docker-compose run --rm api-php-cli composer create-project slim/slim-skeleton slim
sudo rm -rf api/slim
docker-compose run --rm api-php-cli composer init
docker-compose exec api-php-cli composer create-project slim/slim-sketeton slim

### make {command_from_makefile}

###Запустить проект docker
 ```docker
  docker-compose up -d
  ```

### Фронтенд запускается на 8080 порту - проверь что там ничего другого нет
localhost:8080
