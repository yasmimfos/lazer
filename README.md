<h1 align="center"> 
	Lazer 🥳
</h1>
<p align="center"> API REST para anotações de livros e filmes que deseja consumir no seu tempo livre! </p>

## 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:
- PHP 8.1
- Laravel 10
- Sanctum
-  PHPUnit

Para a construção e manipulação do banco de dados:
   - MySQL
   - ORM Eloquent

## 📝 Como executar o projeto

#### 🛣️ Clone o repositório
```bash
#SSH
git clone git@github.com:yasmimfos/lazer.git
```
```bash
#HTTPS
git clone https://github.com/yasmimfos/lazer.git
```

#### 🧭 Execute a instalação das dependências
```bash
composer install
```
 
#### 🎲 Configure as variáveis de ambiente

1. Copie o arquivo .env.example
2. Troque seu nome para .env
3. Especifique as suas informações sobre o abnco de dados

#### 🧭 Execute a aplicação
```bash
php artisan serve
```


### 🧙‍♂️ Importe o arquivo do POSTMAN 
Este aquivo já está configurado com as rotas, o body das requisições e com a captação automática do token para autenticação das rotas após login. <br>
É só copiar este <a href="https://api.postman.com/collections/29394664-1d4a221b-09b9-44c0-9df7-e3d1aeda6722?access_key=PMAT-01HGKJ4PS4VS08TBNF8198KNNR">LINK</a>. 

### :computer: Endpoints

### :sunglasses:  Usuários
- POST /users - Cria um usuário
- POST /login - Login do usuário
>  Todas as rotas de susários a partir desse ponto, precisam do token gerado no login, assim como todas as rotas de livros e filmes.
- GET /users - Lista todos os usuários
- GET /users/{id} - Busca o usuário do id indicado
- PUT /users/{id} - Altera o usuário do id indicado
- DELETE /users/{id} - Deleta o usuário do id indicado
- POST /logout - Desativa token criado no login

### :book: Livros
- GET /books - Lista todos os livros cadastrados
- GET /books/{id} - Busca o livro com o id indicado
- PUT /books/{id} - Altera o livro do id indicado
- DELETE /books/{id} - Deleta o livro com id indicado

### :movie_camera: Filmes
- GET /movies - Lista todos os filmes cadastrados
- GET /movies/{id} - Busca o filme com o id indicado
- PUT /movies/{id} - Altera o filme do id indicado
- DELETE /movies/{id} - Deleta o filme com o id indicado



