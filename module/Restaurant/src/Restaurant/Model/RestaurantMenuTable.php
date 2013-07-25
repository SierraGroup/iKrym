<?php
namespace Restaurant\Model;
use Restaurant\Model\Restaurant;
use Zend\Db\TableGateway\TableGateway;

class RestaurantMenuTable{
    protected $tableGateway;
    protected $resultSet;
    public  function __construct(TableGateway $tableGateway){
        $this->tableGateway = $tableGateway;
    }

    public function getMenu(){

    }
    public  function fetchAll(){
        $resultSet =   $this->tableGateway->select();
        return $resultSet;

    }

    public function getRestaurantMenu($restaurant_menu_id){
        $restaurant_menu_id= (int)$restaurant_menu_id;
        $resultSet = $this->tableGateway->select(array('restaurant_menu_id' =>$restaurant_menu_id));
        $row = $resultSet->current();
        return $row;
    }

    public  function getRestaurantMenuByNameId($restaurant_id_name){
        /*
         *      SELECT restaurant_menu_type
                FROM  `restaurant_menu`
                WHERE restaurant_id_name =  'grilbar'
         */
        $restaurant_id_name = (string)$restaurant_id_name;

        $rowset = $this->tableGateway->select(array('restaurant_id_name' => $restaurant_id_name));
        return $rowset;
    }
    public  function saveRestaurantMenu(RestaurantMenu $restaurant){
        $data = array(
            'restaurant_menu_id' => $restaurant->restaurant_menu_id,
            'restaurant_id_name' => $restaurant->restaurant_id_name,
            'restaurant_menu_type_image' => $restaurant->restaurant_menu_type_image,
            'restaurant_menu_type' => $restaurant->restaurant_menu_type,


        );
        $restaurant_menu_id = (int)$restaurant->restaurant_menu_id;
        if($restaurant_menu_id){
            $this->tableGateway->insert($restaurant_menu_id);
        }
        else{
            if($this->getRestaurantMenu($restaurant_menu_id)){
                $this->tableGateway->update($data,array('restaurant_menu_id' => $restaurant_menu_id));
            }
            else{
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function deleteRestaurantMenu($restaurant_menu_id){
        $this->tableGateway->delete(array('restaurant_menu_id' => $restaurant_menu_id));
    }

}