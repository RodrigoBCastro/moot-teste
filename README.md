# Projeto de Busca com Filtros - Laravel Livewire

Este é um projeto de exemplo que implementa um mecanismo de busca de produtos com filtros combinados (nome, categoria e marca) utilizando Laravel e Livewire. O ambiente de desenvolvimento é totalmente containerizado com Docker.

## Critérios Atendidos

-   Código limpo e organizado.
-   Busca combinada com lógica `E` e `OU`.
-   Filtros persistentes na URL.
-   Funcionalidade para limpar filtros.
-   Base de dados com `Migrations`, `Factories` e `Seeders`.
-   Testes de feature automatizados com PHPUnit.

## Pré-requisitos

-   Docker
-   Docker Compose

## Como Executar o Projeto

1.  **Clonar o Repositório**
    ```bash
    git clone [https://github.com/RodrigoBCastro/moot-teste.git](https://github.com/RodrigoBCastro/moot-teste.git)
    cd moot-teste
    ```

2.  **Configurar o Ambiente**
    Copie o arquivo de exemplo de ambiente e dê as permissões corretas para o Docker poder escrever nos logs.
    ```bash
    cp .env.example .env
    sudo chown -R $USER:www-data storage bootstrap/cache
    sudo chmod -R 775 storage bootstrap/cache
    ```
    *Obs: No arquivo `.env`, certifique-se de que as variáveis `DB_HOST` e `DB_PORT` correspondem às do serviço do Docker:*
    ```
    DB_CONNECTION=pgsql
    DB_HOST=db_moot
    DB_PORT=5432
    DB_DATABASE=moot
    DB_USERNAME=moot
    DB_PASSWORD=moot
    ```

3.  **Iniciar os Containers Docker**
    ```bash
    docker compose up -d --build
    ```

4.  **Instalar Dependências e Configurar o Laravel**
    Acesse o container da aplicação e execute os comandos de setup.
    ```bash
    docker exec -it laravel_moot bash

    # Dentro do container:
    composer install
    php artisan key:generate
    php artisan migrate --seed
    npm install
    npm run build
    ```

5.  **Acessar a Aplicação**
    Abra seu navegador e acesse: [http://localhost:8080](http://localhost:8080)

## Rodando os Testes

Para executar a suíte de testes automatizados, rode o seguinte comando no seu terminal (fora do container):
```bash
docker exec -it laravel_moot php artisan test
```
