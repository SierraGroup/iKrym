<?php
namespace Hostel\Model;
use Hostel\Model\HostelNews;
use Zend\Db\TableGateway\TableGateway;


class HostelPosterTable{
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
    public  function saveHostelPoster(HostelPoster $hostel){
        $data  = array(

            'hostel_poster_id' => $hostel->hostel_poster_id,
            'hostel_id_name' => $hostel->hostel_id_name,
            'hostel_poster_name' => $hostel->hostel_poster_name,
            'hostel_poster_image' => $hostel->hostel_poster_image,
            'hostel_poster_header' => $hostel->hostel_poster_header,
            'hostel_poster_date' => $hostel->hostel_poster_date,
            'hostel_poster_description' => $hostel->hostel_poster_description,
        );

        $hostel_poster_id = (int)$hostel->hostel_poster_id;
        if ($hostel_poster_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getHostelPoster($hostel_poster_id)) {
                $this->tableGateway->update($data, array('hostel_poster_id' => $hostel_poster_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function getHostelPoster($hostel_id){
        $hostel_id = (int)$hostel_id;
        $rowset = $this->tableGateway->select(array("hostel_id" => $hostel_id));
        //query the database
        $row = $rowset->current();
        return $row;
    }

    public  function getHostelPosterByIdName($hostel_id_name){
        $hostel_id_name = (string)$hostel_id_name;
        $rowset = $this->tableGateway->select(array("hostel_id_name" => $hostel_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }




}