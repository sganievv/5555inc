up:
	docker-compose --env-file=".env" up -d

build:
	docker-compose --env-file=".env" up --build -d

down:
	docker-compose --env-file=".env" down

back_sh:
	docker-compose --env-file=".env" exec backend bash

back_sh_root:
	docker-compose --env-file=".env" exec -u root backend bash

front_sh:
	docker-compose --env-file=".env" exec frontend sh

nginx_sh:
	docker-compose --env-file=".env" exec nginx bash
