<?php
    namespace Salon\Model;
    use Salon\Model\Salon;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;

    class SalonTable{
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
        public function getSalon($salon_id)
        {
            $salon_id  = (int)$salon_id;
            $rowset = $this->tableGateway->select(array('salon_id' => $salon_id));
            $row = $rowset->current();
            if (!$row) {
                throw new \Exception("Could not find row $salon_id");
            }
            return $row;
        }

        public  function getSalonByNameId($salon_id_name){
            $salon_id_name = (string)$salon_id_name;
            $rowset = $this->tableGateway->select(array('salon_id_name' => $salon_id_name));
            $row = $rowset->current();
            return $row;
        }

        public  function saveSalon(Salon $salon){
            $data  = array(

                      'salon_id_name' => $salon->salon_id_name,
                      'salon_name' => $salon->salon_name,
                      'salon_main_photo'   =>   $salon->salon_main_photo,
                      'salon_photo_1'   =>   $salon->salon_photo_1,
                      'salon_photo_2'   =>   $salon->salon_photo_2,
                      'salon_photo_3'   =>   $salon->salon_photo_3,
                      'salon_features' => $salon->salon_features,
                      'salon_time_work' => $salon->salon_time_work,
                      'salon_ticket_price' => $salon->salon_ticket_price,
                      'salon_telephone' => $salon->salon_telephone,
                      'salon_address'   => $salon->salon_address,
                      'salon_description'  =>     $salon->salon_description,
                      'salon_site'  =>     $salon->salon_site,
                      'salon_longitude' =>   $salon->salon_longitude,
                      'salon_latitude'   =>   $salon->salon_latitude,
                      'salon_vk' =>     $salon->salon_vk,
                      'salon_facebook'  =>    $salon->salon_facebook,
                      'salon_foursquare'  =>  $salon->salon_foursquare,
            );
            $salon_id = (int)$salon->salon_id;
            if ($salon_id == 0) {

                $this->tableGateway->insert($data);
            } else {
                if ($this->getSalon($salon_id)) {
                    $this->tableGateway->update($data, array('salon_id' => $salon_id));
                } else {
                    throw new \Exception('Form id does not exist');
                }
            }
        }
        public function deleteSalon($salon_id)
        {
            $this->tableGateway->delete(array('salon_id' => $salon_id));
        }
        public function deleteSalonByName($salon_id_name)
        {
            $this->tableGateway->delete(array('salon_id_name' => $salon_id_name));
        }


    }