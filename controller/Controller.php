<?php

namespace controller;

use model\Model;
use view\View;

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model;
        $this->model->setTwig('files');
        $this->model->setRouters(['upload']);
        $this->model->setNamePage();
        $this->setArrForCurrentPage();
        $this->model->uploadFiles();
        $this->model->downloadFile();
        $this->createView();
    }

    private function setArrForCurrentPage()
    {
        $this->model->setArrForCurrentPage();
    }

    private function createView()
    {
        $namePage = $this->model->getNamePage();
        $arr = $this->model->getArrForCurrentPage();
        $twig = $this->model->getTwig();

        new View($namePage, $arr, $twig);
    }
}