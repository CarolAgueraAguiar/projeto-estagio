# **PROJETO ECODE PARA AVALIAÇÃO**

**Este projeto está dividido em back-end e front-end. Desenvolvido para Agência Ecode. Para um possível estágio na empresa**


# **FRONT-END**

**As técnologias utilizadas são:**

- HTML
- CSS
- JS
- BOOTSTRAP

# **BACK-END**

- DOCKER
- PHP
- BANCO DE DADOS MYSQL

## Executando o Back-End

- Vá ao diretório raiz da pasta do projeto.
```
user@user:~/Área de Trabalho/projeto-ecode$ ls
user@user:~/Área de Trabalho/projeto-ecode$ bootstrap dependencias.php docker  img  index.php  logout.php  mysql  README.md  sql  verificarSessaoAdmin.php  verificarSessaoUser.php  views
```
- Abra o terminal e execute o comando para criar uma imagem mysql a partir do Dockerfile
```
docker build -t=mysql-image -f ./docker/mysql/Dockerfile .
```
- Ainda no terminal, execute o comando abaixo para criar uma imagem php a partir do Dockefile

```
docker build -t=php-image -f ./docker/php/Dockerfile .
```
- Execute no terminal o script que está na pasta mysql
```
user@user:~/Área de Trabalho/projeto-ecode$ ls
user@user:~/Área de Trabalho/projeto-ecode$ bootstrap dependencias.php docker  img  index.php  logout.php  mysql  README.md  sql  verificarSessaoAdmin.php  verificarSessaoUser.php  views
user@user:~/Área de Trabalho/projeto-ecode$ cd mysql
user@user:~/Área de Trabalho/projeto-ecode/mysql$ docker exec -it mysql-container bash
user@user:~/Área de Trabalho/projeto-ecode/mysql$ mysql -u root -p < /var/lib/mysql/script.sql
insira a senha: ecode
```
- Execute o comando abaixo para rodar o container mysql
```
sudo docker run -d --rm -v="$PWD"/mysql:/var/lib/mysql -p 3307:3306 --name mysql-container mysql-image
```
- Ainda no terminal, execute o comando abaixo para rodar o container php
```
sudo docker run -d --rm -v="$PWD":/var/www/html -p 8888:80 --name=php-container --link mysql-container php-image
```
#
## Executando o FRONT-END

- No navegador vá até o link http://localhost:8888

## **Agora só navegar pelo projeto**
