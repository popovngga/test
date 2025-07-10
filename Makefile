DOCKER_COMPOSE=docker-compose
CONTAINER_APP=app

init:
	@if [ ! -f .env ]; then cp .env.example .env; fi
	@USER_UID=$$(id -u); \
	 USER_GID=$$(id -g); \
	 grep -q "^USER_UID=" .env && sed -i "s/^USER_UID=.*/USER_UID=$$USER_UID/" .env || echo "USER_UID=$$USER_UID" >> .env; \
	 grep -q "^USER_GID=" .env && sed -i "s/^USER_GID=.*/USER_GID=$$USER_GID/" .env || echo "USER_GID=$$USER_GID" >> .env
	$(DOCKER_COMPOSE) up -d --build

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down
