<?php
namespace Club\Model;
use Zend\Db\TableGateway\TableGateway;

class ClubTable{
    protected $tableGateway;
    public  function __construct(TableGateway $tableGateway){
        $this->tableGateway = $tableGateway;
    }
    public  function fetchAll(){
        $resultSet =   $this->tableGateway->select();
        return $resultSet;

    }
    public function getClub($id){
        $club_id = (int)$id;
        $resultSet = $this->tableGateway->select(array('club_id' => $club_id));
        $row = $resultSet->current();
        return $row;
    }
    public  function getClubByIdName($club_id_name){
        $club_id_name = (string)$club_id_name;
        $rowset = $this->tableGateway->select(array('club_id_name' => $club_id_name));
        $row = $rowset->current();
        return $row;
    }
    public  function saveClub(Club $club){
        $data = array(

            'club_id_name' => $club->club_id_name,
            'club_name' => $club->club_name,
            'club_description' => $club->club_description,
            'club_thumbnail' => $club->club_thumbnail,
            'club_image_1' => $club->club_image_1,
            'club_image_2' => $club->club_image_2,
            'club_image_3' => $club->club_image_3,
            'club_average_account' => $club->club_average_account,
            'club_directions' => $club->club_directions,
            'club_work_time' => $club->club_work_time,
            'club_telephone' => $club->club_telephone,
            'club_address' => $club->club_address,
            'club_site' => $club->club_site,
            'club_longitude' => $club->club_longitude,
            'club_latitude' => $club->club_latitude,
            'club_vk' => $club->club_vk,
            'club_facebook' => $club->club_facebook,
            'club_foursquare' => $club->club_foursquare,
            'club_google_plus' => $club->club_google_plus,
            'club_features' => $club->club_features,
        );
        $club_id = (int)$club->club_id;
        if($club_id == 0){
            $this->tableGateway->insert($data);
        }
        else{
            if($this->getClub($club_id)){
                $this->tableGateway->update($data,array('club_id' => $club_id));
            }
            else{
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function deleteClub($club_id){
        $this->tableGateway->delete(array('club_id' => $club_id));
    }

}