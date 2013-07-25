<?php
        namespace Activity\Model;
        use Activity\Model\ActivityNews;
        use Zend\Db\TableGateway\TableGateway;


class ActivityNewsTable{
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
    public  function saveActivityNews(ActivityNews $activity){
        $data  = array(

            'activity_news_id' => $activity->activity_news_id,
            'activity_id_name' => $activity->activity_id_name,
            'activity_news_image' => $activity->activity_news_image,
            'activity_news_header' => $activity->activity_news_header,
            'activity_news_news' => $activity->activity_news_news,
            'activity_news_date' => $activity->activity_news_date,
        );

        $activity_news_id = (int)$activity->activity_news_id;
        if ($activity_news_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getActivityNews($activity_news_id)) {
                $this->tableGateway->update($data, array('activity_news_id' => $activity_news_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function getActivityNews($activity_id){
        $activity_id = (int)$activity_id;
        $rowset = $this->tableGateway->select(array("activity_id" => $activity_id));
        //query the database
        $row = $rowset->current();
        return $row;
    }

    public  function getActivityNewsByIdName($activity_id_name){
        $activity_id_name = (string)$activity_id_name;
        $rowset = $this->tableGateway->select(array("activity_id_name" => $activity_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }




    }