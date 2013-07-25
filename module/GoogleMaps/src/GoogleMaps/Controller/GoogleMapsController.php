<?php
    namespace GoogleMaps\Controller;
    use Zend\Mvc\Controller\AbstractActionController;
    use Zend\View\Model\ViewModel;
    use Zend\View\View;

    class GoogleMapsController extends AbstractActionController{

               // protected  $albumTable;

                    public function indexAction(){
                               $markers = array(


                                   'Home Town' => '16.916684,80.683594'
                                );
                                $config = array(
                                    'sensor' => 'true',
                                    'div_id' => 'map',
                                    'div_class' => 'map',
                                    'zoom' => 13,
                                    'width' => '80%',
                                    'height' => '500px',
                                    'lat' => 44.4975,
                                    'lon' => 34.17314,
                                    'animation' => 'none',
                                    'markers' => $markers
                                );
                                $map = $this->getServiceLocator()->get('GoogleMaps\Service\GoogleMap');
                                $map->initialize($config);
                                $html = $map->generate();
                                $GoogleMapsView = new ViewModel(array('map_html' => $html));
                                $GoogleMapsView->setTemplate('googlemaps/googlemaps/index');

                                $menu_view = new ViewModel();
                                $menu_view->setTemplate('googlemaps/block/menu');
                                $GoogleMapsView->addChild($menu_view,'menu');

                                return $GoogleMapsView;
                    }
                    public  function addAction(){

                    }
                    public  function editAction(){

                    }
                    public  function deleteAction(){

                    }

            }
