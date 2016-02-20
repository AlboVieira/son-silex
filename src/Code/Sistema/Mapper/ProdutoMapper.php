<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:17
 */

namespace Code\Sistema\Mapper;
use Code\Sistema\Entity\Produto;

class ProdutoMapper extends AbstractMapper
{

    protected $table = 'produto';

    public function insert(Produto $produto){

        $values = ["'{$produto->getId()}'",  "'{$produto->getNome()}'", "'{$produto->getDescricao()}'",$produto->getValor()];
        $this->persist(self::getFields(),$values);
        $result = $this->flush();
        if($result){
            return [
                'success' => true
            ];
        }else{
            return [
                'success' => false
            ];
        }
    }

    public function update(Produto $produto){

        $values = ["'{$produto->getNome()}'", "'{$produto->getDescricao()}'",$produto->getValor()];
        $fieldsValue = array_combine(self::getFields(false),$values);

        $this->merge($fieldsValue,['id' => $produto->getId()]);
        $result = $this->flush();
        if($result){
            return [
                'success' => true
            ];
        }else{
            return [
                'success' => false
            ];
        }
    }

    public function excluir($id){
        $result = $this->delete($id);
        if($result){
            return [
                'success' => true
            ];
        }else{
            return [
                'success' => false
            ];
        }
    }

    public static function getFields($withId = true){
        return $withId == true ? ['id','nome','descricao
        ','valor'] : ['nome','descricao','valor'];
    }
}