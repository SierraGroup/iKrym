<?php
        namespace Attraction\Model;
        use Attraction\Model\AttractionNews;
        use Zend\Db\TableGateway\TableGateway;


class AttractionNewsTable{
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
    public  function saveAttractionNews(AttractionNews $attraction){
        $data  = array(

            'attraction_news_id' => $attraction->attraction_news_id,
            'attraction_id_name' => $attraction->attraction_id_name,
            'attraction_news_image' => $attraction->attraction_news_image,
            'attraction_news_header' => $attraction->attraction_news_header,
            'attraction_news_news' => $attraction->attraction_news_news,
            'attraction_news_date' => $attraction->attraction_news_date,
        );

        $attraction_news_id = (int)$attraction->attraction_news_id;
        if ($attraction_news_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getAttractionNews($attraction_news_id)) {
                $this->tableGateway->update($data, array('attraction_news_id' => $attraction_news_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function getAttractionNews($attraction_id){
        $attraction_id = (int)$attraction_id;
        $rowset = $this->tableGateway->select(array("attraction_id" => $attraction_id));
        //query the database
        $row = $rowset->current();
        return $row;
    }

    public  function getAttractionNewsByIdName($attraction_id_name){
        $attraction_id_name = (string)$attraction_id_name;
        $rowset = $this->tableGateway->select(array("attraction_id_name" => $attraction_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }




    }