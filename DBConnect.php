<?php

class DBConnect //une classe pour se connecter a la base de donnees
{
  private $connection;

  public function __construct(){  //__construct() est appelé lorsqu'une instance de la classe est créée.

    try{
      $this->connection = new PDO(
        sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', MYSQL_HOST, MYSQL_PORT, MYSQL_NAME),
        MYSQL_USER,
        MYSQL_PASSWORD
      );
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $exception){
      die('Error : ' . $exception->getMessage());
    }
  }
  public function getPDO()  //une méthode publique getPDO() qui renvoie l'instance de la connexion PDO
  {
    return $this->connection;
  }
}

$db = new DBConnect();  //Pour tester la méthode findAll() - une instance de DBConnect pour obtenir la connexion à la base de données.