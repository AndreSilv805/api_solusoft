

# Api Sistema de Vendas

Com cadastro de clientes, produtos, cadastro de vendas, geração de comprovante de vendas.

Este Sistema Controle Estoque foi feito com o Framework Laravel 5.6 e Banco de dados MySQL.

Para instalar esta aplicação.

 1. git clone https://github.com/AndreSilv805/api_solusoft.git
 2. Depois de baixado dentro da pasta use o comando composer install.
 3. Configure seu banco de dados com as suas credenciais no arquivo .env. 
 4.  Para criar as tabelas do banco de dados utilize: php artisan migrate
 5. Para rodar o projeto: php artisan serve

## Funcionalidades

* Cadastro de produtos
* Cadastro de cliente
* Comprovante de venda
* Envio de email comprovante de venda

## Configurar a conta de e-mail
No arquivo .env
```
axios.defaults.baseURL = 'substitua pelo endereço da api';
```