<?php
        namespace Timetable\Model;
        use Timetable\Model\transport;
//        use Attraction\Model\AttractionNews;
        use Zend\Db\TableGateway\TableGateway;

class transport_table{


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
    public function getTransport($transport_id)
    {
        $transport_id  = (int)$transport_id;
        $rowset = $this->tableGateway->select(array('transport_id' => $transport_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $transport_id");
        }
        return $row;
    }

    public  function getTransportByMode($transport_mode){
        $transport_mode = (string)$transport_mode;
        $rowset = $this->tableGateway->select(array('transport_mode' => $transport_mode));
        $row = $rowset->current();
        return $row;
    }

    public  function saveTransport(Transport $transport){
        $data  = array(
            'transport_id' => $transport->transport_id,
            'transport_mode' => $transport->transport_mode
        );
        $transport_id = (int)$transport->transport_id;
        if ($transport_id == 0) {
            $this->tableGateway->insert($transport);
        } else {
            if ($this->getTransport($transport_id)) {
                $this->tableGateway->update($data, array('transport_id' => $transport_id));
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