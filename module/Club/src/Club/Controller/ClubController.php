<?php
namespace Club\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class ClubController extends AbstractActionController{

    protected $clubTable;

    public  function clubClientAction(){
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

        $social_view = new ViewModel();
        $social_view->setTemplate('block/social');

        $clubs = $this->getClubTable()->fetchAll();
        $view->setVariable('clubs',$clubs);
        $view->addChild($top_view,'topview')
            ->addChild($navigation_view,'navigation')
            ->addChild($social_view,'social')
            ->addChild($categories_window,'category');
        return $view;

    }
    public  function clubAction(){
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');

        $rightside_top_view = new ViewModel();
        $rightside_top_view->setTemplate('block/rightside');
        $top_view->addChild($rightside_top_view,'rightside');

        $detailed_information_view = new ViewModel();
        $detailed_information_view->setTemplate('club/club/block/detailed_information');

        $navigation_club_view = new ViewModel();
        $navigation_club_view->setTemplate('club/club/block/navigation_club');


        $club_id_name = (string)$this->params()->fromRoute('club_id_name','');
        if(!$club_id_name){
            return $this->redirect()->toRoute('club',array('action'=>'index'));
        }
        try{


            $club = $this->getClubTable()->getClubByNameId($club_id_name);//zlatoust
            //$attraction_news = $this->getAttractionNewsTable()->getAttractionNewsByIdName($attraction_id_name);//zlatoust
            $view = new ViewModel();

            /*  https://github.com/gowsram/zf2-google-maps-   */
            $marker = array(
                $club->club_id_name =>   $club->club_latitude .','. $club->club_longitude,
            );

            $config = array(
                'sensor' => 'false',
                'div_id' => 'map',
                'div_class' => 'map',
                'zoom' => 13,
                'width' => '151%',
                'height'=> '254px',
                'right' => '10%',
                'lat' => $club->club_latitude,
                'lon' => $club->club_longitude,
                'animation' => 'none',
                'markers' => $marker

            );
            $map  = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
            $map->initialize($config);
            $html = $map->generate();
            $GoogleMapsView = new ViewModel(array('map_html' => $html));
            $GoogleMapsView->setTemplate('block/map');

            $detailed_information_view->setVariable('club',$club);
            $navigation_club_view->setVariable('club',$club);
            $view->setVariable('club',$club);
//            $view->setVariable('attraction_news',$restaurant_news);
            $clubs = $this->getClubTable()->fetchAll();
            $view->setVariable('clubs',$clubs);

            $view->addChild($top_view,'topview')->addChild($navigation_club_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_attraction');
            return $view;

        }
        catch(\Exception $ex){
            return $this->redirect()->toRoute('club',array('action'=>'index'));
        }

    }
    public  function getClubTable(){
        if (!$this->clubTable) {
            $sm = $this->getServiceLocator();
            $this->clubTable = $sm->get('Club\Model\ClubTable');
        }
        return $this->clubTable;
    }

}