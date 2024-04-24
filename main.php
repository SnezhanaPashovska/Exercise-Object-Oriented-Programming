<?php
require_once 'config.php';
require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';
require_once 'Command.php';


$db = new DBConnect();  // une instance de DBConnect pour obtenir la connexion à la base de données.
$contactManager = new ContactManager($db->getPDO());  // On utilise cette connexion pour creer une instance ContactManager

$command = new Command($contactManager);

while (true) {
  $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : "); //expressions régulières pour identifier différentes commandes que l'utilisateur peut entrer
  if (preg_match("/^detail (\d+)$/", $line, $matches)) {
    $contactId = intval($matches[1]);
    $command->detail($contactId);
  } elseif ($line === 'list') {
    $command->list();
  } elseif (preg_match("/^create (.+), (.+), (.+)$/", $line, $matches)) {
    $command->create($line);
  } elseif (preg_match("/^delete (\d+)$/", $line, $matches)) {
    $contactId = intval($matches[1]);
    $command->delete($contactId);
  } elseif ($line === 'quit') {
    break;
  }
   else {
    echo "Unrecognised command : $line\n";
    echo "Vous avez saisi : $line\n";
  }
  
}










