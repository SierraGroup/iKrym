<?php
namespace Cafe\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class CafeController extends AbstractActionController{

    protected $cafeTable;

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

        $cafes = $this->getCafeTable()->fetchAll();
        $view->setVariable('cafes',$cafes);
        $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
        return $view;

    }
    public  function cafeAction(){
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');

        $rightside_top_view = new ViewModel();
        $rightside_top_view->setTemplate('block/rightside');
        $top_view->addChild($rightside_top_view,'rightside');

        $detailed_information_view = new ViewModel();
        $detailed_information_view->setTemplate('cafe/cafe/block/detailed_information');

        $navigation_cafe_view = new ViewModel();
        $navigation_cafe_view->setTemplate('cafe/cafe/block/navigation_cafe');


        $cafe_id_name = (string)$this->params()->fromRoute('cafe_id_name','');
        if(!$cafe_id_name){
            return $this->redirect()->toRoute('cafe',array('action'=>'index'));
        }
        try{


            $cafe = $this->getCafeTable()->getCafeByNameId($cafe_id_name);//zlatoust
            //$attraction_news = $this->getAttractionNewsTable()->getAttractionNewsByIdName($attraction_id_name);//zlatoust
            $view = new ViewModel();

            /*  https://github.com/gowsram/zf2-google-maps-   */
            $marker = array(
                $cafe->cafe_id_name =>   $cafe->cafe_latitude .','. $cafe->cafe_longitude,
            );

            $config = array(
                'sensor' => 'false',
                'div_id' => 'map',
                'div_class' => 'map',
                'zoom' => 13,
                'width' => '151%',
                'height'=> '254px',
                'right' => '10%',
                'lat' => $cafe->cafe_latitude,
                'lon' => $cafe->cafe_longitude,
                'animation' => 'none',
                'markers' => $marker

            );
            $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
            $map->initialize($config);
            $html = $map->generate();
            $GoogleMapsView = new ViewModel(array('map_html' => $html));
            $GoogleMapsView->setTemplate('block/map');

            $detailed_information_view->setVariable('cafe',$cafe);
            $navigation_cafe_view->setVariable('cafe',$cafe);
            $view->setVariable('cafe',$cafe);
//            $view->setVariable('attraction_news',$restaurant_news);
            $cafes = $this->getCafeTable()->fetchAll();
            $view->setVariable('cafes',$cafes);

            $view->addChild($top_view,'topview')->addChild($navigation_cafe_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_attraction');
            return $view;

        }
        catch(\Exception $ex){
            return $this->redirect()->toRoute('Cafe',array('action'=>'index'));
        }

    }
    public  function getCafeTable(){
        if (!$this->cafeTable) {
            $sm = $this->getServiceLocator();
            $this->cafeTable = $sm->get('Cafe\Model\CafeTable');
        }
        return $this->cafeTable;
    }

}