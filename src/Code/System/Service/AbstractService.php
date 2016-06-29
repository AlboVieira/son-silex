<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 19:32
 */

namespace Code\System\Service;


use Code\System\Entity\Interfaces\EntityInterface;
use Code\System\Mapper\AbstractMapper;

class AbstractService
{
    /** @var EntityInterface  */
    protected $entity;

    /** @var AbstractMapper  */
    protected $mapper;


    public function __construct(EntityInterface $entity, AbstractMapper $mapper)
    {
        $this->entity = $entity;
        $this->mapper = $mapper;
    }

    public function findById($id, $fieldId = 'id'){
        return $this->mapper->findBy([$fieldId => $id]);
    }

    public function findAll(){
        return $this->mapper->findAll();
    }

    public function findAllAsArray(){
        return (array) $this->mapper->findAll();
    }
}