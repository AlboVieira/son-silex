<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 19:32
 */

namespace Code\Sistema\Service;


use Code\Sistema\Entity\Interfaces\EntityInterface;
use Code\Sistema\Mapper\AbstractMapper;

class AbstractService
{
    protected $entity;
    protected $mapper;
    /**
     * ClienteService constructor.
     * @param $cliente
     */
    public function __construct(EntityInterface $entity, AbstractMapper $mapper)
    {
        $this->entity = $entity;
        $this->mapper = $mapper;
    }
}