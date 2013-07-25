<?php
namespace Timetable\Model;


use Zend\Db\TableGateway\TableGateway;

class SheduleRoadMinibusTable
{
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
    public function saveSheduleRoadMinibus(SheduleRoadMinibus $shedule)
    {
        $data = array(
            'shedule_road_minibus_id'=> $shedule->shedule_road_minibus_id,
            'shedule_road_id' => $shedule->shedule_road_id,

          //  'transport_road_minibus_id' => $shedule->transport_road_minibus_id,
            'transport_road_minibus_model' => $shedule->transport_road_minibus_model,
            'transport_road_minibus_price' => $shedule->transport_road_minibus_price,
            'transport_road_minibus_time_work' => $shedule->transport_road_minibus_time_work,

            'shedule_road_minibus_duration' => $shedule->shedule_road_minibus_duration ,
            'shedule_road_minibus_start_point' => $shedule->shedule_road_minibus_start_point ,
            'shedule_road_minibus_end_point' => $shedule->shedule_road_minibus_end_point,
            'shedule_road_minibus_alternative_shedule' => $shedule->shedule_road_minibus_alternative_shedule
        );

        $shedule_road_minibus_id= (int)$shedule->shedule_road_minibus_id;


        if ($shedule_road_minibus_id == 0)
        {
            $this->tableGateway->insert($data);
        } else
        {
            if ($this->getRestaurants($shedule_road_minibus_id)) {
            $this->tableGateway->update($data, array('transport_road_minibus_id' =>  $shedule_road_minibus_id));
        }
        else
            {
                throw new \Exception('Form id does not exist');
            }


        }
    }

}