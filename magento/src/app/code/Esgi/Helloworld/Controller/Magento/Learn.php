<?php

// app/code/Esgi/Helloworld/Controller/Magento/Learn.php
namespace Esgi\Helloworld\Controller\Magento;
class Learn extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        echo 'Execute Action Learn OK';
        die();
    }
}