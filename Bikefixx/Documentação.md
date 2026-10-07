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

| Rota           | Método | Perfil | Autenticação |
|----------------|--------|--------|
| /usuario       | GET    |  Nenhum  |
| /usuario/login | POST   |  Guest      |


---

Ordens

| Rota              | Método | Perfil            | Status Esperado |
|-------------------|--------|-------------------|-----------------|
| /ordens           | GET    | Admin, Mecanico   | 200             |
| /ordens/proprias  | GET    | Cliente, Mecanico | 200             |
| /ordens/{ordemId} | GET    | Admin             | 200             |
| /ordens           | POST   | Mecanico, Admin   | 201             |
| /ordens/{ordemId} | PATCH  | Mecanico, Admin   | 200             |
| /ordens/{ordemId} | DELETE | Admin             | 200             |