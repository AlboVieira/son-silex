<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:17
 */

namespace Code\Sistema\Mapper;
use Code\System\Entity\Customer;

class ClienteMapper extends AbstractMapper
{

    public function insert(Customer $cliente){
        return
            [ 'nome' => $cliente->getName(), 'email' => $cliente->getEmail()];
    }
}