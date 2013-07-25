<?php
    namespace Fitness\Model;
    use Fitness\Model\Fitness;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;

    class FitnessTable{
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
        public function getFitness($fitness_id)
        {
            $fitness_id  = (int)$fitness_id;
            $rowset = $this->tableGateway->select(array('fitness_id' => $fitness_id));
            $row = $rowset->current();
            if (!$row) {
                throw new \Exception("Could not find row $fitness_id");
            }
            return $row;
        }

        public  function getFitnessByNameId($fitness_id_name){
            $fitness_id_name = (string)$fitness_id_name;
            $rowset = $this->tableGateway->select(array('fitness_id_name' => $fitness_id_name));
            $row = $rowset->current();
            return $row;
        }

        public  function saveFitness(Fitness $fitness){
            $data  = array(

                      'fitness_id_name' => $fitness->fitness_id_name,
                      'fitness_name' => $fitness->fitness_name,
                      'fitness_main_photo'   =>   $fitness->fitness_main_photo,
                      'fitness_photo_1'   =>   $fitness->fitness_photo_1,
                      'fitness_photo_2'   =>   $fitness->fitness_photo_2,
                      'fitness_photo_3'   =>   $fitness->fitness_photo_3,
                      'fitness_features' => $fitness->fitness_features,
                      'fitness_time_work' => $fitness->fitness_time_work,
                      'fitness_ticket_price' => $fitness->fitness_ticket_price,
                      'fitness_telephone' => $fitness->fitness_telephone,
                      'fitness_address'   => $fitness->fitness_address,
                      'fitness_description'  =>     $fitness->fitness_description,
                      'fitness_site'  =>     $fitness->fitness_site,
                      'fitness_longitude' =>   $fitness->fitness_longitude,
                      'fitness_latitude'   =>   $fitness->fitness_latitude,
                      'fitness_vk' =>     $fitness->fitness_vk,
                      'fitness_facebook'  =>    $fitness->fitness_facebook,
                      'fitness_foursquare'  =>  $fitness->fitness_foursquare,
            );
            $fitness_id = (int)$fitness->fitness_id;
            if ($fitness_id == 0) {

                $this->tableGateway->insert($data);
            } else {
                if ($this->getFitness($fitness_id)) {
                    $this->tableGateway->update($data, array('fitness_id' => $fitness_id));
                } else {
                    throw new \Exception('Form id does not exist');
                }
            }
        }
        public function deleteFitness($fitness_id)
        {
            $this->tableGateway->delete(array('fitness_id' => $fitness_id));
        }
        public function deleteFitnessByName($fitness_id_name)
        {
            $this->tableGateway->delete(array('fitness_id_name' => $fitness_id_name));
        }


    }