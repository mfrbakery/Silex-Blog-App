<?php
namespace MyApp\Model\Manager{
  
  use MyApp\Model\Entity\Comment;
  use MyApp\Model\Entity\User;

  interface ISpamManager{

    function ipIsSpammer($ip);

  }
}