<?php
namespace ZfcAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Cafe\Form\CafeForm;
use Cafe\Model\Cafe;




class AdminCafeController extends AbstractActionController
{

    protected $cafeTable;

    public  function cafeAdminAction(){
        $view = new ViewModel();

        $cafes = $this->getCafesTable()->fetchAll();

        $view->setVariable('cafes', $cafes);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');
        return $view;
    }
    public  function cafeAddAction(){
        $view = new ViewModel();
        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $view->addChild($sidebar,'sidebar');

        $form = new CafeForm();

        $form->get('submit')->setValue('Добавить кафе');


        $request = $this->getRequest();
        if ($request->isPost()) {
            $cafe = new Cafe();
            $form->setInputFilter($cafe->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){
                $cafe->exchangeArray($form->getData());
                $this->getCafesTable()->saveCafe($cafe);
                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/cafes');
            }

        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form,'view' => $view);
    }
    public  function cafeDeleteAction(){
        $cafe_id = (string) $this->params()->fromRoute('cafe_id',0);
        if (!$cafe_id) {
            return $this->redirect()->toRoute('zfcadmin/attractions');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Нет');
            if ($del == 'Да') {

                $this->getCafesTable()->deleteCafe($cafe_id);
                return $this->redirect()->toRoute('zfcadmin/cafes');

            }
        }

        return array(
            'cafe_id'    => $cafe_id,
            'cafe' => $this->getCafesTable()->getCafe($cafe_id)
        );
    }
    public  function cafeEditAction()
    {
        $cafe_id_name = (string) $this->params()->fromRoute('cafe_id_name', 0);
        $cafe = $this->getCafesTable()->getCafeByIdName($cafe_id_name);

        $form  = new CafeForm();
        $form->bind($cafe);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        if ($this->getRequest()->isPost()) {
            //$form->setInputFilter($cafe)->getInputFilter();
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($data);

            if ($form->isValid()) {
                $this->getCafesTable()->saveCafe($cafe);
                return $this->redirect()->toRoute('zfcadmin/cafes');
            }
        }
        return array(
            'cafe_id_name' => $cafe_id_name,
            'form' => $form,
        );
    }

    /*GET FUNCTIONS*/
    public function getCafesTable()
    {
        if (!$this->cafeTable) {
            $sm = $this->getServiceLocator();
            $this->cafeTable = $sm->get('Cafe\Model\CafeTable');
        }
        return $this->cafeTable;
    }


}