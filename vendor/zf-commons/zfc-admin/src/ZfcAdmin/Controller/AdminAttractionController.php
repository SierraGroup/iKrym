<?php
namespace ZfcAdmin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Mvc\Controller\AbstractActionController;


use Attraction\Form\AttractionForm;
use Attraction\Model\Attraction;

use Attraction\Form\AttractionNewsForm;
use Attraction\Model\AttractionNews;

use Attraction\Form\AttractionPosterForm;
use Attraction\Model\AttractionPoster;

const ROUTE_LOGIN = 'zfcuser/login';

class AdminAttractionController extends AbstractActionController
{
    //attractions table
    protected $attractionTable;
    protected $attractionNewsTable;
    protected $attractionPosterTable;


    public  function indexAction(){

        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }else{
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

        $restaurants = $this->getAttractionTable()->fetchAll();
        $view->setVariable('attractions',$restaurants);
        $view->addChild($top_view,'topview')->addChild($navigation_view,'navigation')->addChild($categories_window,'category');
        return $view;
        }
    }

    public  function attractionAdminAction(){
        $attraction_view = new ViewModel();

        $attraction_table = $this->getAttractionTable()->fetchAll();

        $attraction_view->setVariable('attractions', $attraction_table);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $attraction_view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $attraction_view->addChild($sidebar,'sidebar');
        return $attraction_view;

    }
    public  function  getAttractionTable(){
        if (!$this->attractionTable) {
            $sm = $this->getServiceLocator();
            $this->attractionTable = $sm->get('Attraction\Model\AttractionTable');
        }
        return $this->attractionTable;
    }
    public  function  getAttractionNewsTable(){
        if (!$this->attractionNewsTable) {
            $sm = $this->getServiceLocator();
            $this->attractionNewsTable = $sm->get('Attraction\Model\AttractionNewsTable');
        }
        return $this->attractionNewsTable;
    }
    public  function  getAttractionPosterTable(){
        if (!$this->attractionPosterTable) {
            $sm = $this->getServiceLocator();
            $this->attractionPosterTable = $sm->get('Attraction\Model\AttractionPosterTable');
        }
        return $this->attractionPosterTable;
    }

    public  function attractionAddAction(){
        $form = new AttractionForm();
        $form->get('submit')->setValue('Добавить достопримечательность');
        $request = $this->getRequest();


        if ($request->isPost()) {
            $attraction = new Attraction();
            $form->setInputFilter($attraction->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $attraction->exchangeArray($form->getData());
                $this->getAttractionTable()->saveAttraction($attraction);

                // Form is valid, save the form!
                return $this->redirect()->toRoute('zfcadmin/attractions');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function attractionNewsAddAction(){
        $form = new AttractionNewsForm();

        $form->get('submit')->setValue('Добавить новость');
        $attraction_id_name = (string) $this->params()->fromRoute('attraction_id_name', 0);
        $form->get('attraction_id_name')->setValue($attraction_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $attraction_news = new AttractionNews();
            $form->setInputFilter($attraction_news->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $attraction_news->exchangeArray($form->getData());
                $this->getAttractionNewsTable()->saveAttractionNews($attraction_news);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/attractions');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function attractionDeleteAction(){
        $attraction_id = (int) $this->params()->fromRoute('attraction_id',0);
        if (!$attraction_id) {
            return $this->redirect()->toRoute('zfcadmin/attractions');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($attraction_id) {
                // $attraction_id = (int) $request->getPost('attraction_id');
                $this->getAttractionTable()->deleteAttraction($attraction_id);
                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/attractions');
            }
        }
        return array(
            'attraction_id'    => $attraction_id,
            'attraction' => $this->getAttractionTable()->getAttraction($attraction_id)
        );
    }
    public  function attractionEditAction()
    {
        $attraction_id_name = (string) $this->params()->fromRoute('attraction_id_name', 0);
        $attraction = $this->getAttractionTable()->getAttractionByNameId($attraction_id_name);

        $form  = new AttractionForm();
        $form->bind($attraction);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($attraction->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($data);

            if ($form->isValid()) {
                $this->getAttractionTable()->saveAttraction($attraction);

                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/attractions');
            }
        }
        return array(
            'attraction_id_name' => $attraction_id_name,
            'form' => $form,
        );
    }
    public  function attractionPosterAddAction(){

        $form = new AttractionPosterForm();

        $form->get('submit')->setValue('Добавить афишу');
        $attraction_id_name = (string) $this->params()->fromRoute('attraction_id_name', 0);
        $form->get('attraction_id_name')->setValue($attraction_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $attraction_poster = new AttractionPoster();
            $form->setInputFilter($attraction_poster->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $attraction_poster->exchangeArray($form->getData());
                $this->getAttractionPosterTable()->saveAttractionPoster($attraction_poster);

                // Form is valid, save the form!
                return $this->redirect()->toRoute('zfcadmin/attractions');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);

    }
}