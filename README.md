API Teste Back End Descrição Esta API foi desenvolvida com base no PHP 8.0, com o intuito de testar minhas habilidades com as stacks utilizadas.

# Requisitos 

PHP 8.0 ou superior 

Composer

Laravel 9.x 

Configuração:

Faça o clone do Repositório 
```
  git clone https://github.com/kevinkristiansantanaplus/Teste-Backend-v2
```

Instale as Dependências 
```
  composer install
```

# Configure o Ambiente

Copie o arquivo .env.example para .env e ajuste as variáveis conforme necessário. 
```
  cp .env.example .env
```

Altere as informações necessárias:
```
  APP_ENV=local 
  DB_CONNECTION=mysql
  DB_DATABASE=seudataabase
```
Gere a Chave de Aplicação 
```
  php artisan key:generate
```
Execute as Migrations
```
  php artisan migrate
```

# Configuração do JWT
Gere a chave secreta JWT:
```
  php artisan jwt:secret
```
Adicione o middleware JWT ao arquivo app/Http/Kernel.php.
Adicionando as seguintes linhas ao array middlewareGroups:
```
  'api' => [
      \App\Http\Middleware\EncryptCookies::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \App\Http\Middleware\VerifyCsrfToken::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
      \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
  ],
```
Atualize o arquivo de configuração .env com as variáveis JWT:
```
JWT_SECRET=chave_gerada_pelo_comando_anterior
```

# Uso da API

## Registrar um Novo Usuário 
Endpoint: /api/v1/auth/register 
Método: POST 
Body: 
```
{
  "name": "Nome Completo",
  "email": "email@example.com",
  "password": "sua-senha"
}
```
Resposta:
```
{
  "message": "Usuário registrado com sucesso"
}
```

## Autenticação 
Endpoint: /api/v1/auth/login 
Método: POST
Body: 
```
{
  "email": "seu-email@example.com",
  "password": "sua-senha"
}
```
Resposta: 
```
{
  "message": "Login realizado com sucesso.",
  "access_token": "eyJ0eXAiOiJKV1QiL....."
}
```

## Listar Todos os Usuários 
Endpoint: /api/v1/users 
Método: GET 
Cabeçalho de Requisição: Authorization: Bearer 
Resposta: 
```
'message' => 'Registros encontrados com sucesso.',
'body'    => [
  { 
    "id": 1, 
    "name": "Nome Completo", 
    "email": "email@example.com" 
  }, 
  { "id": 2, 
    "name": "Nome Completo 2", 
    "email": "email2@example.com" 
  } 
]
```

## Buscar Usuário pelo ID 
Endpoint: /api/v1/users/{id}
Método: GET 
Parâmetros: id (obrigatório) 
Cabeçalho de Requisição: Authorization: Bearer 
Resposta: 
```
{
  "id": 1,
  "name": "Nome Completo",
  "email": "email@example.com"
}
```

# Testes

# Configure o Ambiente de Teste

Crie o arquivo .env.test para configuração específica de teste: 
```
cp .env.example .env.test
```

Altere as informações
```
APP_ENV=local 
DB_CONNECTION=mysql
DB_DATABASE=:memory:
```

Execute as migrations
```
php artisan migrate --env=testing
```

Para rodar os testes, use o comando:
```
php artisan test
```
