<?php
namespace Timetable\Model;

use Timetable\Model\transport_road;
//        use Attraction\Model\AttractionNews;
use Zend\Db\TableGateway\TableGateway;

class transport_road_table{


    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    public function getTransportRoad($transport_road_id)
    {
        $transport_road_id  = (int)$transport_road_id;
        $rowset = $this->tableGateway->select(array('transport_road_id' => $transport_road_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $transport_road_id");
        }
        return $row;
    }

    public  function getTransportRoadByTransportId($transport_id){
        $transport_id = (int)$transport_id;
        $rowset = $this->tableGateway->select(array('transport_id' => $transport_id));
        $row = $rowset->current();
        return $row;
    }
    public  function getTransportRoadByTransportRoadIdName($transport_road_id_name){
        $transport_road_id_name= (string)$transport_road_id_name;
        $rowset = $this->tableGateway->select(array('transport_road_id_name' => $transport_road_id_name));
        $row = $rowset->current();
        return $row;
    }
    public  function getTransportRoadByTransportRoadName($transport_road_name){
        $transport_road_name= (string)$transport_road_name;
        $rowset = $this->tableGateway->select(array('transport_road_name' => $transport_road_name));
        $row = $rowset->current();
        return $row;
    }

    public  function saveTransport(TransportRoad $transport_road){
        $data  = array(
            'transport_road_id' => $transport_road->transport_road_id,
            'transport_id' => $transport_road->transport_id,
            'transport_road_id_name' => $transport_road->transport_road_id_name,
            'transport_road_name' => $transport_road->transport_road_name
        );
        $transport_road_id = (int)$transport_road->transport_road_id;
        if ($transport_road_id == 0) {
            $this->tableGateway->insert($transport_road_id);
        } else {
            if ($this->getTransport($transport_road_id)) {
                $this->tableGateway->update($data, array('transport_road_id' => $transport_road_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public function deleteAttraction($transport_road_id)
    {
        $this->tableGateway->delete(array('transport_road_id' => $transport_road_id));
    }

}