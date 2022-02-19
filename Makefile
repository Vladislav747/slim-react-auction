init: docker-down docker-pull docker-build docker-up

init-ci:
	docker-down-clear \
	docker-pull docker-build docker-up \
	api-init frontend-init cucumber-init

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

build: build-gateway build-frontend build-api

build-gateway:
	docker --log-level=debug build --pull --file=gateway/docker/production/nginx/Dockerfile --tag=${REGISTRY}/auction-gateway:${IMAGE}

build-frontend:
	docker --log-level=debug build --pull --file=gateway/docker/production/nginx/Dockerfile --tag=${REGISTRY}/auction-frontend:${IMAGE}

build-api:
	docker --log-level=debug build --pull --file=gateway/docker/production/nginx/Dockerfile --tag=${REGISTRY}/auction-api:${IMAGE}

try-build:
	REGISTRY=localhost IMAGE_TAG=0 make build

push: push-gateway push-frontend push-api

push-gateway:
	docker push ${REGISTRY}/auction-gateway:${IMAGE_TAG}

push-frontend:
	docker push ${REGISTRY}/auction-frontend:${IMAGE_TAG}

push-api:
	docker push ${REGISTRY}/auction-api:${IMAGE_TAG}
	docker push ${REGISTRY}/auction-api-php-fpm:${IMAGE_TAG}
	docker push ${REGISTRY}/auction-api-php-cli:${IMAGE_TAG}

deploy:
  ssh ${HOST} -p ${PORT} 'rm -rf site_${BUILD_NUMBER}'
  ssh ${HOST} -p ${PORT} 'mkdir site_${BUILD_NUMBER}'
  ssh -P ${PORT} docker-compose-production.yml ${HOST}:site_${BUILD_NUMBER}/docker-compose-production.yml
  ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && echo "COMPOSE_PROJECT_NAME=auction" >> .env'
  ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && echo "REGISTRY=${REGISTRY}" >> .env'
  ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && echo "IMAGE_TAG=${IMAGE_TAG}" >> .env'
  ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml pull'
  ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml up --build --remove-orphans'
  ssh ${HOST} -p ${PORT} 'rm -f site'
  ssh ${HOST} -p ${PORT} 'ln -sr site_${BUILD_NUMBER} site'

rollback:
  ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml pull'
  ssh ${HOST} -p ${PORT} 'cd site_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yml up --build --remove-orphans'
  ssh ${HOST} -p ${PORT} 'rm -f site'
  ssh ${HOST} -p ${PORT} 'ln -sr site_${BUILD_NUMBER} site'
