<?php
namespace Attraction\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Restaurant\Controller;

class AttractionController extends AbstractActionController{
        protected $attractionTable;
        protected $attractionNewsTable;
        protected $attractionPosterTable;

        protected $restaurantsTable;

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

            $attractions = $this->getAttractionTable()->fetchAll();
            $view->setVariable('attractions',$attractions);
            $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
            return $view;
        }
        public  function attractionClientAction(){

            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('attraction/block/detailed_information');

            $navigation_attraction_view = new ViewModel();
            $navigation_attraction_view->setTemplate('attraction/block/navigation_attraction');

            //map modal block
            $map_modal_block = new ViewModel();
            $map_modal_block->setTemplate('block/map-modal');


            $attraction_id_name = (string)$this->params()->fromRoute('attraction_id_name','');
            if(!$attraction_id_name){
                return $this->redirect()->toRoute('attraction',array('action'=>'index'));
            }
            try{
                $attraction = $this->getAttractionTable()->getAttractionByNameId($attraction_id_name);//zlatoust
                $attraction_news = $this->getAttractionNewsTable()->getAttractionNewsByIdName($attraction_id_name);//zlatoust
                 $view = new ViewModel();

                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $attraction->attraction_id_name =>   $attraction->attraction_latitude .','. $attraction->attraction_longitude,
                );
                $icon  ='http://google-maps-icons.googlecode.com/files/castle.png';
                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $attraction->attraction_latitude,
                    'lon' => $attraction->attraction_longitude,
                    'animation' => 'none',
                    'markers' => $marker,
                    'icon' =>$icon,

                );
                    $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                    $map->initialize($config);
                    $html = $map->generate();
                    $GoogleMapsView = new ViewModel(array('map_html' => $html));
                    $GoogleMapsView->setTemplate('block/map');

                 $detailed_information_view->setVariable('attraction',$attraction);
                 $navigation_attraction_view->setVariable('attraction',$attraction);
                 $view->setVariable('attraction',$attraction);
                 $view->setVariable('attraction_news',$attraction_news);
                 $attractions = $this->getAttractionTable()->fetchAll();
                 $view->setVariable('attractions',$attractions);

                 $view->addChild($top_view,'topview')->addChild($navigation_attraction_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map')->addChild($map_modal_block,'map-modal');
                return $view;

            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('attraction',array('action'=>'index'));
            }

        }
        public  function attractionPosterAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('attraction/block/detailed_information');

            $navigation_attraction_view = new ViewModel();
            $navigation_attraction_view->setTemplate('attraction/block/navigation_attraction');
            $attraction_id_name = (string)$this->params()->fromRoute('attraction_id_name','');
            try{
                $attraction = $this->getAttractionTable()->getAttractionByNameId($attraction_id_name);//zlatoust
                $attraction_news = $this->getAttractionNewsTable()->getAttractionNewsByIdName($attraction_id_name);//zlatoust
                $attractionPoster = $this->getAttractionPosterTable()->getAttractionPosterByIdName($attraction_id_name);
                $view = new ViewModel();
                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $attraction->attraction_id_name =>   $attraction->attraction_latitude .','. $attraction->attraction_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $attraction->attraction_latitude,
                    'lon' => $attraction->attraction_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                $map->initialize($config);
                $html = $map->generate();
                $GoogleMapsView = new ViewModel(array('map_html' => $html));
                $GoogleMapsView->setTemplate('block/map');

                $detailed_information_view->setVariable('attraction',$attraction);
                $navigation_attraction_view->setVariable('attraction',$attraction);
                $view->setVariable('attraction',$attraction);
                $view->setVariable('attraction_news',$attraction_news);
                $attractions = $this->getAttractionTable()->fetchAll();

                $view->setVariable('attractions',$attractions);
                $view->setVariable('attraction_poster',$attractionPoster);

                $view->addChild($top_view,'topview')->addChild($navigation_attraction_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_attraction');
                return $view;
            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('attraction',array('action'=>'index'));
            }
        }
        public  function attractionPhotoreportAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $navigation_attraction_view = new ViewModel();
            $navigation_attraction_view->setTemplate('attraction/block/navigation_attraction');
            try{

                $view = new ViewModel();
                $attraction_id_name = (string)$this->params()->fromRoute('attraction_id_name','');
                $attraction = $this->getAttractionTable()->getAttractionByNameId($attraction_id_name);//zlatoust
                $view->setVariable('attraction',$attraction);
                $view->addChild($top_view,'topview')->addChild($navigation_attraction_view,'navigation');
                return $view;
            }catch(\Exception $ex){
                return $this->redirect()->toRoute('attraction',array('action'=>'index'));
            }
        }
        /*      GET TABLES FROM DB (MYSQL)     */
        public function getAttractionTable()
        {
            if (!$this->attractionTable) {
                $sm = $this->getServiceLocator();
                $this->attractionTable = $sm->get('Attraction\Model\AttractionTable');
            }
            return $this->attractionTable;
        }
        public function getAttractionNewsTable(){
            if (!$this->attractionNewsTable) {
                $sm = $this->getServiceLocator();
                $this->attractionNewsTable = $sm->get('Attraction\Model\AttractionNewsTable');
            }
            return $this->attractionNewsTable;
        }
        public function getAttractionPosterTable(){
            if (!$this->attractionPosterTable) {
                $sm = $this->getServiceLocator();
                $this->attractionPosterTable = $sm->get('Attraction\Model\AttractionPosterTable');
            }
            return $this->attractionPosterTable;
        }
        public function getRestaurantsTable()
        {
            if (!$this->restaurantsTable) {
                $sm = $this->getServiceLocator();
                $this->restaurantsTable = $sm->get('Restaurants\Model\RestaurantsTable');
            }
            return $this->restaurantsTable;
        }
}