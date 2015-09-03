<?php
namespace StaticPage\Controller;

use SbxCommon\Crud\AbstractController as AbstractCrudController;
/**
 * Class AclRolesController
 * @package System\Controller
 *
 *  * @method \System\Model\AclRole getModelToProcess
 */
class StaticPagesController extends AbstractCrudController
{
    /**
     * @return \StaticPage\Model\StaticPage
     */
    public function getModel()
    {
        return $this->getServiceLocator()->get('StaticPage/Model/StaticPage');
    }

    public function moxiemanagerAction()
    {
        $mm = $this->getServiceLocator()->get('Moxiemanager/Bridge')->getPreset('staticPage')->process();
        exit();
    }
}
