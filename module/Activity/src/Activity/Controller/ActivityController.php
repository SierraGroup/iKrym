<?php
namespace Activity\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class ActivityController extends AbstractActionController{
        protected $activityTable;
        protected $activityNewsTable;
        protected $activityPosterTable;


        public  function indexAction(){


            $view = new ViewModel();

            //Navigation block
            $navigation_view = new ViewModel();
            $navigation_view->setTemplate('block/navigation');

            //Categories block
            $categories_window = new ViewModel();
            $categories_window->setTemplate('block/categories');

            //Filter block
            $filter_window = new ViewModel();
            $filter_window->setTemplate('block/filter');

            //rightside block
            $rightside_window = new ViewModel();
            $rightside_window->setTemplate('block/rightside');

            //Top block
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');
            $top_view->addChild($rightside_window,'rightside');

            //Categories block
            $categories_window = new ViewModel();
            $categories_window->setTemplate('block/categories');

            $navigation_view = new ViewModel();
            $navigation_view->setTemplate('block/navigation');

            $activities = $this->getActivityTable()->fetchAll();
            $view->setVariable('activities',$activities);
            $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
            return $view;
        }
        public  function activityClientAction(){

            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('activity/block/detailed_information');

            $navigation_activity_view = new ViewModel();
            $navigation_activity_view->setTemplate('activity/block/navigation_activity');

            //map modal block
            $map_modal_block = new ViewModel();
            $map_modal_block->setTemplate('block/map-modal');


            $activity_id_name = (string)$this->params()->fromRoute('activity_id_name','');
            if(!$activity_id_name){
                return $this->redirect()->toRoute('activity',array('action'=>'index'));
            }
            try{
                $activity = $this->getActivityTable()->getActivityByNameId($activity_id_name);//zlatoust
                $activity_news = $this->getActivityNewsTable()->getActivityNewsByIdName($activity_id_name);//zlatoust
                 $view = new ViewModel();

                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $activity->activity_id_name =>   $activity->activity_latitude .','. $activity->activity_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $activity->activity_latitude,
                    'lon' => $activity->activity_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                    $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                    $map->initialize($config);
                    $html = $map->generate();
                    $GoogleMapsView = new ViewModel(array('map_html' => $html));
                    $GoogleMapsView->setTemplate('block/map');

                 $detailed_information_view->setVariable('activity',$activity);
                 $navigation_activity_view->setVariable('activity',$activity);
                 $view->setVariable('activity',$activity);
                 $view->setVariable('activity_news',$activity_news);
                 $activities = $this->getActivityTable()->fetchAll();
                 $view->setVariable('activities',$activities);

                 $view->addChild($top_view,'topview')->addChild($navigation_activity_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_activity')->addChild($map_modal_block,'map-modal');
                return $view;

            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('activity',array('action'=>'index'));
            }

        }
        public  function activityPosterAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('activity/block/detailed_information');

            $navigation_activity_view = new ViewModel();
            $navigation_activity_view->setTemplate('activity/block/navigation_activity');
            $activity_id_name = (string)$this->params()->fromRoute('activity_id_name','');
            try{
                $activity = $this->getActivityTable()->getActivityByNameId($activity_id_name);//zlatoust
                $activity_news = $this->getActivityNewsTable()->getActivityNewsByIdName($activity_id_name);//zlatoust
                $activityPoster = $this->getActivityPosterTable()->getActivityPosterByIdName($activity_id_name);
                $view = new ViewModel();
                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $activity->activity_id_name =>   $activity->activity_latitude .','. $activity->activity_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $activity->activity_latitude,
                    'lon' => $activity->activity_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                $map->initialize($config);
                $html = $map->generate();
                $GoogleMapsView = new ViewModel(array('map_html' => $html));
                $GoogleMapsView->setTemplate('block/map');

                $detailed_information_view->setVariable('activity',$activity);
                $navigation_activity_view->setVariable('activity',$activity);
                $view->setVariable('activity',$activity);
                $view->setVariable('activity_news',$activity_news);
                $activities = $this->getActivityTable()->fetchAll();

                $view->setVariable('activities',$activities);
                $view->setVariable('activity_poster',$activityPoster);

                $view->addChild($top_view,'topview')->addChild($navigation_activity_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_activity');
                return $view;
            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('activity',array('action'=>'index'));
            }
        }
        public  function activityPhotoreportAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $navigation_activity_view = new ViewModel();
            $navigation_activity_view->setTemplate('activity/block/navigation_activity');
            try{

                $view = new ViewModel();
                $activity_id_name = (string)$this->params()->fromRoute('activity_id_name','');
                $activity = $this->getActivityTable()->getActivityByNameId($activity_id_name);//zlatoust
                $view->setVariable('activity',$activity);
                $view->addChild($top_view,'topview')->addChild($navigation_activity_view,'navigation');
                return $view;
            }catch(\Exception $ex){
                return $this->redirect()->toRoute('activity',array('action'=>'index'));
            }
        }
        /*      GET TABLES FROM DB (MYSQL)     */
        public function getActivityTable()
        {
            if (!$this->activityTable) {
                $sm = $this->getServiceLocator();
                $this->activityTable = $sm->get('Activity\Model\ActivityTable');
            }
            return $this->activityTable;
        }
        public function getActivityNewsTable(){
            if (!$this->activityNewsTable) {
                $sm = $this->getServiceLocator();
                $this->activityNewsTable = $sm->get('Activity\Model\ActivityNewsTable');
            }
            return $this->activityNewsTable;
        }
        public function getActivityPosterTable(){
            if (!$this->activityPosterTable) {
                $sm = $this->getServiceLocator();
                $this->activityPosterTable = $sm->get('Activity\Model\ActivityPosterTable');
            }
            return $this->activityPosterTable;
        }

}