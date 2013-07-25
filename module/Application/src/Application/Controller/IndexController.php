<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Attraction\Controller\AttractionController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Attraction\Model\Attraction;
use Attraction\Model\AttractionTable;

class IndexController extends AbstractActionController
{
    //attraction table
    protected $attractionTable;
    public function indexAction()
    {

        $attractions = $this->getAttractionTable()->fetchAll();
        $marker ="";
        foreach($attractions as $attraction) :{
            if($attraction){
             // $marker = array($attraction->attraction_name => $attraction->attraction_latitude,$attraction->attraction_longitude);
              //array_push($markers,$marker);
                $marker =  array(
                    //$attraction->attraction_name => $attraction->attraction_latitude , $attraction->attraction->longitude,
                );
            }
        }endforeach;

                    //Initialize map
                    $config = array(
                        'sensor' => 'true',
                        'div_id' => 'map',
                        'div_class' => 'grid_6',
                        'zoom' => 14,
                        'width' => '150%',
                        'height' => '416px',
                        'left' => '14%',
                        'lat' => 44.4975,
                        'lon' => 34.17314,
                        'animation' => 'none',

                        'markers' => $marker
                    );
                    $map = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                    $map->initialize($config);
                    $html = $map->generate();

                    $GoogleMapsView = new ViewModel(array('map_html' => $html));
                    $GoogleMapsView->setTemplate('block/map');

                    //Topline block
                    $view = new ViewModel();
                    $topline_view = new ViewModel();
                    $topline_view->setTemplate('block/topline');

                    //Navigation block
                    $navigation_view = new ViewModel();
                    $navigation_view->setTemplate('block/navigation');

                    //Update location block
                    $update_location_view = new ViewModel();
                    $update_location_view->setTemplate('block/update_location');

                    //Modal window block
                    $modal_window = new ViewModel();
                    $modal_window->setTemplate('block/modal-window');

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

                    //Attraction  category block
                    $attraction_block = new ViewModel();
                    $attraction_block->setTemplate('block/categories/attractions');
                    $attraction_block->setVariable('attractions',$attractions);

                    //map modal block
                    $map_modal_block = new ViewModel();
                    $map_modal_block->setTemplate('block/map-modal');

                    //social_block
                    $social_block = new ViewModel();
                    $social_block->setTemplate('block/social');

                    //social_block
                    $event_calendar_block = new ViewModel();
                    $event_calendar_block->setTemplate('block/event_calendar');

                    $file_upload_block = new ViewModel();
                    $file_upload_block->setTemplate('block/form_upload');



                    //add all these blockes
                    $view->addChild($topline_view,'topline')
                         ->addChild($top_view,'top')
                         ->addChild($navigation_view,'navigation')
                         ->addChild($GoogleMapsView,'google_maps')
                         ->addChild($update_location_view,'update_location')
                         ->addChild($modal_window,'modal_window')
                         ->addChild($categories_window,'categories')
                         ->addChild($filter_window,'filter')
                         ->addChild($attraction_block,'attractions')
                         ->setVariable($marker,'marker')
                         ->addChild($map_modal_block,'map_modal')
                         ->addChild($social_block,'social')
                         ->addChild($event_calendar_block,'event_calendar')
                         ->addChild($file_upload_block,'upload');


                  //  AttractionController::getMethodFromAction('getAttractionTable');

                    return $view;
    }
    public  function adminAction(){
        return $this->redirect()->toRoute('zfcadmin');
    }
    public function getAttractionTable()
    {
        if (!$this->attractionTable) {
            $sm = $this->getServiceLocator();
            $this->attractionTable = $sm->get('Attraction\Model\AttractionTable');
        }
        return $this->attractionTable;
    }

}
