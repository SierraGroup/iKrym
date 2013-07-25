<?php
    namespace Activity\Model;
    use Activity\Model\Activity;
    use Activity\Model\ActivityNews;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;

     class ActivityTable{
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
        public function getActivity($activity_id)
        {
            $activity_id  = (int)$activity_id;
            $rowset = $this->tableGateway->select(array('activity_id' => $activity_id));
            $row = $rowset->current();
            if (!$row) {
                throw new \Exception("Could not find row $activity_id");
            }
            return $row;
        }

        public  function getActivityByNameId($activity_id_name){
            $activity_id_name = (string)$activity_id_name;
            $rowset = $this->tableGateway->select(array('activity_id_name' => $activity_id_name));
            $row = $rowset->current();
            return $row;
        }

        public  function saveActivity(Activity $activity){
            $data  = array(

                      'activity_id_name' => $activity->activity_id_name,
                      'activity_name' => $activity->activity_name,
                      'activity_type' => $activity->activity_type,
                      'activity_main_photo'   =>   $activity->activity_main_photo,
                      'activity_photo_1'   =>   $activity->activity_photo_1,
                      'activity_photo_2'   =>   $activity->activity_photo_2,
                      'activity_photo_3'   =>   $activity->activity_photo_3,
                      'activity_features' => $activity->activity_features,
                      'activity_time_work' => $activity->activity_time_work,
                      'activity_ticket_price' => $activity->activity_ticket_price,
                      'activity_telephone' => $activity->activity_telephone,
                      'activity_address'   => $activity->activity_address,
                      'activity_description'  =>     $activity->activity_description,
                      'activity_site'  =>     $activity->activity_site,
                      'activity_longitude' =>   $activity->activity_longitude,
                      'activity_latitude'   =>   $activity->activity_latitude,
                      'activity_vk' =>     $activity->activity_vk,
                      'activity_facebook'  =>    $activity->activity_facebook,
                      'activity_foursquare'  =>  $activity->activity_foursquare,
            );
            $activity_id = (int)$activity->activity_id;
            if ($activity_id == 0) {

                $this->tableGateway->insert($data);
            } else {
                if ($this->getActivity($activity_id)) {
                    $this->tableGateway->update($data, array('activity_id' => $activity_id));
                } else {
                    throw new \Exception('Form id does not exist');
                }
            }
        }
        public function deleteActivity($activity_id)
        {
            $this->tableGateway->delete(array('activity_id' => $activity_id));
        }
        public function deleteActivityByName($activity_id_name)
        {
            $this->tableGateway->delete(array('activity_id_name' => $activity_id_name));
        }


    }