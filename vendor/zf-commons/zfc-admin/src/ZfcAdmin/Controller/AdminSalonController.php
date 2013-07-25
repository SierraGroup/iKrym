<?php
namespace ZfcAdmin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Restaurant\Controller;

class AdminSalonController extends AbstractActionController{
    protected $salonTable;



    public  function salonAdminAction(){


        $salon_view = new ViewModel();

        $salon_table = $this->getSalonTable()->fetchAll();

        $salon_view->setVariable('salons', $salon_table);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $salon_view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $salon_view->addChild($sidebar,'sidebar');
        return $salon_view;
    }
    public  function salonAddAction(){

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
            return $this->redirect()->toRoute('zfcadmin/salons',array('action'=>'index'));
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
            $salones = $this->getSalonTable()->fetchAll();
            $view->setVariable('salones',$salones);

            $view->addChild($top_view,'topview')->addChild($navigation_salon_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_salon')->addChild($map_modal_block,'map-modal');
            return $view;

        }
        catch(\Exception $ex){
            return $this->redirect()->toRoute('salon',array('action'=>'index'));
        }

    }
    public  function salonPosterAction(){
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');

        $rightside_top_view = new ViewModel();
        $rightside_top_view->setTemplate('block/rightside');
        $top_view->addChild($rightside_top_view,'rightside');

        $detailed_information_view = new ViewModel();
        $detailed_information_view->setTemplate('salon/block/detailed_information');

        $navigation_salon_view = new ViewModel();
        $navigation_salon_view->setTemplate('salon/block/navigation_salon');
        $salon_id_name = (string)$this->params()->fromRoute('salon_id_name','');
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
            $salones = $this->getSalonTable()->fetchAll();
            $view->setVariable('salones',$salones);
            $view->addChild($top_view,'topview')->addChild($navigation_salon_view,'navigation')->addChild($detailed_information_view,'detailed_information')->addChild($GoogleMapsView,'map_salon');
            return $view;
        }
        catch(\Exception $ex){
            return $this->redirect()->toRoute('salon',array('action'=>'index'));
        }
    }
    public  function salonPhotoreportAction(){
        $top_view = new ViewModel();
        $top_view->setTemplate('block/top');

        $rightside_top_view = new ViewModel();
        $rightside_top_view->setTemplate('block/rightside');
        $top_view->addChild($rightside_top_view,'rightside');

        $navigation_salon_view = new ViewModel();
        $navigation_salon_view->setTemplate('salon/block/navigation_salon');
        try{

            $view = new ViewModel();
            $salon_id_name = (string)$this->params()->fromRoute('salon_id_name','');
            $salon = $this->getSalonTable()->getSalonByNameId($salon_id_name);//zlatoust
            $view->setVariable('salon',$salon);
            $view->addChild($top_view,'topview')->addChild($navigation_salon_view,'navigation');
            return $view;
        }catch(\Exception $ex){
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