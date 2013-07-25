<?php
        namespace Restaurant\Model;
        use Restaurant\Model\RestaurantNews;
        use Zend\Db\TableGateway\TableGateway;


class RestaurantNewsTable{
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
    public  function saveRestaurantNews(RestaurantNews $restaurant_news){
        $data  = array(

            'restaurant_news_id' => $restaurant_news->restaurant_news_id,
            'restaurant_id_name' => $restaurant_news->restaurant_id_name,
            'restaurant_news_image' => $restaurant_news->restaurant_news_image,
            'restaurant_news_header' => $restaurant_news->restaurant_news_header,
            'restaurant_news_news' => $restaurant_news->restaurant_news_news,
            'restaurant_news_date' => $restaurant_news->restaurant_news_date,
        );

        $restaurant_news_id = (int)$restaurant_news->restaurant_news_id;
        if ($restaurant_news_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getRestaurantNews($restaurant_news_id)) {
                $this->tableGateway->update($data, array('restaurant_news_id' => $restaurant_news_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function getRestaurantNews($restaurant_news_id){
        $restaurant_news_id = (int)$restaurant_news_id;
        $rowset = $this->tableGateway->select(array("restaurant_news_id" => $restaurant_news_id));
        //query the database
        $row = $rowset->current();
        return $row;
    }

    public  function getRestaurantNewsByIdName($restaurant_id_name){
        $restaurant_id_name = (string)$restaurant_id_name;
        $rowset = $this->tableGateway->select(array("restaurant_id_name" => $restaurant_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }
}