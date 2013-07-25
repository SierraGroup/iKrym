<?php
    namespace PrivateSector\Model;
    use PrivateSector\Model\PrivateSector;
    use PrivateSector\Model\PrivateSectorNews;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;

     class PrivateSectorTable{
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
        public function getPrivateSector($private_sector_id)
        {
            $private_sector_id  = (int)$private_sector_id;
            $rowset = $this->tableGateway->select(array('private_sector_id' => $private_sector_id));
            $row = $rowset->current();
            if (!$row) {
                throw new \Exception("Could not find row $private_sector_id");
            }
            return $row;
        }

        public  function getPrivateSectorByNameId($private_sector_id_name){
            $private_sector_id_name = (string)$private_sector_id_name;
            $rowset = $this->tableGateway->select(array('private_sector_id_name' => $private_sector_id_name));
            $row = $rowset->current();
            return $row;
        }

        public  function savePrivateSector(PrivateSector $private_sector){
            $data  = array(

                      'private_sector_id_name' => $private_sector->private_sector_id_name,
                      'private_sector_name' => $private_sector->private_sector_name,
                      'private_sector_type' => $private_sector->private_sector_type,
                      'private_sector_main_photo'   =>   $private_sector->private_sector_main_photo,
                      'private_sector_photo_1'   =>   $private_sector->private_sector_photo_1,
                      'private_sector_photo_2'   =>   $private_sector->private_sector_photo_2,
                      'private_sector_photo_3'   =>   $private_sector->private_sector_photo_3,
                      'private_sector_features' => $private_sector->private_sector_features,
                      'private_sector_time_work' => $private_sector->private_sector_time_work,
                      'private_sector_ticket_price' => $private_sector->private_sector_ticket_price,
                      'private_sector_telephone' => $private_sector->private_sector_telephone,
                      'private_sector_address'   => $private_sector->private_sector_address,
                      'private_sector_description'  =>     $private_sector->private_sector_description,
                      'private_sector_site'  =>     $private_sector->private_sector_site,
                      'private_sector_longitude' =>   $private_sector->private_sector_longitude,
                      'private_sector_latitude'   =>   $private_sector->private_sector_latitude,
                      'private_sector_vk' =>     $private_sector->private_sector_vk,
                      'private_sector_facebook'  =>    $private_sector->private_sector_facebook,
                      'private_sector_foursquare'  =>  $private_sector->private_sector_foursquare,
            );
            $private_sector_id = (int)$private_sector->private_sector_id;
            if ($private_sector_id == 0) {

                $this->tableGateway->insert($data);
            } else {
                if ($this->getPrivateSector($private_sector_id)) {
                    $this->tableGateway->update($data, array('private_sector_id' => $private_sector_id));
                } else {
                    throw new \Exception('Form id does not exist');
                }
            }
        }
        public function deletePrivateSector($private_sector_id)
        {
            $this->tableGateway->delete(array('private_sector_id' => $private_sector_id));
        }
        public function deletePrivateSectorByName($private_sector_id_name)
        {
            $this->tableGateway->delete(array('private_sector_id_name' => $private_sector_id_name));
        }


    }