<?php
namespace Restaurant\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Restaurant\Controller;



class RestaurantController extends AbstractActionController{

    protected $restaurantsTable;
    protected $restaurantMenuTable;
    protected $restaurantMenuTableTypeDescription;


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

                    $restaurants = $this->getRestaurantTable()->fetchAll();
                    $view->setVariable('restaurants',$restaurants);
                    $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
                    return $view;
        }

    public  function restaurantAction(){
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');

        $rightside_top_view = new ViewModel();
        $rightside_top_view->setTemplate('block/rightside');
        $top_view->addChild($rightside_top_view,'rightside');

        $detailed_information_view = new ViewModel();
        $detailed_information_view->setTemplate('restaurant/restaurant/block/detailed_information');

        $navigation_restaurant_view = new ViewModel();
        $navigation_restaurant_view->setTemplate('restaurant/restaurant/block/navigation_restaurant');

        //заказ столика
        $reserve_table_view = new ViewModel();
        $reserve_table_view->setTemplate('restaurant/restaurant/block/reserve_table');
        $detailed_information_view->addChild($reserve_table_view,'reserve_table');


        $restaurant_id_name = (string)$this->params()->fromRoute('restaurant_id_name','');
        if(!$restaurant_id_name){
            return $this->redirect()->toRoute('restaurant',array('action'=>'index'));
        }
        try{
            $restaurant= $this->getRestaurantTable()->getRestaurantByNameId($restaurant_id_name);//zlatoust
            $view = new ViewModel();
            /*  https://github.com/gowsram/zf2-google-maps-   */
            $marker = array(
                $restaurant->restaurant_id_name =>   $restaurant->restaurant_latitude .','. $restaurant->restaurant_longitude,
            );

            $config = array(
                'sensor' => 'false',
                'div_id' => 'map',
                'div_class' => 'map',
                'zoom' => 13,
                'width' => '151%',
                'height'=> '254px',
                'right' => '10%',
                'lat' => $restaurant->restaurant_latitude ,
                'lon' => $restaurant->restaurant_longitude,
                'animation' => 'none',
                'markers' => $marker

            );
            $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
            $map->initialize($config);
            $html = $map->generate();
            $GoogleMapsView = new ViewModel(array('map_html' => $html));
            $GoogleMapsView->setTemplate('block/map');

            $detailed_information_view->setVariable('restaurant',$restaurant);
            $navigation_restaurant_view->setVariable('restaurant',$restaurant);
            $view->setVariable('restaurant',$restaurant);


            $view->addChild($top_view,'topview')->addChild($navigation_restaurant_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_attraction');
            return $view;

        }
        catch(\Exception $ex){
            return $this->redirect()->toRoute('restaurant',array('action'=>'index'));
        }

    }
    public  function restaurantMenuAction(){
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');

        $rightside_top_view = new ViewModel();
        $rightside_top_view->setTemplate('block/rightside');
        $top_view->addChild($rightside_top_view,'rightside');
        $navigation_restaurant_view = new ViewModel();
        $navigation_restaurant_view->setTemplate('restaurant/restaurant/block/navigation_restaurant');

        $restaurant_id_name = (string)$this->params()->fromRoute('restaurant_id_name','');
        if(!$restaurant_id_name){
            return $this->redirect()->toRoute('restaurant',array('action'=>'index'));
        }
        try{
            $restaurant_menus= $this->getRestaurantMenuTable()->getRestaurantMenuByNameId($restaurant_id_name);//zlatoust
         //   $lunch = $this->getRestaurantMenuTypeDescriptionTable()->getRestaurantMenuTypeDescriptionTableByNameId($restaurant_id_name);//zlatoust
            $view = new ViewModel();
            $view->addChild($top_view,'topview')->addChild($navigation_restaurant_view,'navigation');
            $view->setVariable('restaurant_menus',$restaurant_menus);
           // $view->setVariable('lunch',$lunch);
            return $view;
        }
        catch(\Exception $ex){
            return $this->redirect()->toRoute('restaurant',array('action'=>'index'));
        }
    }
    public  function getRestaurantTable(){
        if (!$this->restaurantsTable) {
            $sm = $this->getServiceLocator();
            $this->restaurantsTable = $sm->get('Restaurant\Model\RestaurantTable');
        }
        return $this->restaurantsTable;
    }
    public  function getRestaurantMenuTable(){
        if (!$this->restaurantMenuTable) {
            $sm = $this->getServiceLocator();
            $this->restaurantMenuTable = $sm->get('Restaurant\Model\RestaurantMenuTable');
        }
        return $this->restaurantMenuTable;
    }
    public  function getRestaurantMenuTypeDescriptionTable(){
        if (!$this->restaurantMenuTableTypeDescription) {
            $sm = $this->getServiceLocator();
            $this->restaurantMenuTableTypeDescription = $sm->get('Restaurant\Model\RestaurantMenuTableTypeDescription');
        }
        return $this->restaurantMenuTableTypeDescription;
    }

}