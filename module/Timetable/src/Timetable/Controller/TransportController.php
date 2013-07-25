<?php
        namespace Timetable\Controller;
        use Zend\Mvc\Controller\AbstractActionController;
        use Zend\View\Model\ViewModel;
        use Timetable\Model\Transport;
        use Restaurant\Controller;


        class TransportController extends AbstractActionController{

            protected $transportRoadMinibusTable;
            protected $sheduleRoadMinibusTable;


            public  function indexAction(){
                $view = new ViewModel();
                $topline_view = new ViewModel();
                $topline_view->setTemplate('block/topline');
                $top_view = new ViewModel();
                $top_view->setTemplate('block/top');
                $navigation_view = new ViewModel();
                $navigation_view->setTemplate('block/navigation');

                $categories_view = new ViewModel();
                $categories_view->setTemplate('block/categories');

                $view->addChild($topline_view,'topline')->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_view,'categories');
                return $view;

            }


            public  function minibusAction(){
                $view = new ViewModel();

                $topline_view = new ViewModel();
                $topline_view->setTemplate('block/topline');


                $top_view = new ViewModel();
                $top_view->setTemplate('block/top');

                $navigation_view = new ViewModel();
                $navigation_view->setTemplate('block/navigation');

                $transport_road_minibus = $this->getTransportRoadMinibusTable()->fetchAll();
                $view->setVariable('transport_road_minibus', $transport_road_minibus);
                $view->addChild($topline_view,'topline')->addChild($top_view,'topview')->addChild($navigation_view,'navigation');
                return $view;
            }
            public  function minibussheduleAction(){
                $view = new ViewModel();

                $topline_view = new ViewModel();
                $topline_view->setTemplate('block/topline');


                $top_view = new ViewModel();
                $top_view->setTemplate('block/top');

                $navigation_view = new ViewModel();
                $navigation_view->setTemplate('block/navigation');

                $shedule_road_minibus = $this->getSheduleRoadMinibusTable()->fetchAll();

                $view->setVariable('shedule_road_minibus', $shedule_road_minibus);
                $view->addChild($topline_view,'topline')->addChild($top_view,'topview')->addChild($navigation_view,'navigation');
                return $view;
            }
            public function getTransportRoadMinibusTable()
            {
                if (!$this->transportRoadMinibusTable) {
                    $sm = $this->getServiceLocator();
                    $this->transportRoadMinibusTable= $sm->get('Timetable\Model\transport_road_minibus_table');
                }
                return $this->transportRoadMinibusTable;
            }
            public function getSheduleRoadMinibusTable(){
                if (!$this->sheduleRoadMinibusTable) {
                    $sm = $this->getServiceLocator();
                    $this->sheduleRoadMinibusTable= $sm->get('Timetable\Model\SheduleRoadMinibusTable');
                }
                return $this->sheduleRoadMinibusTable;
            }
        }