Author: Jordi Donadeu - donadeuj@gmail.com

## System requirements
- Linux, Mac or Windows
- Docker
- Docker compose

## Execution
- docker-compose up -d
- docker exec -it vending_app bash
- composer update
- php start-vending.php

## Running tests
- Run `./vendor/bin/phpunit tests` inside the container

## Approach
The application has been modeled using the State design pattern using two states: Ready and Service.
More states can be implemented but only these two have been chosen for simplicity purposes.

Error handling is mainly managed by throwing and catching exceptions.

## Further improvements
- Add more states: For example, 'Dispensing an item' might be a state itself during which most operations are not allowed.
- Add tests to the State objects.
- Remove 'print' instructions from VendingMachine model.

## Note for Windows users
Windows users might have to replace 

``system('clear');`` with ``system('cls');``

in ./start-vending.php (near the top)