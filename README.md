## Instruções para iniciar projeto

Criar .env e copiar o conteúdo presente em .env.example para o arquivo, editando as informações do banco de dados. Após isto inserir os comandos:
- composer install
- php artisan key:generate
- php artisan migrate --seed

Será criado um usuário com os seguintes dados:
 - email: adm@adm.com
 - senha: administrador
