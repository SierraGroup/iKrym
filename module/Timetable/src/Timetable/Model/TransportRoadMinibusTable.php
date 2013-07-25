<?php
        namespace Timetable\Model;
        use Zend\Db\TableGateway\TableGateway;

         class TransportRoadMinibusTable
        {
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
             public function saveTransportRoadMinibus(TransportRoadMinibus $minibus)
             {
                 $data = array(

//                     'karaoke' =>      $restaurant->karaoke

                        'transport_road_minibus_id' => $minibus->transport_road_minibus_id,
                        'transport_road_id' => $minibus->transport_road_id,
                        'transport_id' => $minibus->transport_id,
                        'transport_road_minibus_number' => $minibus->transport_road_minibus_number,
                     'transport_road_minibus_model' => $minibus->transport_road_minibus_model,
                     'transport_road_minibus_count' => $minibus->transport_road_minibus_count,
                     'transport_road_minibus_time_work' => $minibus->transport_road_minibus_time_work,
                     'transport_road_minibus_price' => $minibus->transport_road_minibus_price,
                     'transport_road_minibus_stand_up' => $minibus->transport_road_minibus_stand_up,
                     'transport_road_minibus_seating' => $minibus->transport_road_minibus_seating,
                 );

                 $transport_road_minibus_id = (int)$minibus->transport_road_minibus_id;
                 if ($transport_road_minibus_id == 0) {

                     $this->tableGateway->insert($data);
                 } else {
                     if ($this->getRestaurants($transport_road_minibus_id)) {
                         $this->tableGateway->update($data, array('transport_road_minibus_id' => $transport_road_minibus_id));
                     } else {
                         throw new \Exception('Form id does not exist');
                     }
                 }
             }
        }