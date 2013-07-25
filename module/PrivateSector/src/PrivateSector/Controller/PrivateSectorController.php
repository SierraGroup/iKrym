<?php
namespace PrivateSector\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class PrivateSectorController extends AbstractActionController{
        protected $private_sectorTable;
        protected $private_sectorNewsTable;
        protected $private_sectorPosterTable;


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

            $private_sectors = $this->getPrivateSectorTable()->fetchAll();
            $view->setVariable('private_sectors',$private_sectors);
            $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
            return $view;
        }
        public  function private_sectorClientAction(){

            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('private_sector/block/detailed_information');

            $navigation_private_sector_view = new ViewModel();
            $navigation_private_sector_view->setTemplate('private_sector/block/navigation_private_sector');

            //map modal block
            $map_modal_block = new ViewModel();
            $map_modal_block->setTemplate('block/map-modal');


            $private_sector_id_name = (string)$this->params()->fromRoute('private_sector_id_name','');
            if(!$private_sector_id_name){
                return $this->redirect()->toRoute('private_sector',array('action'=>'index'));
            }
            try{
                $private_sector = $this->getPrivateSectorTable()->getPrivateSectorByNameId($private_sector_id_name);//zlatoust
                $private_sector_news = $this->getPrivateSectorNewsTable()->getPrivateSectorNewsByIdName($private_sector_id_name);//zlatoust
                 $view = new ViewModel();

                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $private_sector->private_sector_id_name =>   $private_sector->private_sector_latitude .','. $private_sector->private_sector_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $private_sector->private_sector_latitude,
                    'lon' => $private_sector->private_sector_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                    $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                    $map->initialize($config);
                    $html = $map->generate();
                    $GoogleMapsView = new ViewModel(array('map_html' => $html));
                    $GoogleMapsView->setTemplate('block/map');

                 $detailed_information_view->setVariable('private_sector',$private_sector);
                 $navigation_private_sector_view->setVariable('private_sector',$private_sector);
                 $view->setVariable('private_sector',$private_sector);
                 $view->setVariable('private_sector_news',$private_sector_news);
                 $private_sectors = $this->getPrivateSectorTable()->fetchAll();
                 $view->setVariable('private_sectors',$private_sectors);

                 $view->addChild($top_view,'topview')->addChild($navigation_private_sector_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_private_sector')->addChild($map_modal_block,'map-modal');
                return $view;

            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('private_sector',array('action'=>'index'));
            }

        }
        public  function private_sectorPosterAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('private_sector/block/detailed_information');

            $navigation_private_sector_view = new ViewModel();
            $navigation_private_sector_view->setTemplate('private_sector/block/navigation_private_sector');
            $private_sector_id_name = (string)$this->params()->fromRoute('private_sector_id_name','');
            try{
                $private_sector = $this->getPrivateSectorTable()->getPrivateSectorByNameId($private_sector_id_name);//zlatoust
                $private_sector_news = $this->getPrivateSectorNewsTable()->getPrivateSectorNewsByIdName($private_sector_id_name);//zlatoust
                $private_sectorPoster = $this->getPrivateSectorPosterTable()->getPrivateSectorPosterByIdName($private_sector_id_name);
                $view = new ViewModel();
                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $private_sector->private_sector_id_name =>   $private_sector->private_sector_latitude .','. $private_sector->private_sector_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $private_sector->private_sector_latitude,
                    'lon' => $private_sector->private_sector_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                $map->initialize($config);
                $html = $map->generate();
                $GoogleMapsView = new ViewModel(array('map_html' => $html));
                $GoogleMapsView->setTemplate('block/map');

                $detailed_information_view->setVariable('private_sector',$private_sector);
                $navigation_private_sector_view->setVariable('private_sector',$private_sector);
                $view->setVariable('private_sector',$private_sector);
                $view->setVariable('private_sector_news',$private_sector_news);
                $private_sectors = $this->getPrivateSectorTable()->fetchAll();

                $view->setVariable('private_sectors',$private_sectors);
                $view->setVariable('private_sector_poster',$private_sectorPoster);

                $view->addChild($top_view,'topview')->addChild($navigation_private_sector_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_private_sector');
                return $view;
            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('private_sector',array('action'=>'index'));
            }
        }
        public  function private_sectorPhotoreportAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $navigation_private_sector_view = new ViewModel();
            $navigation_private_sector_view->setTemplate('private_sector/block/navigation_private_sector');
            try{

                $view = new ViewModel();
                $private_sector_id_name = (string)$this->params()->fromRoute('private_sector_id_name','');
                $private_sector = $this->getPrivateSectorTable()->getPrivateSectorByNameId($private_sector_id_name);//zlatoust
                $view->setVariable('private_sector',$private_sector);
                $view->addChild($top_view,'topview')->addChild($navigation_private_sector_view,'navigation');
                return $view;
            }catch(\Exception $ex){
                return $this->redirect()->toRoute('private_sector',array('action'=>'index'));
            }
        }
        /*      GET TABLES FROM DB (MYSQL)     */
        public function getPrivateSectorTable()
        {
            if (!$this->private_sectorTable) {
                $sm = $this->getServiceLocator();
                $this->private_sectorTable = $sm->get('PrivateSector\Model\PrivateSectorTable');
            }
            return $this->private_sectorTable;
        }
        public function getPrivateSectorNewsTable(){
            if (!$this->private_sectorNewsTable) {
                $sm = $this->getServiceLocator();
                $this->private_sectorNewsTable = $sm->get('PrivateSector\Model\PrivateSectorNewsTable');
            }
            return $this->private_sectorNewsTable;
        }
        public function getPrivateSectorPosterTable(){
            if (!$this->private_sectorPosterTable) {
                $sm = $this->getServiceLocator();
                $this->private_sectorPosterTable = $sm->get('PrivateSector\Model\PrivateSectorPosterTable');
            }
            return $this->private_sectorPosterTable;
        }

}