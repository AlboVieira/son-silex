<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:16
 */

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente;
use Code\Sistema\Entity\Interfaces\EntityInterface;
use Code\Sistema\Entity\Produto;
use Code\Sistema\Mapper\ClienteMapper;
use Code\Sistema\Mapper\ProdutoMapper;

class ProdutoService extends AbstractService
{
    /**
     * @param $cliente
     * @return array
     */
    public function insert(array $produto){
        /** @var Produto $produtoEntity */
        $produtoEntity = $this->entity;
        $produtoEntity->setNome($produto['nome']);
        $produtoEntity->setDescricao($produto['descricao']);
        $produtoEntity->setValor($produto['valor']);


        /** @var ProdutoMapper $mapper */
        $mapper = $this->mapper;
        $result = $mapper->insert($produtoEntity);

        return $result;
    }

    public function update(array $produto){

        $checkEntity = $this->findById($produto['id']);
        if($checkEntity){
            /** @var Produto $produtoEntity */
            $produtoEntity = $this->entity;
            $produtoEntity->setId($produto['id']);
            $produtoEntity->setNome($produto['nome']);
            $produtoEntity->setDescricao($produto['descricao']);
            $produtoEntity->setValor($produto['valor']);
        }else{
            return array('success' => false);
        }
        /** @var ProdutoMapper $mapper */
        $mapper = $this->mapper;
        $result = $mapper->update($produtoEntity);

        return $result;
    }

    public function excluir($id){

        $checkProduto = $this->findById($id);

        if($checkProduto){
            /** @var ProdutoMapper $mapper */
            $mapper = $this->mapper;
            $result = $mapper->excluir($id);
            return $result;
        }
        else{
            return array('success' => false);
        }


    }
}