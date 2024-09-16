# Guia de Instalação e Execução do Sistema Laravel

Este guia irá orientá-lo na configuração e execução de um sistema Laravel. O banco de dados será iniciado utilizando o Docker Compose, que se encontra na mesma pasta do projeto.

## Pré-requisitos

-   [PHP 8.3](https://www.php.net/downloads.php) instalado
-   [Composer](https://getcomposer.org/download/) instalado
-   [Docker](https://docs.docker.com/get-docker/) e [Docker Compose](https://docs.docker.com/compose/install/) instalados

## Banco de dados

-   Para inicializar o banco de dados execute o comando:

```bash
   docker compose up
```

## Laravel/Backend

-   Para inicializar o backend execute o comando:

```bash
    composer install
    php artisan migrate && php artisan db:seed
    php artisan serve
```
