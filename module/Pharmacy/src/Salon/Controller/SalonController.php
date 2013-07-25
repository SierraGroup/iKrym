<?php
namespace Salon\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Restaurant\Controller;

class SalonController extends AbstractActionController{
        protected $salonTable;

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

            $salons = $this->getSalonTable()->fetchAll();
            $view->setVariable('salons',$salons);
            $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
            return $view;
        }
        public  function salonClientAction(){

            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('salon/block/detailed_information');

            $navigation_salon_view = new ViewModel();
            $navigation_salon_view->setTemplate('salon/block/navigation_salon');

            //map modal block
            $map_modal_block = new ViewModel();
            $map_modal_block->setTemplate('block/map-modal');


            $salon_id_name = (string)$this->params()->fromRoute('salon_id_name','');
            if(!$salon_id_name){
                return $this->redirect()->toRoute('salon',array('action'=>'index'));
            }
            try{
                $salon = $this->getSalonTable()->getSalonByNameId($salon_id_name);//zlatoust

                 $view = new ViewModel();

                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $salon->salon_id_name =>   $salon->salon_latitude .','. $salon->salon_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $salon->salon_latitude,
                    'lon' => $salon->salon_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                    $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                    $map->initialize($config);
                    $html = $map->generate();
                    $GoogleMapsView = new ViewModel(array('map_html' => $html));
                    $GoogleMapsView->setTemplate('block/map');

                 $detailed_information_view->setVariable('salon',$salon);
                 $navigation_salon_view->setVariable('salon',$salon);
                 $view->setVariable('salon',$salon);

                 $salons = $this->getSalonTable()->fetchAll();
                 $view->setVariable('salons',$salons);

                 $view->addChild($top_view,'topview')->addChild($navigation_salon_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_salon')->addChild($map_modal_block,'map-modal');
                return $view;

            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('salon',array('action'=>'index'));
            }

        }

        /*      GET TABLES FROM DB (MYSQL)     */
        public function getSalonTable()
        {
            if (!$this->salonTable) {
                $sm = $this->getServiceLocator();
                $this->salonTable = $sm->get('Salon\Model\SalonTable');
            }
            return $this->salonTable;
        }

}