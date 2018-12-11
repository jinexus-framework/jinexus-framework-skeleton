<?php
namespace Application\Controller;

use JiNexus\Mvc\Controller\AbstractController;
use JiNexus\Mvc\Model\ViewModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        // Pass a variable to the view
        return new ViewModel([
            'helloWorld' => 'WTF! It Fucking Work!',
            'omg' => 'OMG',
        ]);
    }
}