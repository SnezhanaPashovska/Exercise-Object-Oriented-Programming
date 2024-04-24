<?php


class ContactManager{  

private $db;

public function __construct(PDO $db)  //ContactManager prend une instance de connexion PDO $db en paramètre de son constructeur pour utiliser la meme connexion à la basse de donnees
{
  $this->db = $db;
}

public function findById($contactId) {   // Cette méthode prend l'ID d'un contact en paramètre, exécute une requête SQL pour récupérer les données du contact correspondant dans la base de données, puis crée et retourne un nouvel objet Contact avec ces données.
  $findContact = $this->db->prepare ("SELECT * FROM contact WHERE id = ?");
  $findContact->execute([$contactId]);
  $contactData = $findContact->fetch(PDO::FETCH_ASSOC);

  if($contactData) {
    return new Contact($contactData['id'], $contactData['name'], $contactData['email'], $contactData['phone_number']);
  } else {
    return null;
  }
}

public function findAll()
{
  try {                                               //connexion bdd
    $query = $this->db->query('SELECT * FROM contact');
    $contactsData = $query->fetchAll(PDO::FETCH_ASSOC);
    $contacts = [];

    foreach ($contactsData as $contactData){
      $contact = new Contact();
      $contact->setId($contactData['id']);
      $contact->setName($contactData['name']);
      $contact->setEmail($contactData['email']);
      $contact->setphoneNumber($contactData['phone_number']);
      $contacts[] = $contact;
    }
    return $contacts;
    
  } catch(PDOException $exception) {
    die('Error : '. $exception->getMessage());
  }
}

//creer un contact

public function create(Contact $contact) {
  $insertContact = $this->db->prepare("INSERT INTO contact(name, email, phone_number) VALUES (?, ?, ?)");
  $success = $insertContact->execute([$contact->getName(), $contact->getEmail(), $contact->getPhoneNumber()]);

  if($success) {
    return true;
  } else {
    return false;
  }
}

public function delete($contactId) {
  $deleteContact = $this->db->prepare("DELETE FROM contact WHERE id = ?");
  $success = $deleteContact->execute([$contactId]);

  if($success) {
    return true;
  } else {
    return false;
  }
}

}
$contactManager = new ContactManager($db->getPDO());  // On utilise cette connexion pour creer une instance ContactManager
