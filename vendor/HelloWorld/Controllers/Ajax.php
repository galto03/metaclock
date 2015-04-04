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
        $xmlParser = $this->app->getModel('chatxmlparser');

        $this->view->response = 'Fuck you';

    }

    public function get_chat_messages(array $args = array())
    {
        $xmlParser = $this->app->getModel('chatxmlparser');
        $chat = new ChatXmlParser();

        $this->view->response = $chat->getAllMessages();

    }

    public function submit_message(array $args = array())
    {
        if (!isset($_POST['msg']))
        {
            $this->view->response = false;
            return;
        }

        $xmlParser = $this->app->getModel('chatxmlparser');
        $chat = new ChatXmlParser();

        $msg = urldecode($_POST['msg']);

        $chat->addMessage($msg);

        $this->view->response = $chat->getAllMessages();
    }
}
