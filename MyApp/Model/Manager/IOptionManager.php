<?php
namespace MyApp\Model\Manager{
  use MyApp\Model\Entity\Option;
  interface IOptionManager{


    /**
     * return \MongoCursor
     */
    function getAll();

    /**
     * @return array
     */
    function getByName($name);

    /**
     * @return mixed
     */
    function get($name);

    /**
     * @return array
     */
    function getById($id);

    function set(Option $option);
  }
}