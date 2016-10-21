# Estrutura

## Entidades

1) Entidades 
    - App/Domain/Entity/

2) Interfaces das Entidades
    - App/Domain/Persistence/
    
3) Repositórios das Entidades
    - App/Infrastructure/Persistence/Doctrine/Repository/

4) Mapeamento das Entidades
    - App/Infrastructure/Persistence/Doctrine/ORM/

5) Registro dos repositórios
    - config/autoload/dependencies.global.php

6) Fixtures para testes
    - App/Infrastructure/Persistence/Doctrine/DataFixture/
    
## Forms

7) Form Filters
    - App/Application/InputFilter/

8) Forms
    - App/Application/Form/

9) Form Factories
    - App/Application/Form/Factory/

10) Registro dos Forms
    - config/autoload/form.global.php
    
## Páginas / Rotas

11) Páginas
    - App/Application/Action/
    - App/Application/Action/{Entidade}/

12) Factories das Páginas
    - App/Application/Action/
    - App/Application/Action/{Entidade}/Factory/

13) Registro de Rotas
    - config/autoload/routes.global.php
    - config/autoload/routes.api.global.php

14) Template das Páginas
    - templates/