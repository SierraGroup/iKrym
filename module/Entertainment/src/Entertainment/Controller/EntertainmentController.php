<?php
namespace Entertainment\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Restaurant\Controller;

class EntertainmentController extends AbstractActionController{
        protected $entertainmentTable;
        protected $entertainmentNewsTable;
        protected $entertainmentPosterTable;

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

            $entertainments = $this->getEntertainmentTable()->fetchAll();
            $view->setVariable('entertainments',$entertainments);
            $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
            return $view;
        }
        public  function entertainmentClientAction(){

            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('entertainment/block/detailed_information');

            $navigation_entertainment_view = new ViewModel();
            $navigation_entertainment_view->setTemplate('entertainment/block/navigation_entertainment');

            //map modal block
            $map_modal_block = new ViewModel();
            $map_modal_block->setTemplate('block/map-modal');


            $entertainment_id_name = (string)$this->params()->fromRoute('entertainment_id_name','');
            if(!$entertainment_id_name){
                return $this->redirect()->toRoute('entertainment',array('action'=>'index'));
            }
            try{
                $entertainment = $this->getEntertainmentTable()->getEntertainmentByNameId($entertainment_id_name);//zlatoust
                $entertainment_news = $this->getEntertainmentNewsTable()->getEntertainmentNewsByIdName($entertainment_id_name);//zlatoust
                 $view = new ViewModel();

                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $entertainment->entertainment_id_name =>   $entertainment->entertainment_latitude .','. $entertainment->entertainment_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $entertainment->entertainment_latitude,
                    'lon' => $entertainment->entertainment_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                    $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                    $map->initialize($config);
                    $html = $map->generate();
                    $GoogleMapsView = new ViewModel(array('map_html' => $html));
                    $GoogleMapsView->setTemplate('block/map');

                 $detailed_information_view->setVariable('entertainment',$entertainment);
                 $navigation_entertainment_view->setVariable('entertainment',$entertainment);
                 $view->setVariable('entertainment',$entertainment);
                 $view->setVariable('entertainment_news',$entertainment_news);
                 $entertainments = $this->getEntertainmentTable()->fetchAll();
                 $view->setVariable('entertainments',$entertainments);

                 $view->addChild($top_view,'topview')->addChild($navigation_entertainment_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_entertainment')->addChild($map_modal_block,'map-modal');
                return $view;

            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('entertainment',array('action'=>'index'));
            }

        }
        public  function entertainmentPosterAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('entertainment/block/detailed_information');

            $navigation_entertainment_view = new ViewModel();
            $navigation_entertainment_view->setTemplate('entertainment/block/navigation_entertainment');
            $entertainment_id_name = (string)$this->params()->fromRoute('entertainment_id_name','');
            try{
                $entertainment = $this->getEntertainmentTable()->getEntertainmentByNameId($entertainment_id_name);//zlatoust
                $entertainment_news = $this->getEntertainmentNewsTable()->getEntertainmentNewsByIdName($entertainment_id_name);//zlatoust
                $entertainmentPoster = $this->getEntertainmentPosterTable()->getEntertainmentPosterByIdName($entertainment_id_name);
                $view = new ViewModel();
                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $entertainment->entertainment_id_name =>   $entertainment->entertainment_latitude .','. $entertainment->entertainment_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $entertainment->entertainment_latitude,
                    'lon' => $entertainment->entertainment_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                $map->initialize($config);
                $html = $map->generate();
                $GoogleMapsView = new ViewModel(array('map_html' => $html));
                $GoogleMapsView->setTemplate('block/map');

                $detailed_information_view->setVariable('entertainment',$entertainment);
                $navigation_entertainment_view->setVariable('entertainment',$entertainment);
                $view->setVariable('entertainment',$entertainment);
                $view->setVariable('entertainment_news',$entertainment_news);
                $entertainments = $this->getEntertainmentTable()->fetchAll();

                $view->setVariable('entertainments',$entertainments);
                $view->setVariable('entertainment_poster',$entertainmentPoster);

                $view->addChild($top_view,'topview')->addChild($navigation_entertainment_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_entertainment');
                return $view;
            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('entertainment',array('action'=>'index'));
            }
        }
        public  function entertainmentPhotoreportAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $navigation_entertainment_view = new ViewModel();
            $navigation_entertainment_view->setTemplate('entertainment/block/navigation_entertainment');
            try{

                $view = new ViewModel();
                $entertainment_id_name = (string)$this->params()->fromRoute('entertainment_id_name','');
                $entertainment = $this->getEntertainmentTable()->getEntertainmentByNameId($entertainment_id_name);//zlatoust
                $view->setVariable('entertainment',$entertainment);
                $view->addChild($top_view,'topview')->addChild($navigation_entertainment_view,'navigation');
                return $view;
            }catch(\Exception $ex){
                return $this->redirect()->toRoute('entertainment',array('action'=>'index'));
            }
        }
        /*      GET TABLES FROM DB (MYSQL)     */
        public function getEntertainmentTable()
        {
            if (!$this->entertainmentTable) {
                $sm = $this->getServiceLocator();
                $this->entertainmentTable = $sm->get('Entertainment\Model\EntertainmentTable');
            }
            return $this->entertainmentTable;
        }
        public function getEntertainmentNewsTable(){
            if (!$this->entertainmentNewsTable) {
                $sm = $this->getServiceLocator();
                $this->entertainmentNewsTable = $sm->get('Entertainment\Model\EntertainmentNewsTable');
            }
            return $this->entertainmentNewsTable;
        }
        public function getEntertainmentPosterTable(){
            if (!$this->entertainmentPosterTable) {
                $sm = $this->getServiceLocator();
                $this->entertainmentPosterTable = $sm->get('Entertainment\Model\EntertainmentPosterTable');
            }
            return $this->entertainmentPosterTable;
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