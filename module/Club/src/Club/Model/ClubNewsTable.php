<?php
namespace Club\Model;
use Club\Model\ClubNews;
use Zend\Db\TableGateway\TableGateway;


class ClubNewsTable{
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
    public  function saveClubNews(ClubNews $club){
        $data  = array(

            'club_news_id' => $club->club_news_id,
            'club_id_name' => $club->club_id_name,
            'club_news_image' => $club->club_news_image,
            'club_news_header' => $club->club_news_header,
            'club_news_news' => $club->club_news_news,
            'club_news_date' => $club->club_news_date,
        );

        $club_news_id = (int)$club->club_news_id;
        if ($club_news_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getClubNews($club_news_id)) {
                $this->tableGateway->update($data, array('club_news_id' => $club_news_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function getClubNews($club_id){
        $club_id = (int)$club_id;
        $rowset = $this->tableGateway->select(array("club_id" => $club_id));
        //query the database
        $row = $rowset->current();
        return $row;
    }

    public  function getClubNewsByIdName($Club_id_name){
        $Club_id_name = (string)$Club_id_name;
        $rowset = $this->tableGateway->select(array("club_id_name" => $Club_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }




}