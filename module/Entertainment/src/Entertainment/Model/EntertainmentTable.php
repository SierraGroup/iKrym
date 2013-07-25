<?php
    namespace Entertainment\Model;
    use Entertainment\Model\Entertainment;
    use Entertainment\Model\EntertainmentNews;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;

    class EntertainmentTable{
        protected $tableGateway;


        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGateway = $tableGateway;

        }
        public function fetchAll()
        {
            $resultSet = $this->tableGateway->select();
            $resultSet->buffer();
            return $resultSet;
        }
        public function getEntertainment($entertainment_id)
        {
            $entertainment_id  = (int)$entertainment_id;
            $rowset = $this->tableGateway->select(array('entertainment_id' => $entertainment_id));
            $row = $rowset->current();
            if (!$row) {
                throw new \Exception("Could not find row $entertainment_id");
            }
            return $row;
        }

        public  function getEntertainmentByNameId($entertainment_id_name){
            $entertainment_id_name = (string)$entertainment_id_name;
            $rowset = $this->tableGateway->select(array('entertainment_id_name' => $entertainment_id_name));
            $row = $rowset->current();
            return $row;
        }

        public  function saveEntertainment(Entertainment $entertainment){
            $data  = array(

                      'entertainment_id_name' => $entertainment->entertainment_id_name,
                      'entertainment_name' => $entertainment->entertainment_name,
                      'entertainment_type' => $entertainment->entertainment_type,
                      'entertainment_main_photo'   =>   $entertainment->entertainment_main_photo,
                      'entertainment_photo_1'   =>   $entertainment->entertainment_photo_1,
                      'entertainment_photo_2'   =>   $entertainment->entertainment_photo_2,
                      'entertainment_photo_3'   =>   $entertainment->entertainment_photo_3,
                      'entertainment_features' => $entertainment->entertainment_features,
                      'entertainment_time_work' => $entertainment->entertainment_time_work,
                      'entertainment_ticket_price' => $entertainment->entertainment_ticket_price,
                      'entertainment_telephone' => $entertainment->entertainment_telephone,
                      'entertainment_address'   => $entertainment->entertainment_address,
                      'entertainment_description'  =>     $entertainment->entertainment_description,
                      'entertainment_site'  =>     $entertainment->entertainment_site,
                      'entertainment_longitude' =>   $entertainment->entertainment_longitude,
                      'entertainment_latitude'   =>   $entertainment->entertainment_latitude,
                      'entertainment_vk' =>     $entertainment->entertainment_vk,
                      'entertainment_facebook'  =>    $entertainment->entertainment_facebook,
                      'entertainment_foursquare'  =>  $entertainment->entertainment_foursquare,
            );
            $entertainment_id = (int)$entertainment->entertainment_id;
            if ($entertainment_id == 0) {

                $this->tableGateway->insert($data);
            } else {
                if ($this->getEntertainment($entertainment_id)) {
                    $this->tableGateway->update($data, array('entertainment_id' => $entertainment_id));
                } else {
                    throw new \Exception('Form id does not exist');
                }
            }
        }
        public function deleteEntertainment($entertainment_id)
        {
            $this->tableGateway->delete(array('entertainment_id' => $entertainment_id));
        }
        public function deleteEntertainmentByName($entertainment_id_name)
        {
            $this->tableGateway->delete(array('entertainment_id_name' => $entertainment_id_name));
        }


    }