# event-calendar
Sistema para cadastros de eventos em calendario.

INSTROÇÕES PARA USO CORRETO DO SISTEMA
1- CRIE UM BANCO DE DADOS CHAMADO 'gerenciamento_eventos'
2- APÓS CRIAR O BD, RODE OS SEGUINTES COMANDOS SQL PARA CONFIGURAR AS TABELAS:
    ° CREATE TABLE events(
      id INT(11) PRIMARY KEY AUTO_INCREMENT,
      title VARCHAR(255) NOT NULL,
      color VARCHAR(20) NOT NULL,
      start DATETIME NOT NULL,
      end DATETIME NOT NULL,
      observation TEXT
    );
° CREATE TABLE events_backup (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  color VARCHAR(20) NOT NULL,
  start DATETIME NOT NULL,
  end DATETIME NOT NULL,
  observation TEXT
);

MODO DE USO:
1- PARA CADASTRAR UM EVENTO BASTA CLICAR EM ALGUMA DAS DATAS
2- PREENCHER O FORMULARIO COM OS DADOS DO EVENTO
3- EVENTO APARECERÁ NO CALENDARIO COM O TITULO E A COR ESCOLHIDA
4- AI CLICAR NO EVENTO CRIADO APARECERÃO MAIS DETALHES DO EVENTO
5- USUARIO PODERÁ EDITAR E DELETAR EVENTO A QUALQUER MOMENTO.
