DROP DATABASE IF EXISTS passeio;
CREATE DATABASE passeio;
 USE passeio;

   CREATE TABLE participantes (
    IDClientes INT PRIMARY KEY,
	Nome VARCHAR(100),
    data_nascimente VARCHAR(100),
	Telefone INT,
    email VARCHAR(100),
    senha INT,
    visivel BOOlEAN
     );    
   
CREATE TABLE administradores (
    IDadiministradores INT PRIMARY KEY,
     Nome VARCHAR(100),
     senha INT
     ); 
     
 CREATE TABLE categoria (
    IDLcategoria INT PRIMARY KEY,
    categoria VARCHAR(100)
     );

CREATE TABLE subcategoria (
    IDsubcategoria INT PRIMARY KEY,
	subcategoria VARCHAR(100)
);    
