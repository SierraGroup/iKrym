<?php
namespace Timetable\Model;
use Timetable\Model\Shedule;
use Zend\Db\TableGateway\TableGateway;

class SheduleTable{
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
    public function getShedule($shedule_id)
    {
        $shedule_id  = (int)$shedule_id;
        $rowset = $this->tableGateway->select(array('shedule_id' => $shedule_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $shedule_id");
        }
        return $row;
    }




    public  function saveShedule(Shedule $shedule){
        $data  = array(
            'shedule_id' => $shedule->shedule_id,
            'transport_id' => $shedule->transport_id,
            'shedule_mode' => $shedule->shedule_mode
        );
        $shedule_id = (int)$shedule->shedule_id;
        if ($shedule_id == 0) {
            $this->tableGateway->insert($shedule);
        } else {
            if ($this->getShedule($shedule_id)) {
                $this->tableGateway->update($data, array('shedule_id' => $shedule_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public function deleteAttraction($transport_id)
    {
        $this->tableGateway->delete(array('transport_id' => $transport_id));
    }

}