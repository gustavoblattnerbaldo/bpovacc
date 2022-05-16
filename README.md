# BPO -VACC ------------> Ticket´s
Sistema consiste em Gerenciamento de Ticket de Chamados (Solicitações de serviços que poderam ser acompanhados
Via sistema)
Modulos
-------------------
1 - Cadastros 
1.1 - Clientes 
1.2 - Funcionarios
1.3 - Empresa
1.4 - Departamentos
-------------------
2 - Movimentação 
2.1 - Abertura de solicitação pelo Cliente
2.2 - Acompanhamento por Status
2.3 - Fechamento pelo responsavel.
--------------------
3 - Relatórios e Estatisticas
3.1 - Dashboard de acompanhamento.
3.2 - Relatorios Gerenciais.
___________________________________________________________________________________________________________
Requisitos: 
Servidor Linux com cPanel (cPanel.net)
Apache, Php 5.4 a 5.5, Banco MySQL, phpMyAdmin 
Acesse o cPanel - o gerenciador de Banco de dados MySQL, crie o Banco de Dados MySQL, o Usuário de acesso ao 
banco + senha, depois atribua todas as permissões do usuário ao Banco. 
_____________________________________________________________________________________________________________
Abra o phpMyAdmin, selecione o banco que criou e importe a base de dados que está dentro da pasta /INSTALACAO 
Arquivo de conexão com o banco: 
Na pasta /Script, acesse: 
/app/config/database.php 
Edite as informações do banco de dados, usuário e senha para conexão com o banco entre as linhas 57 a 60 depois 
salve e feche. 
 'mysql' => array( 
 'driver' => 'mysql', 
 'host' => 'localhost', //Geralmente por padrão é localhost, mas dependendo da hospedagem pode ser 
outro endereço. 
 'database' => 'USUARIOCPANEL_BANCO',
 'username' => 'USUARIOCPANEL_USUARIO',
 'password' => 'SENHA',
 'charset' => 'utf8', 
 'collation' => 'utf8_unicode_ci', 
 'prefix' => '', 
 ) 
 ____________________________________________________________________________________________________________
Agora compacte o conteúdo da pasta /Script (.zip) e faça o upload deste arquivo zipado pelo Gerenciador de 
Arquivos do cPanel e assim que finalizar o upload descompacte o .zip lá pelo gerenciador mesmo.
