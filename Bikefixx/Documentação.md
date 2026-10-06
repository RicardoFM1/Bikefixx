# Backend Bikefix

## Como rodar:

Necessário instalar:
<p>
- Composer
<p>
- PHP: 8.4
<p>

```cmd
cd Bikefixx
composer i
php -S localhost:3000 -t public

```

## Tabela de rotas:

Usuário

| Rota           | Método |
|----------------|--------|
| /usuario       | GET    |
| /usuario/login | POST   |


---

Ordens

| Rota              | Método |
|-------------------|--------|
| /ordens           | GET    |
| /ordens/proprias  | GET    |
| /ordens/{ordemId} | GET    |
| /ordens           | POST   |
| /ordens           | PATCH  |
| /ordens/{ordemId} | DELETE |