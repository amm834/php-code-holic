<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{

  public function contact() {
    $this->render('contact', $params);
  }
}