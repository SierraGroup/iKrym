<?php
namespace Attraction\Model;
use Attraction\Model\AttractionNews;
use Zend\Db\TableGateway\TableGateway;


class AttractionPosterTable{
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
    public  function getAttractionPosterById($attraction_id){
        $attraction_id = (int)$attraction_id;
        $rowset = $this->tableGateway->select(array('attraction_id' => $attraction_id));
        //query the database
        $row = $rowset->current();
        $row = $rowset;
        return $row;
    }

    public  function getAttractionPosterByIdName($attraction_id_name){
        $attraction_id_name = (string)$attraction_id_name;
        $rowset = $this->tableGateway->select(array("attraction_id_name" => $attraction_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }
    public  function saveAttractionPoster(AttractionPoster $attraction_poster){
        $data  = array(

            'attraction_poster_id' => $attraction_poster->attraction_poster_id,
            'attraction_id_name' => $attraction_poster->attraction_id_name,
            'attraction_poster_name' => $attraction_poster->attraction_poster_name,
            'attraction_poster_image' => $attraction_poster->attraction_poster_image,
            'attraction_poster_header' => $attraction_poster->attraction_poster_header,
            'attraction_poster_date' => $attraction_poster->attraction_poster_date,
            'attraction_poster_description' => $attraction_poster->attraction_poster_description
        );

        $attraction_poster_id = (int)$attraction_poster->attraction_poster_id;
        if ($attraction_poster_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getAttractionPosterByIdName($attraction_poster_id)) {
                $this->tableGateway->update($data, array('attraction_poster_id' => $attraction_poster_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
}