# Desafio técnico

## Descrição

O objetivo deste teste é apenas avaliar suas competências, tente encaixar o desafio dentro do seu
tempo livre, não sofra sozinho e nem perca seu sono, sua saúde mental vale mais do que qualquer outra coisa.

Fique tranquilo, leia tudo e qualquer dúvida ou problema, estamos disponíveis para te ajudar.


## Requisitos

### Pontos essenciais:
  * PHP 8.1;
  * Laravel 10;
  * Banco de dados MySql ou Mongodb
  * Criar um projeto público no github com a solução do desafio

### Pontos extras:
  * Utilizar docker.
  * Criar pipeline no Github actions para rodar os testes automáticos.

### Desafio:
Desenvolver uma api Rest para controle das notas fiscais dos usuários.

  * Criar endpoints para cadastro e login dos usuários.
  * Criar CRUD para o gerenciamento das notas fiscais:
    * As api’s das notas fiscais só podem ser acessadas por usuários autenticados.
    * Cada nota só pode ser acessada pelo usuário que a criou.
    * A cada nota fiscal criada, disparar um email para o usuário que a criou.
  * Fazer devidos retornos de response e http status code.

### Recomendações:
O teste pode ser feito da forma como preferir, porém aqui vão algumas recomendações.

* Fazer as validações dos campos das api’s utilizando Form request .
* Fazer camada de transformação dos dados utilizando Api Resources .
* Fazer camada de restrição de acesso utilizado Polices e/ou Gates .
* Utilizar Notifications para disparar os emails e colocar em uma Fila para os disparar de forma assíncrona.
* Desenvolver testes automatizados.
* Fazer documentação da api utilizando Postman , Swagger ou outras ferramentas de sua preferência.


## Instalando o projeto

O projeto se utiliza de contêineres Docker, através do pacote *Laravel Sail* para facilitar a configuração do ambiente de desenvolvimento. Portanto, é necessário que já possua o Docker e o Docker Compose instalados na máquina.

### Passos para o rodar o projeto localmente:

- Faça um clone do projeto para sua máquina local
- Crie um arquivo `.env`, recomendamos usar `.env-example` como base
- Adicione ou altere as chaves conforme sua necessidade
- acesse a pasta do projeto via console (terminal/PowerShell/CMD)
- execute o comando:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
 ```
- Após finalizado processamento, execute o comando `./sail up -d`

O primeiro comando realiza a instalação dos pacotes via composer especificados no arquivo `composer.json` e uma vez que a instalação termina, a pasta *vendor* passa a ficar disponível no projeto. O comando seguinte levanta os contêineres baseado na descrição de serviços feita no arquivo `docker-compose.yml`.

Por padrão, não é necessária nenhuma configuração no arquivo *.env* do projeto. Caso seja necessária alguma edição na configuração padrão (relacionado a binding ports ou credenciais de banco de dados), basta editar o arquivo *.env*.
