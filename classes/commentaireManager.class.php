<?php

class commentaireManager
{
  private $bdd; 
  private $result;
  private $message;
  private $commentaire;
  private $getLastInsertId;

  public function __construct(PDO $bdd)
  {
    $this->setBdd($bdd);
  }

  function getBdd()
  {
    return $this->bdd;
  }

  function getResult()
  {
    return $this->result;
  }

  function getMessage()
  {
    return $this->message;
  }

  function getCommentaire()
  {
    return $this->commentaire;
  }

  function getGetLastInsertId()
  {
    return $this->getLastInsertId;
  }

  function setBdd($bdd): void
  {
    $this->bdd = $bdd;
  }

  function setResult($result): void
  {
    $this->result = $result;
  }

  function setMessage($message): void
  {
    $this->message = $message;
  }

  function setCommentaire($commentaire): void
  {
    $this->commentaire = $commentaire;
  }

  function setGetLastInsertId($getLastInsertId): void
  {
    $this->getLastInsertId = $getLastInsertId;
  }
}
