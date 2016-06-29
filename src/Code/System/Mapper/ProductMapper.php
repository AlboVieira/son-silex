<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 17:17
 */

namespace Code\System\Mapper;
use Code\System\Entity\Product;

class ProductMapper extends AbstractMapper
{

    protected $table = 'product';

    public function insert(Product $product){

        $values = ["'{$product->getId()}'",  "'{$product->getName()}'", "'{$product->getDescription()}'",$product->getPrice()];
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

    public function update(Product $product){

        $values = ["'{$product->getName()}'", "'{$product->getDescription()}'",$product->getPrice()];
        $fieldsValue = array_combine(self::getFields(false),$values);

        $this->merge($fieldsValue,['id' => $product->getId()]);
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

    public function deleteProduct($id){
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
        return $withId == true ? ['id','name','description','price'] : ['name','description','price'];
    }
}