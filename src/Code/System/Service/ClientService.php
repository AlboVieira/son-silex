<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:16
 */

namespace Code\System\Service;

use Code\System\Entity\Customer;

class ClientService extends AbstractService
{
    /**
     * @param $client
     * @return array
     */
    public function insert(array $client){

        $this->entity->setName($client['nome']);
        $this->entity->setEmail($client['email']);

        return $this->mapper->insert($this->entity);
    }

    public function findAll(){

    }
}