## Sobre o Projeto

O projeto foi realizado em Laravel-Zero com MySQL, informações são extraídas de um arquivo chamado log.txt que contém vários json. Depois de extrair 
as informações as mesmas são adicionadas dentro de um banco de dados que chama-se backtest, após adicionado é possível gerar arquivos csv com as informações, 
são 3 tipos, por consumidor, serviços e tempo médio. Também foi utilizado o Docker para adicionar mais informações.


## Como executar o projeto?

- Baixe e instale o [composer](https://getcomposer.org/).

- Baixe e instale o [xampp](https://www.apachefriends.org/pt_br/index.html).  
Inicialize o Xampp e depois Apache e MySQL. 
Ou tenha em seu computador instalado o MySQL. [MySQL](https://www.mysql.com/downloads/).

- Para que possa executar os comandos é necessário que entre na pasta pelo CMD (Prompt de Comando) e execute o comando <code>composer install</code>.

- Crie a tabela com o nome de testback no seu MySQL.

- Após instalar o composer você terá duas alternativas para criar as tabelas no banco de dados.

	1. Importe a base que está na pasta BD no repositório.
	2. No CMD (Prompt de Comando) entre na pasta em que está o projeto e coloque <code>php application migrate</code>.
	Esse segundo comando irá criar as tabelas automaticamente no seu banco de dados (testback).

- Crie uma pasta no C: do seu computador chamada "importar" (sem aspas) e coloque dentro dela o arquivo logs.txt que deseja importar.
	Caso o arquivo for grande demais pode acarretar em estouro de memória, aconselhável que seja importado 5000 linhas por vez.
	Os arquivos gerados .csv também assim que gerados também serão salvaos na mesma com seus respectivos nomes.

- Para fazer a importação do arquivo (logs.txt) no CMD na pasta do projeto execute <code>php application informacao</code>.

- Para gerar o arquivo CSV das informações por consumidor execute <code>php application consumidor</code>.

- Para gerar o arquivo CSV das informações por serviços execute <code>php application servico</code>.

- Para gerar o arquivo CSV das informações por tempo médio execute <code>php application tempomedio</code>.

## Tecnologias utilizadas no projeto 

- [Php](http://php.net/docs.php)
- [Laravel-Zero](https://laravel-zero.com/)
- [MySQL](https://dev.mysql.com/doc/)

## Criador

Matheus Delgado Vieira