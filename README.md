 # SIGE - Sistema de Gerenciamento Escolar

 - Version 0.10
 	- Database
		- Coluna status trocada para varchar(10) e foi adicionado a CONSTRAINT Check_Status;
		- Coluna sexo trocada para varchar(9) e foi adicionado a CONSTRAINT Check_Sexo;
		- Banco de dados de teste foi recriado com o nome linux_test.fdb;
		- Máximo de caracteres permitidos na senha mudou para 20 de 50;
		- Definido todos campos obrigatórios na tabela PESSOA;
		- Campo estado_civil da tabela PESSOA removido;