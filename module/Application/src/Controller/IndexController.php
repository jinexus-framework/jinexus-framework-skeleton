<?php

declare(strict_types=1);

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
    public function indexAction(): ViewModel
    {
        // Pass a variable to the view
        return new ViewModel([
            'helloWorld' => 'Hello World!',
        ]);
    }
}
