<?php
        namespace PrivateSector\Model;
        use PrivateSector\Model\PrivateSectorNews;
        use Zend\Db\TableGateway\TableGateway;


class PrivateSectorNewsTable{
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
    public  function savePrivateSectorNews(PrivateSectorNews $private_sector){
        $data  = array(

            'private_sector_news_id' => $private_sector->private_sector_news_id,
            'private_sector_id_name' => $private_sector->private_sector_id_name,
            'private_sector_news_image' => $private_sector->private_sector_news_image,
            'private_sector_news_header' => $private_sector->private_sector_news_header,
            'private_sector_news_news' => $private_sector->private_sector_news_news,
            'private_sector_news_date' => $private_sector->private_sector_news_date,
        );

        $private_sector_news_id = (int)$private_sector->private_sector_news_id;
        if ($private_sector_news_id == 0) {

            $this->tableGateway->insert($data);
        } else {
            if ($this->getPrivateSectorNews($private_sector_news_id)) {
                $this->tableGateway->update($data, array('private_sector_news_id' => $private_sector_news_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public  function getPrivateSectorNews($private_sector_id){
        $private_sector_id = (int)$private_sector_id;
        $rowset = $this->tableGateway->select(array("private_sector_id" => $private_sector_id));
        //query the database
        $row = $rowset->current();
        return $row;
    }

    public  function getPrivateSectorNewsByIdName($private_sector_id_name){
        $private_sector_id_name = (string)$private_sector_id_name;
        $rowset = $this->tableGateway->select(array("private_sector_id_name" => $private_sector_id_name));
        //query the database
        $row = $rowset->current();
        return $row;
    }




    }