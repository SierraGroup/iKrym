<?php
        namespace Restaurant\Model;
        use Restaurant\Model\Restaurant;
        use Zend\Db\TableGateway\TableGateway;

        class RestaurantTable{
            protected $tableGateway;
            public  function __construct(TableGateway $tableGateway){
                    $this->tableGateway = $tableGateway;
            }
            public  function fetchAll(){
                    $resultSet =   $this->tableGateway->select();
                    return $resultSet;

            }
            public function getRestaurant($restaurant_id){
                $restaurant_id = (int)$restaurant_id;
                $resultSet = $this->tableGateway->select(array('restaurant_id' => $restaurant_id));
                $row = $resultSet->current();
                return $row;
             }
            public  function getRestaurantByNameId($restaurant_id_name){
                $restaurant_id_name = (string)$restaurant_id_name;
                $rowset = $this->tableGateway->select(array('restaurant_id_name' => $restaurant_id_name));
                $row = $rowset->current();
                return $row;
            }
            public  function saveRestaurant(Restaurant $restaurant){
                $data = array(
                    'restaurant_id_name' => $restaurant->restaurant_id_name,
                    'restaurant_name' => $restaurant->restaurant_name,
                    'restaurant_mode' => $restaurant->restaurant_mode,
                    'restaurant_description' => $restaurant->restaurant_description,
                    'restaurant_thumbnail' => $restaurant->restaurant_thumbnail,
                    'restaurant_image_1' => $restaurant->restaurant_image_1,
                    'restaurant_image_2' => $restaurant->restaurant_image_2,
                    'restaurant_image_3' => $restaurant->restaurant_image_3,

                    'restaurant_features' => $restaurant->restaurant_features,
                    'restaurant_dj' => $restaurant->restaurant_dj,
                    'restaurant_wifi' => $restaurant->restaurant_wifi,
                    'restaurant_karaoke' => $restaurant->restaurant_karaoke,
                    'restaurant_kalian' => $restaurant->restaurant_kalian,
                    'restaurant_chill_out' => $restaurant->restaurant_chill_out,
                    'restaurant_sigarette_room' => $restaurant->restaurant_sigarette_room,
                    'restaurant_live_music' => $restaurant->restaurant_live_music,
                    'restaurant_veranda'  => $restaurant->restaurant_veranda,


                    'restaurant_average_account' => $restaurant->restaurant_average_account,
                    'restaurant_directions' => $restaurant->restaurant_directions,
                    'restaurant_work_time' => $restaurant->restaurant_work_time,
                    'restaurant_telephone' => $restaurant->restaurant_telephone,
                    'restaurant_address' => $restaurant->restaurant_address,
                    'restaurant_site' => $restaurant->restaurant_site,
                    'restaurant_longitude' => $restaurant->restaurant_longitude,
                    'restaurant_latitude' => $restaurant->restaurant_latitude,
                    'restaurant_vk' => $restaurant->restaurant_vk,
                    'restaurant_facebook' => $restaurant->restaurant_facebook,
                    'restaurant_foursquare' => $restaurant->restaurant_foursquare,

                );
                    $restaurant_id = (int)$restaurant->restaurant_id;
                    if($restaurant_id == 0){
                        $this->tableGateway->insert($data);
                    }
                    else{
                        if($this->getRestaurant($restaurant_id)){
                            $this->tableGateway->update($data,array('restaurant_id' => $restaurant_id));
                        }
                        else{
                            throw new \Exception('Form id does not exist');
                        }
                    }
            }
            public  function deleteRestaurant($restaurant_id){
                   $this->tableGateway->delete(array('restaurant_id' => $restaurant_id));
            }
            public  function deleteRestaurantByName($restaurant_id_name){
                $this->tableGateway->delete(array('restaurant_id_name' => $restaurant_id_name));
            }

        }