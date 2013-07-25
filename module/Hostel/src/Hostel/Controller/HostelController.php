<?php
namespace Hostel\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hostel\Controller;
use Zend\View\ViewEvent;


class HostelController extends AbstractActionController{

    protected $hostelTable;


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

        $hostels = $this->getHostelTable()->fetchAll();
        $view->setVariable('hostels',$hostels);
        $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
        return $view;

    }
    public  function hostelAction(){
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');

        $rightside_top_view = new ViewModel();
        $rightside_top_view->setTemplate('block/rightside');
        $top_view->addChild($rightside_top_view,'rightside');

        $detailed_information_view = new ViewModel();
        $detailed_information_view->setTemplate('hostel/hostel/block/detailed_information');

        $navigation_hostel_view = new ViewModel();
        $navigation_hostel_view->setTemplate('hostel/hostel/block/navigation_hostel');

        $hostel_id_name = (string)$this->params()->fromRoute('hostel_id_name','');
        if(!$hostel_id_name){
            return $this->redirect()->toRoute('hostel',array('action'=>'index'));
        }
        try{
            $hostel = $this->getHostelTable()->getHostelByNameId($hostel_id_name);//zlatoust
            $view = new ViewModel();
            /*  https://github.com/gowsram/zf2-google-maps-   */
            $marker = array(
                $hostel->hostel_id_name =>   $hostel->hostel_latitude .','. $hostel->hostel_longitude,
            );

            $config = array(
                'sensor' => 'false',
                'div_id' => 'map',
                'div_class' => 'map',
                'zoom' => 13,
                'width' => '151%',
                'height'=> '254px',
                'right' => '10%',
                'lat' => $hostel->hostel_latitude ,
                'lon' => $hostel->hostel_longitude,
                'animation' => 'none',
                'markers' => $marker

            );
            $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
            $map->initialize($config);
            $html = $map->generate();
            $GoogleMapsView = new ViewModel(array('map_html' => $html));
            $GoogleMapsView->setTemplate('block/map');

            $detailed_information_view->setVariable('hostel',$hostel);
            $navigation_hostel_view->setVariable('hostel',$hostel);


            $view->addChild($top_view,'topview')->addChild($navigation_hostel_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_attraction');
            return $view;

        }
        catch(\Exception $ex){
            return $this->redirect()->toRoute('hostel',array('action'=>'index'));
        }

    }
    public  function getHostelTable(){
        if (!$this->hostelTable) {
            $sm = $this->getServiceLocator();
            $this->hostelTable = $sm->get('Hostel\Model\HostelTable');
        }
        return $this->hostelTable;
    }


}