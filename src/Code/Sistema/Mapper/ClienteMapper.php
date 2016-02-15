<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:17
 */

namespace Code\Sistema\Mapper;
use Code\Sistema\Entity\Cliente;

class ClienteMapper extends AbstractMapper
{

    public function insert(Cliente $cliente){
        return
            [ 'nome' => $cliente->getNome(), 'email' => $cliente->getEmail()];
    }
}