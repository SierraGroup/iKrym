<?php
namespace ZfcAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

use Restaurant\Form\RestaurantForm;
use Restaurant\Model\Restaurant;

use Restaurant\Form\RestaurantMenuForm;
use Restaurant\Model\RestaurantMenu;

use Restaurant\Form\RestaurantNewsForm;
use Restaurant\Model\RestaurantNews;

class AdminRestaurantController extends AbstractActionController
{
    //restaurants table
    protected $restaurantsTable;
    protected $restaurantsMenuTable;
    protected $restaurantsNewsTable;
    const ROUTE_LOGIN   = 'zfcuser/login';

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

                    $restaurants = $this->getRestaurantsTable()->fetchAll();
                    $view->setVariable('restaurants',$restaurants);
                    $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
                    return $view;
        }

    public  function  restaurantAdminAction(){
        $view = new ViewModel();

        $restaurants = $this->getRestaurantsTable()->fetchAll();

        $view->setVariable('restaurants', $restaurants);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');
        return $view;
    }
    public  function  getRestaurantsTable()
    {
        if (!$this->restaurantsTable) {
            $sm = $this->getServiceLocator();
            $this->restaurantsTable = $sm->get('Restaurant\Model\RestaurantTable');
        }
        return $this->restaurantsTable;
    }
    public  function  getRestaurantsMenuTable()
    {
        if (!$this->restaurantsMenuTable) {
            $sm = $this->getServiceLocator();
            $this->restaurantsMenuTable = $sm->get('Restaurant\Model\RestaurantMenuTable');
        }
        return $this->restaurantsMenuTable;
    }
    public  function  getRestaurantsNewsTable()
    {
        if (!$this->restaurantsNewsTable) {
            $sm = $this->getServiceLocator();
            $this->restaurantsNewsTable = $sm->get('Restaurant\Model\RestaurantNewsTable');
        }
        return $this->restaurantsNewsTable;
    }

    public  function  restaurantsAddAction(){
        $view = new ViewModel();
        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');

        $form = new RestaurantForm();

        $form->get('submit')->setValue('Добавить ресторан');


        $request = $this->getRequest();
        if ($request->isPost()) {


            $restaurant = new Restaurant();
            $form->setInputFilter($restaurant->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){
                $restaurant->exchangeArray($form->getData());
                $this->getRestaurantsTable()->saveRestaurant($restaurant);
                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/restaurants');
            }

        }
        return array('form' => $form,'view' => $view);
    }
    public  function  restaurantNewsAddAction(){
        $form = new RestaurantNewsForm();

        $form->get('submit')->setValue('Добавить новость');
        $restaurant_id_name = (string) $this->params()->fromRoute('restaurant_id_name', 0);
        $form->get('restaurant_id_name')->setValue($restaurant_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $restaurant_news = new RestaurantNews();
            $form->setInputFilter($restaurant_news->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $restaurant_news->exchangeArray($form->getData());
                $this->getRestaurantsNewsTable()->saveRestaurantNews($restaurant_news);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/attractions');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function  restaurantMenuAction(){

    }
    public  function  restaurantMenuAddAction(){
        $view = new ViewModel();
        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');

        $form = new RestaurantMenuForm();
        $restaurant_id_name = (string) $this->params()->fromRoute('restaurant_id_name', 0);
        $form->get('restaurant_id_name')->setValue($restaurant_id_name);
        $form->get('submit')->setValue('Добавить меню');


        $request = $this->getRequest();
        if ($request->isPost()) {
            $restaurant_menu = new RestaurantMenu();

            $form->setInputFilter($restaurant_menu->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){
                $restaurant_menu->exchangeArray($form->getData());
                $this->getRestaurantsMenuTable()->saveRestaurantMenu($restaurant_menu);
                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/restaurants');
            }

        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form,'view' => $view);
    }
    public  function  restaurantsDeleteAction(){
        $restaurant_id = (string) $this->params()->fromRoute('restaurant_id',0);
        if (!$restaurant_id) {
            return $this->redirect()->toRoute('zfcadmin/attractions');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Нет');
            if ($del == 'Да') {

                $this->getRestaurantsTable()->deleteRestaurant($restaurant_id);
                return $this->redirect()->toRoute('zfcadmin/restaurants');

            }
        }

        return array(
            'restaurant_id'    => $restaurant_id,
            'restaurant' => $this->getRestaurantsTable()->getRestaurant($restaurant_id)
        );
    }
    public  function  restaurantsEditAction()
    {
        $restaurant_id = (int)$this->params()->fromRoute('restaurant_id', 0);
        if (!$restaurant_id) {
            return $this->redirect()->toRoute('zfcadmin/restaurants', array(
                'action' => 'zfcadmin/restaurants/add'
            ));
        }

        try {
            $restaurant = $this->getRestaurantsTable()->getRestaurant($restaurant_id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('zfcadmin/restaurants', array(
                'action' => 'zfcadmin/restaurants/add'
            ));
        }

        $form  = new RestaurantForm();
        $form->bind($restaurant);
        $form->get('submit')->setAttribute('value', 'Редактировать ресторан');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($restaurant->getInputFilter());
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()) {

                $this->getRestaurantsTable()->saveRestaurant($restaurant);

                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/restaurants');
            }
        }

        return array(
            'restaurant_id' => $restaurant_id,
            'form' => $form,
        );
    }
}