## Lojinha PHP

Este é um projeto para apresentação na displina de Linguagem de Programação 2 pela Fatec Bauru.  
O projeto visa em apresentar uma loja online simples, com um carrinho de compras e uma área administrativa para inclusão de produtos.

## Instruções de uso

- Clone esse repositório ou baixe o arquivo .zip e descompacte onde desejar.  
  `git clone https://github.com/thicsilva/lojinhaphp.git nomedapastadesejada`
- É necessário rodar o **composer** para que seja gerado o autoload. Navegue até a pasta do projeto pelo seu terminal/prompt e digite:  
  `composer install`
- Importe o arquivo **`db.sql`** pelo PHPMyAdmin, ou algum cliente visual para MySQL. Caso tenha a variável MYSQL configurada no seu ambiente de desenvolvimento, é possível importar através da linha de comando  
  `mysql -u usuario -psenha < db.sql`
- Renomeie o arquivo `Config.example.php` na pasta `src` para `Config.php`.
- Configure o acesso ao banco de dados na seção **DATABASE** no arquivo **`src/Config.php`**.
- Caso esteja utilizando XAMPP (ou algum semelhante), copie a pasta do projeto para dentro da pasta **`htdocs`** (ou equivalente), e então poderá navegar através do endereço
  `http://localhost/pastadoprojeto/public`
