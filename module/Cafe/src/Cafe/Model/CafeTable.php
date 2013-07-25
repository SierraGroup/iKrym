<?php
namespace Cafe\Model;
use Zend\Db\TableGateway\TableGateway;

class CafeTable{
    protected $tableGateway;
    public  function __construct(TableGateway $tableGateway){
        $this->tableGateway = $tableGateway;
    }
    public  function fetchAll(){
        $resultSet =   $this->tableGateway->select();
        return $resultSet;

    }
    public function getCafe($id){
        $cafe_id = (int)$id;
        $resultSet = $this->tableGateway->select(array('cafe_id' => $cafe_id));
        $row = $resultSet->current();
        return $row;
    }
    public  function getCafeByIdName($cafe_id_name){
        $cafe_id_name = (string)$cafe_id_name;
        $rowset = $this->tableGateway->select(array('cafe_id_name' => $cafe_id_name));
        $row = $rowset->current();
        return $row;
    }
    public  function saveCafe(Cafe $cafe){
        $data = array(

            'cafe_id_name' => $cafe->cafe_id_name,
            'cafe_name' => $cafe->cafe_name,
            'cafe_description' => $cafe->cafe_description,
            'cafe_thumbnail' => $cafe->cafe_thumbnail,
            'cafe_image_1' => $cafe->cafe_image_1,
            'cafe_image_2' => $cafe->cafe_image_2,
            'cafe_image_3' => $cafe->cafe_image_3,
            'cafe_average_account' => $cafe->cafe_average_account,
            'cafe_directions' => $cafe->cafe_directions,
            'cafe_work_time' => $cafe->cafe_work_time,
            'cafe_telephone' => $cafe->cafe_telephone,
            'cafe_address' => $cafe->cafe_address,
            'cafe_site' => $cafe->cafe_site,
            'cafe_longitude' => $cafe->cafe_longitude,
            'cafe_latitude' => $cafe->cafe_latitude,
            'cafe_vk' => $cafe->cafe_vk,
            'cafe_facebook' => $cafe->cafe_facebook,
            'cafe_foursquare' => $cafe->cafe_foursquare,
            'cafe_google_plus' => $cafe->cafe_google_plus,
            'cafe_features' => $cafe->cafe_features,
        );
        $cafe_id = (int)$cafe->cafe_id;
        if($cafe_id == 0){
            $this->tableGateway->insert($data);
        }
        else{
            if($this->getCafe($cafe_id)){
                $this->tableGateway->update($data,array('cafe_id' => $cafe_id));
            }
            else{
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function deleteCafe($cafe_id){
        $this->tableGateway->delete(array('cafe_id' => $cafe_id));
    }

}