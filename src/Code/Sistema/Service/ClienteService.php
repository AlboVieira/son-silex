<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:16
 */

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente;
use Code\Sistema\Mapper\ClienteMapper;

class ClienteService extends AbstractService
{
    /**
     * @param $cliente
     * @return array
     */
    public function insert(array $cliente){
        /** @var Cliente $clienteEntity */
        $clienteEntity = $this->entity;
        $clienteEntity->setNome($cliente['nome']);
        $clienteEntity->setEmail($cliente['email']);

        /** @var ClienteMapper $mapper */
        $mapper = $this->mapper;
        $result = $mapper->insert($clienteEntity);

        return $result;
    }

    public function findAll(){

    }
}