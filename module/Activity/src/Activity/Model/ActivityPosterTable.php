<?php
namespace Activity\Model;
use Activity\Model\ActivityNews;
use Zend\Db\TableGateway\TableGateway;


class ActivityPosterTable{
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
    public  function getActivityPosterById($activity_id){
        $activity_id = (int)$activity_id;
        $rowset = $this->tableGateway->select(array('activity_id' => $activity_id));
        //query the database
        $row = $rowset->current();
        $row = $rowset;
        return $row;
    }

    public  function getActivityPosterByIdName($activity_id_name){
        $activity_id_name = (string)$activity_id_name;
        $rowset = $this->tableGateway->select(array("activity_id_name" => $activity_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }
    public  function saveActivityPoster(ActivityPoster $activity_poster){
        $data  = array(

            'activity_poster_id' => $activity_poster->activity_poster_id,
            'activity_id_name' => $activity_poster->activity_id_name,
            'activity_poster_name' => $activity_poster->activity_poster_name,
            'activity_poster_image' => $activity_poster->activity_poster_image,
            'activity_poster_header' => $activity_poster->activity_poster_header,
            'activity_poster_date' => $activity_poster->activity_poster_date,
            'activity_poster_description' => $activity_poster->activity_poster_description
        );

        $activity_poster_id = (int)$activity_poster->activity_poster_id;
        if ($activity_poster_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getActivityPosterByIdName($activity_poster_id)) {
                $this->tableGateway->update($data, array('activity_poster_id' => $activity_poster_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
}