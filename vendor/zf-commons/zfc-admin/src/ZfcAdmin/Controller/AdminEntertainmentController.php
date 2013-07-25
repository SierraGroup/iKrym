<?php
namespace ZfcAdmin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Mvc\Controller\AbstractActionController;


use Entertainment\Form\EntertainmentForm;
use Entertainment\Model\Entertainment;

use Entertainment\Form\EntertainmentNewsForm;
use Entertainment\Model\EntertainmentNews;

use Entertainment\Form\EntertainmentPosterForm;
use Entertainment\Model\EntertainmentPoster;

const ROUTE_LOGIN = 'zfcuser/login';

class AdminEntertainmentController extends AbstractActionController
{
    //entertainments table
    protected $entertainmentTable;
    protected $entertainmentNewsTable;
    protected $entertainmentPosterTable;

    public  function entertainmentAdminAction(){
        $entertainment_view = new ViewModel();

        $entertainment_table = $this->getEntertainmentTable()->fetchAll();

        $entertainment_view->setVariable('entertainments', $entertainment_table);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $entertainment_view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $entertainment_view->addChild($sidebar,'sidebar');
        return $entertainment_view;

    }
    public  function  getEntertainmentTable(){
        if (!$this->entertainmentTable) {
            $sm = $this->getServiceLocator();
            $this->entertainmentTable = $sm->get('Entertainment\Model\EntertainmentTable');
        }
        return $this->entertainmentTable;
    }
    public  function  getEntertainmentNewsTable(){
        if (!$this->entertainmentNewsTable) {
            $sm = $this->getServiceLocator();
            $this->entertainmentNewsTable = $sm->get('Entertainment\Model\EntertainmentNewsTable');
        }
        return $this->entertainmentNewsTable;
    }
    public  function  getEntertainmentPosterTable(){
        if (!$this->entertainmentPosterTable) {
            $sm = $this->getServiceLocator();
            $this->entertainmentPosterTable = $sm->get('Entertainment\Model\EntertainmentPosterTable');
        }
        return $this->entertainmentPosterTable;
    }

    public  function entertainmentAddAction(){
        $form = new EntertainmentForm();
        $form->get('submit')->setValue('Добавить развлечение');
        $request = $this->getRequest();


        if ($request->isPost()) {
            $entertainment = new Entertainment();
            $form->setInputFilter($entertainment->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $entertainment->exchangeArray($form->getData());
                $this->getEntertainmentTable()->saveEntertainment($entertainment);

                // Form is valid, save the form!
                return $this->redirect()->toRoute('zfcadmin/entertainments');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function entertainmentNewsAddAction(){
        $form = new EntertainmentNewsForm();

        $form->get('submit')->setValue('Добавить новость');
        $entertainment_id_name = (string) $this->params()->fromRoute('entertainment_id_name', 0);
        $form->get('entertainment_id_name')->setValue($entertainment_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $entertainment_news = new EntertainmentNews();
            $form->setInputFilter($entertainment_news->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $entertainment_news->exchangeArray($form->getData());
                $this->getEntertainmentNewsTable()->saveEntertainmentNews($entertainment_news);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/entertainments');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function entertainmentDeleteAction(){
        $entertainment_id = (int) $this->params()->fromRoute('entertainment_id',0);
        if (!$entertainment_id) {
            return $this->redirect()->toRoute('zfcadmin/entertainments');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($entertainment_id) {

                $this->getEntertainmentTable()->deleteEntertainment($entertainment_id);

                return $this->redirect()->toRoute('zfcadmin/entertainments');
            }
        }
        return array(
            'entertainment_id'    => $entertainment_id,
            'entertainment' => $this->getEntertainmentTable()->getEntertainment($entertainment_id)
        );
    }
    public  function entertainmentEditAction()
    {
        $entertainment_id_name = (string) $this->params()->fromRoute('entertainment_id_name', 0);
        $entertainment = $this->getEntertainmentTable()->getEntertainmentByNameId($entertainment_id_name);

        $form  = new EntertainmentForm();
        $form->bind($entertainment);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($entertainment->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($data);

            if ($form->isValid()) {
                $this->getEntertainmentTable()->saveEntertainment($entertainment);

                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/entertainments');
            }
        }
        return array(
            'entertainment_id_name' => $entertainment_id_name,
            'form' => $form,
        );
    }
    public  function entertainmentPosterAddAction(){

        $form = new EntertainmentPosterForm();

        $form->get('submit')->setValue('Добавить афишу');
        $entertainment_id_name = (string) $this->params()->fromRoute('entertainment_id_name', 0);
        $form->get('entertainment_id_name')->setValue($entertainment_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $entertainment_poster = new EntertainmentPoster();
            $form->setInputFilter($entertainment_poster->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $entertainment_poster->exchangeArray($form->getData());
                $this->getEntertainmentPosterTable()->saveEntertainmentPoster($entertainment_poster);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/entertainments');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);

    }
}