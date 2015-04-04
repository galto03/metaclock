<?php

namespace HelloWorld\Controllers;
use HelloWorld\Models\ChatXmlParser;

/**
 * Index controller
 */
class Ajax extends \Swiftlet\Abstracts\Controller
{

    /**
     * Default action
     * @param $args array
     */
    public function index(array $args = array())
    {
        // Create a model instance, see /HelloWorld/Models/Example.php
        $xmlParser = $this->app->getModel('chatxmlparser');
//        $a = new ChatXmlParser();
//        $a->addMessage("Hello");

        $this->view->response = 'Fuck you';

        // Get some data from the model and pass it to the view to display it
        //$this->view->helloWorld = $example->getHelloWorld();
    }

    public function get_chat_messages(array $args = array())
    {
        // Create a model instance, see /HelloWorld/Models/Example.php
        $xmlParser = $this->app->getModel('chatxmlparser');
//        $a = new ChatXmlParser();
//        $a->addMessage("Hello");

        $this->view->response = $_GET;

        // Get some data from the model and pass it to the view to display it
        //$this->view->helloWorld = $example->getHelloWorld();
    }

    public function submit_message(array $args = array())
    {
        // Create a model instance, see /HelloWorld/Models/Example.php
        $xmlParser = $this->app->getModel('chatxmlparser');
//        $a = new ChatXmlParser();
//        $a->addMessage("Hello");

        $this->view->response = $_GET['msg'];

        // Get some data from the model and pass it to the view to display it
        //$this->view->helloWorld = $example->getHelloWorld();
    }
}
