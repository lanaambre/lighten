<?php

namespace src\Entity;

use components\ORM\OrmTable;

class Message extends OrmTable
{
  protected $table = 'messages';

  protected $id;
  protected $content;
  protected $userId;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function setContent($content)
  {
    $this->content = $content;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }
}
