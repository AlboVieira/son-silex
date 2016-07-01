<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:16
 */

namespace Code\System\Service;

class ProductService extends AbstractService
{

    public function insert(array $product){

        try{
            $this->validateData($product);

            $this->entity->setName($product['name']);
            $this->entity->setDescription($product['description']);
            $this->entity->setPrice($product['price']);

            return $this->mapper->insert($this->entity);
        }
        catch(\Exception $e){
            return ['success' => false,'message' => $e->getMessage()];
        }

    }

    public function update(array $product){

        try{
            $this->validateData($product);

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
        catch(\Exception $e){
            return ['success' => false,'message' => $e->getMessage()];
        }

    }

    public function delete($id){

        try{
            $checkProduct = $this->findById($id);
            if($checkProduct){
                $deleted = $this->mapper->delete($id);
                return array('success' => $deleted);
            }
            else{
                return array('success' => false);
            }
        }
        catch(\Exception $e){
            return ['success' => false,'message' => $e->getMessage()];
        }

    }

    public function validateData($data){

        if(empty($data['name']) || empty($data['description']) || empty($data['price'])){
            throw new \Exception('Data invalid!');
        }

        if(!is_numeric($data['price'])){
            throw new \Exception('Price must be numeric!');
        }

        return true;

    }

}