<?php
namespace Hostel\Model;
use Hostel\Model\HostelNews;
use Zend\Db\TableGateway\TableGateway;


class HostelNewsTable{
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
    public  function saveHostelNews(HostelNews $hostel){
        $data  = array(

            'hostel_news_id' => $hostel->hostel_news_id,
            'hostel_id_name' => $hostel->hostel_id_name,
            'hostel_news_image' => $hostel->hostel_news_image,
            'hostel_news_header' => $hostel->hostel_news_header,
            'hostel_news_news' => $hostel->hostel_news_news,
            'hostel_news_date' => $hostel->hostel_news_date,
        );

        $hostel_news_id = (int)$hostel->hostel_news_id;
        if ($hostel_news_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getHostelNews($hostel_news_id)) {
                $this->tableGateway->update($data, array('hostel_news_id' => $hostel_news_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function getHostelNews($hostel_id){
        $hostel_id = (int)$hostel_id;
        $rowset = $this->tableGateway->select(array("hostel_id" => $hostel_id));
        //query the database
        $row = $rowset->current();
        return $row;
    }

    public  function getHostelNewsByIdName($hostel_id_name){
        $hostel_id_name = (string)$hostel_id_name;
        $rowset = $this->tableGateway->select(array("hostel_id_name" => $hostel_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }




}