<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:16
 */

namespace Code\System\Service;

use Code\System\Entity\Customer;
use Code\System\Entity\Interfaces\EntityInterface;
use Code\System\Entity\Product;
use Code\System\Mapper\ProductMapper;

class ProductService extends AbstractService
{

    public function insert(array $product){


        $this->entity->setName($product['name']);
        $this->entity->setDescription($product['description']);
        $this->entity->setPrice($product['price']);

        return $this->mapper->insert($this->entity);
    }

    public function update(array $product){

        $checkEntity = $this->findById($product['id']);
        if($checkEntity){
            $this->entity->setId($product['id']);
            $this->entity->setName($product['name']);
            $this->entity->setDescription($product['description']);
            $this->entity->setPrice($product['price']);
        }else{
            return array('success' => false);
        }

        return $this->mapper->update($this->entity);
    }

    public function delete($id){

        $checkProduct = $this->findById($id);
        if($checkProduct){
            $deleted = $this->mapper->delete($id);
            return array('success' => $deleted);
        }
        else{
            return array('success' => false);
        }
    }

}