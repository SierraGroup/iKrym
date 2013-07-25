<?php
namespace PrivateSector\Model;
use PrivateSector\Model\PrivateSectorNews;
use Zend\Db\TableGateway\TableGateway;


class PrivateSectorPosterTable{
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
    public  function getPrivateSectorPosterById($private_sector_id){
        $private_sector_id = (int)$private_sector_id;
        $rowset = $this->tableGateway->select(array('private_sector_id' => $private_sector_id));
        //query the database
        $row = $rowset->current();
        $row = $rowset;
        return $row;
    }

    public  function getPrivateSectorPosterByIdName($private_sector_id_name){
        $private_sector_id_name = (string)$private_sector_id_name;
        $rowset = $this->tableGateway->select(array("private_sector_id_name" => $private_sector_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }
    public  function savePrivateSectorPoster(PrivateSectorPoster $private_sector_poster){
        $data  = array(

            'private_sector_poster_id' => $private_sector_poster->private_sector_poster_id,
            'private_sector_id_name' => $private_sector_poster->private_sector_id_name,
            'private_sector_poster_name' => $private_sector_poster->private_sector_poster_name,
            'private_sector_poster_image' => $private_sector_poster->private_sector_poster_image,
            'private_sector_poster_header' => $private_sector_poster->private_sector_poster_header,
            'private_sector_poster_date' => $private_sector_poster->private_sector_poster_date,
            'private_sector_poster_description' => $private_sector_poster->private_sector_poster_description
        );

        $private_sector_poster_id = (int)$private_sector_poster->private_sector_poster_id;
        if ($private_sector_poster_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getPrivateSectorPosterByIdName($private_sector_poster_id)) {
                $this->tableGateway->update($data, array('private_sector_poster_id' => $private_sector_poster_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
}