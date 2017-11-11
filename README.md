1. Criar banco de dados com nome "sort".
2. Criar tabela book com o comando abaixo:
CREATE TABLE `book` (
  `id`  int(11) NOT NULL AUTO_INCREMENT ,
  `title`  varchar(255) NULL ,
  `author`  varchar(255) NULL ,
  `edition_year`  int(4) NULL ,
  PRIMARY KEY (`id`)
);
3. Inserir os dados na tabela com o comando abaixo:
INSERT INTO `sort`.`book` (`id`, `title`, `author`, `edition_year`) VALUES ('1', 'Java How To Program', 'Deitel & Deitel', '2007');
INSERT INTO `sort`.`book` (`id`, `title`, `author`, `edition_year`) VALUES ('2', 'Patterns of Enterprise Application Architecture', 'Martin Fowler', '2002');
INSERT INTO `sort`.`book` (`id`, `title`, `author`, `edition_year`) VALUES ('3', 'Head First Design Patterns', 'Elisabeth Freeman', '2004');
INSERT INTO `sort`.`book` (`id`, `title`, `author`, `edition_year`) VALUES ('4', 'Internet & World Wide Web: How to Program', 'Deitel & Deitel', '2007');

4. Clonar o repositorio da API.
5. Instalar composer caso precise.
6. Rodar composer.phar para fazer download dos itens obrigatórios ao projeto.
7. Para iniciar o servidor PHP da API acessar no terminal cd caminho_até_a-pasta_do_projeto/web rodar o comando abaixo no seu terminal:
php -S localhost:8000
8. Servidor rodando e pronto para receber requisições.
9. Para requisições via POSTMAN utilizar a url: http://localhost:8000/sort/sort/admin
10. Para testar a Ordenação basta concatenar na url a "coluna=ordem", exemplo http://localhost:8000/sort/sort/admin?title=DESC caso queira enviar mais de uma coluna para ordenação, basta incluir exemplo: http://localhost:8000/sort/sort/admin?title=DESC?author=ASC