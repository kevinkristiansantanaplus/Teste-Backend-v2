API Teste Back End
Descrição
Esta API foi desenvolvida com base no PHP 8.0 com o intuito de testar minhas habilidades com as stacks utilizadas.

Instruções de Uso
Requisitos
PHP 8.0 ou superior
Composer
Laravel 9.x
Configuração:

Faça o clone do Repositório
git clone https://seu-repositorio.git
cd Teste-Situacional-BackEnd

Instale as Dependências
composer install

Configure o Ambiente

Copie o arquivo .env.example para .env e ajuste as variáveis conforme necessário.
cp .env.example .env

Configure o Ambiente de Teste

Crie o arquivo .env.test para configuração específica de teste:
cp .env.example .env.test

Altere as informações necessárias:

APP_ENV=test
DB_CONNECTION=sqlite
DB_DATABASE=:memory:

Gere a Chave de Aplicação
php artisan key:generate

Execute as Migrations
php artisan migrate

Uso da API

Registrar um Novo Usuário
Endpoint: /api/v1/auth/register
Método: POST
Body:
{
  "name": "Nome Completo",
  "email": "email@example.com",
  "password": "sua-senha"
}

Resposta:
{
  "message": "Usuário registrado com sucesso"
}

Autenticação
Endpoint: /api/v1/auth/login
Método: POST

Body:
{
  "email": "seu-email@example.com",
  "password": "sua-senha"
}
Resposta:
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}

Listar Todos os Usuários
Endpoint: /api/v1/users
Método: GET
Cabeçalho de Requisição:
Authorization: Bearer <token>
Resposta:
[
  {
    "id": 1,
    "name": "Nome Completo",
    "email": "email@example.com"
  }
  {
    "id": 2,
    "name": "Nome Completo 2",
    "email": "email2@example.com"
  }
]

Buscar Usuário pelo ID
Endpoint: /api/v1/users/{id}
Método: GET
Parâmetros:
id (obrigatório)
Cabeçalho de Requisição:
Authorization: Bearer <token>
Resposta:
{
  "id": 1,
  "name": "Nome Completo",
  "email": "email@example.com"
}

Testes

Para rodar os testes, use o comando:

php artisan test