<?php
namespace Fitness\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Restaurant\Controller;

class FitnessController extends AbstractActionController{
        protected $fitnessTable;
        protected $fitnessNewsTable;
        protected $fitnessPosterTable;

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

            $fitnesses = $this->getFitnessTable()->fetchAll();
            $view->setVariable('fitnesses',$fitnesses);
            $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
            return $view;
        }
        public  function fitnessClientAction(){

            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('fitness/block/detailed_information');

            $navigation_fitness_view = new ViewModel();
            $navigation_fitness_view->setTemplate('fitness/block/navigation_fitness');

            //map modal block
            $map_modal_block = new ViewModel();
            $map_modal_block->setTemplate('block/map-modal');


            $fitness_id_name = (string)$this->params()->fromRoute('fitness_id_name','');
            if(!$fitness_id_name){
                return $this->redirect()->toRoute('fitness',array('action'=>'index'));
            }
            try{
                $fitness = $this->getFitnessTable()->getFitnessByNameId($fitness_id_name);//zlatoust
                $fitness_news = $this->getFitnessNewsTable()->getFitnessNewsByIdName($fitness_id_name);//zlatoust
                 $view = new ViewModel();

                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $fitness->fitness_id_name =>   $fitness->fitness_latitude .','. $fitness->fitness_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $fitness->fitness_latitude,
                    'lon' => $fitness->fitness_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                    $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                    $map->initialize($config);
                    $html = $map->generate();
                    $GoogleMapsView = new ViewModel(array('map_html' => $html));
                    $GoogleMapsView->setTemplate('block/map');

                 $detailed_information_view->setVariable('fitness',$fitness);
                 $navigation_fitness_view->setVariable('fitness',$fitness);
                 $view->setVariable('fitness',$fitness);
                 $view->setVariable('fitness_news',$fitness_news);
                 $fitnesses = $this->getFitnessTable()->fetchAll();
                 $view->setVariable('fitnesses',$fitnesses);

                 $view->addChild($top_view,'topview')->addChild($navigation_fitness_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_fitness')->addChild($map_modal_block,'map-modal');
                return $view;

            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('fitness',array('action'=>'index'));
            }

        }
        public  function fitnessPosterAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $detailed_information_view = new ViewModel();
            $detailed_information_view->setTemplate('fitness/block/detailed_information');

            $navigation_fitness_view = new ViewModel();
            $navigation_fitness_view->setTemplate('fitness/block/navigation_fitness');
            $fitness_id_name = (string)$this->params()->fromRoute('fitness_id_name','');
            try{
                $fitness = $this->getFitnessTable()->getFitnessByNameId($fitness_id_name);//zlatoust
                $fitness_news = $this->getFitnessNewsTable()->getFitnessNewsByIdName($fitness_id_name);//zlatoust
                $fitnessPoster = $this->getFitnessPosterTable()->getFitnessPosterByIdName($fitness_id_name);
                $view = new ViewModel();
                /*  https://github.com/gowsram/zf2-google-maps-   */
                $marker = array(
                    $fitness->fitness_id_name =>   $fitness->fitness_latitude .','. $fitness->fitness_longitude,
                );

                $config = array(
                    'sensor' => 'false',
                    'div_id' => 'map',
                    'div_class' => 'map',
                    'zoom' => 13,
                    'width' => '151%',
                    'height'=> '254px',
                    'right' => '10%',
                    'lat' => $fitness->fitness_latitude,
                    'lon' => $fitness->fitness_longitude,
                    'animation' => 'none',
                    'markers' => $marker

                );
                $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                $map->initialize($config);
                $html = $map->generate();
                $GoogleMapsView = new ViewModel(array('map_html' => $html));
                $GoogleMapsView->setTemplate('block/map');

                $detailed_information_view->setVariable('fitness',$fitness);
                $navigation_fitness_view->setVariable('fitness',$fitness);
                $view->setVariable('fitness',$fitness);
                $view->setVariable('fitness_news',$fitness_news);
                $fitnesses = $this->getFitnessTable()->fetchAll();

                $view->setVariable('fitnesses',$fitnesses);
                  $view->setVariable('fitness_poster',$fitnessPoster);

                $view->addChild($top_view,'topview')->addChild($navigation_fitness_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_fitness');
                return $view;
            }
            catch(\Exception $ex){
                return $this->redirect()->toRoute('fitness',array('action'=>'index'));
            }
        }
        public  function fitnessPhotoreportAction(){
            $top_view = new ViewModel();
            $top_view->setTemplate('block/top');

            $rightside_top_view = new ViewModel();
            $rightside_top_view->setTemplate('block/rightside');
            $top_view->addChild($rightside_top_view,'rightside');

            $navigation_fitness_view = new ViewModel();
            $navigation_fitness_view->setTemplate('fitness/block/navigation_fitness');
            try{

                $view = new ViewModel();
                $fitness_id_name = (string)$this->params()->fromRoute('fitness_id_name','');
                $fitness = $this->getFitnessTable()->getFitnessByNameId($fitness_id_name);//zlatoust
                $view->setVariable('fitness',$fitness);
                $view->addChild($top_view,'topview')->addChild($navigation_fitness_view,'navigation');
                return $view;
            }catch(\Exception $ex){
                return $this->redirect()->toRoute('fitness',array('action'=>'index'));
            }
        }
        /*      GET TABLES FROM DB (MYSQL)     */
        public function getFitnessTable()
        {
            if (!$this->fitnessTable) {
                $sm = $this->getServiceLocator();
                $this->fitnessTable = $sm->get('Fitness\Model\FitnessTable');
            }
            return $this->fitnessTable;
        }
        public function getFitnessNewsTable(){
            if (!$this->fitnessNewsTable) {
                $sm = $this->getServiceLocator();
                $this->fitnessNewsTable = $sm->get('Fitness\Model\FitnessNewsTable');
            }
            return $this->fitnessNewsTable;
        }
        public function getFitnessPosterTable(){
            if (!$this->fitnessPosterTable) {
                $sm = $this->getServiceLocator();
                $this->fitnessPosterTable = $sm->get('Fitness\Model\FitnessPosterTable');
            }
            return $this->fitnessPosterTable;
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