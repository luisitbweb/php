DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS funcionarios;
DROP TABLE IF EXISTS menus;
DROP TABLE IF EXISTS perfis;
DROP TABLE IF EXISTS conteudos;
DROP TABLE IF EXISTS banners;

CREATE TABLE clientes (
  id int(11) NOT NULL AUTO_INCREMENT, 
  cpf_cnpj VARCHAR(14) NOT NULL,
  nome_razao VARCHAR(255) NOT NULL,
  email VARCHAR(60) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE perfis (
  id VARCHAR(10) NOT NULL,
  descricao VARCHAR(10) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE funcionarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(60) NOT NULL,
  prf_id VARCHAR(10) NOT NULL,
  nome VARCHAR(255) NOT NULL,
  senha VARCHAR(32) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT funcionarios_fk FOREIGN KEY (prf_id) REFERENCES perfis (id) ON UPDATE CASCADE
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE menus (
  id int(11) NOT NULL AUTO_INCREMENT,
  prf_id VARCHAR(10) NOT NULL,
  descricao VARCHAR(30) NOT NULL,
  link VARCHAR(100) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT menus_fk FOREIGN KEY (prf_id) REFERENCES perfis (id) ON UPDATE CASCADE
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE conteudos (
  id int(11) NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(60) NOT NULL,
  texto TEXT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE banners (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao VARCHAR(60) NOT NULL,
  imagem VARCHAR(60) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB CHARSET=utf8;

INSERT INTO perfis (id, descricao) VALUES ('admin', 'Admin');
INSERT INTO perfis (id, descricao) VALUES ('front', 'Frontend');

INSERT INTO funcionarios (email, prf_id, nome, senha) VALUES ('admin@dexter.com', 'admin', 'Administrador', MD5('123456')); 

INSERT INTO conteudos (titulo, texto) VALUES ('Sobre', 'Ipsum...');

INSERT INTO banners (descricao, imagem) VALUES ('Banner1', 'banner/1.jpg');
INSERT INTO banners (descricao, imagem) VALUES ('Banner2', 'banner/2.jpg');
INSERT INTO banners (descricao, imagem) VALUES ('Banner3', 'banner/3.jpg');
INSERT INTO banners (descricao, imagem) VALUES ('Banner4', 'banner/4.jpg');

INSERT INTO menus (prf_id, descricao, link) VALUES ('front', 'Início', 'index.php');
INSERT INTO menus (prf_id, descricao, link) VALUES ('front', 'Cadastre-se', 'index.php?modulo=Clientes&acao=cadastro');
INSERT INTO menus (prf_id, descricao, link) VALUES ('front', 'Tipos de Encomenda', 'index.php?modulo=TiposEncomendas&acao=listar');
INSERT INTO menus (prf_id, descricao, link) VALUES ('front', 'Rastrear Encomendas', 'index.php?modulo=Encomendas&acao=rastrear');
INSERT INTO menus (prf_id, descricao, link) VALUES ('front', 'Sobre', 'index.php?modulo=Conteudos&acao=exibir&id=1');
INSERT INTO menus (prf_id, descricao, link) VALUES ('admin', 'Clientes', 'admin.php?modulo=Clientes&acao=gerenciar');
INSERT INTO menus (prf_id, descricao, link) VALUES ('admin', 'Menus', 'admin.php?modulo=Menus&acao=gerenciar');
INSERT INTO menus (prf_id, descricao, link) VALUES ('admin', 'Conteudos', 'admin.php?modulo=Conteudos&acao=gerenciar');
INSERT INTO menus (prf_id, descricao, link) VALUES ('admin', 'Tipos de Encomenda', 'admin.php?modulo=TiposEncomendas&acao=gerenciar');
INSERT INTO menus (prf_id, descricao, link) VALUES ('admin', 'Encomendas', 'admin.php?modulo=Encomendas&acao=gerenciar');
INSERT INTO menus (prf_id, descricao, link) VALUES ('admin', 'Funcionarios', 'admin.php?modulo=Funcionarios&acao=gerenciar');
INSERT INTO menus (prf_id, descricao, link) VALUES ('admin', 'Banners', 'admin.php?modulo=Banners&acao=gerenciar');