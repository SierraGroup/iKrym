<?php
    namespace Attraction\Model;
    use Attraction\Model\Attraction;
    use Attraction\Model\AttractionNews;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;

    class AttractionTable{
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
        public function getAttraction($attraction_id)
        {
            $attraction_id  = (int)$attraction_id;
            $rowset = $this->tableGateway->select(array('attraction_id' => $attraction_id));
            $row = $rowset->current();
            if (!$row) {
                throw new \Exception("Could not find row $attraction_id");
            }
            return $row;
        }

        public  function getAttractionByNameId($attraction_id_name){
            $attraction_id_name = (string)$attraction_id_name;
            $rowset = $this->tableGateway->select(array('attraction_id_name' => $attraction_id_name));
            $row = $rowset->current();
            return $row;
        }

        public  function saveAttraction(Attraction $attraction){
            $data  = array(

                      'attraction_id_name' => $attraction->attraction_id_name,
                      'attraction_name' => $attraction->attraction_name,
                      'attraction_type' => $attraction->attraction_type,
                      'attraction_main_photo'   =>   $attraction->attraction_main_photo,
                      'attraction_photo_1'   =>   $attraction->attraction_photo_1,
                      'attraction_photo_2'   =>   $attraction->attraction_photo_2,
                      'attraction_photo_3'   =>   $attraction->attraction_photo_3,
                      'attraction_features' => $attraction->attraction_features,
                      'attraction_time_work' => $attraction->attraction_time_work,
                      'attraction_ticket_price' => $attraction->attraction_ticket_price,
                      'attraction_telephone' => $attraction->attraction_telephone,
                      'attraction_address'   => $attraction->attraction_address,
                      'attraction_description'  =>     $attraction->attraction_description,
                      'attraction_site'  =>     $attraction->attraction_site,
                      'attraction_longitude' =>   $attraction->attraction_longitude,
                      'attraction_latitude'   =>   $attraction->attraction_latitude,
                      'attraction_vk' =>     $attraction->attraction_vk,
                      'attraction_facebook'  =>    $attraction->attraction_facebook,
                      'attraction_foursquare'  =>  $attraction->attraction_foursquare,
            );
            $attraction_id = (int)$attraction->attraction_id;
            if ($attraction_id == 0) {

                $this->tableGateway->insert($data);
            } else {
                if ($this->getAttraction($attraction_id)) {
                    $this->tableGateway->update($data, array('attraction_id' => $attraction_id));
                } else {
                    throw new \Exception('Form id does not exist');
                }
            }
        }
        public function deleteAttraction($attraction_id)
        {
            $this->tableGateway->delete(array('attraction_id' => $attraction_id));
        }
        public function deleteAttractionByName($attraction_id_name)
        {
            $this->tableGateway->delete(array('attraction_id_name' => $attraction_id_name));
        }


    }