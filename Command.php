<?php

class Command {    
   
  private $contactManager;

  public function __construct(ContactManager $contactManager) // Le constructeur de la classe prend une instance de ContactManager en paramètre et l'assigne à la propriété contactManager
  {
    $this->contactManager = $contactManager;
  }

  public function list (): void
  {
    $contacts = $this->contactManager->findAll();
    foreach ($contacts as $contact) {
      echo $contact->toString() . "\n";
    }
  }

  public function detail($contactId): void
  {
    $contact = $this->contactManager->findById($contactId);
    if($contact) {
      echo $contact->toString() . "\n";
    } else {
      echo "Contact not found.\n";
    }
  }

  public function create($command): void {

    if(preg_match("/^create (.+), (.+), (.+)$/", $command, $matches)) {
      $name = trim($matches[1]);
      $email = trim($matches[2]);
      $phoneNumber = trim($matches[3]);

    // Créer le nouveau contact avec les informations fournies
    $newContact = new Contact(null, $name, $email, $phoneNumber);

    // Ajouter le nouveau contact à la base de données via le ContactManager
    $createContact = $this->contactManager->create($newContact);

    if($createContact) {
      echo "Contact created successfully.\n";
  } else {
      echo "An error occurred when creating a contact.\n";
  }
  } else {
    echo "Invalid format of contact.\n";
  }
} 

public function delete ($contactId): void {
  $deleted = $this->contactManager->delete($contactId);
  if ($deleted) {
    echo "Contact deleted successfully.\n";
  }else {
    echo "Unable to delete contact.\n";
  }
}
}