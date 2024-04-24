<?php

class Contact 

{
  private $id;
  private $name;
  private $email;
  private $phoneNumber;

public function __construct($id = null, $name = null, $email =null, $phoneNumber = null)
{
  $this->id = $id;
  $this->name = $name;
  $this->email = $email;
  $this->phoneNumber = $phoneNumber;
}
  //id
  public function getId(): ?int 
  {
    return $this->id;
  }

  public function setId(?int $id): void
    {
        $this->id = $id;
    }

  //name
  public function getName(): ?string 
  {
    return $this->name;
  }

  public function setName(?string $name): void 
  {
    $this->name = $name;
  }

  //email
  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(?string $email): void 
  {
    $this->email = $email;
  }

  //phoneNumber
  public function getPhoneNumber(): ?string
  {
    return $this->phoneNumber;
  }

  public function setPhoneNumber(?string $phoneNumber): void 
  {
    $this->phoneNumber = $phoneNumber;
  }

  public function toString(): string 
  {
    return 'id: ' . $this->id . ', Name: ' . $this->name . ', Email: ' . $this->email . ', Phone number: '. $this->phoneNumber;
  }
}