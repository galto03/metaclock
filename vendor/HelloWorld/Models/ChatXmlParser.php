<?php
/**
 * Created by PhpStorm.
 * User: Tomer
 * Date: 4/4/2015
 * Time: 3:14 PM
 */

namespace HelloWorld\Models;


class ChatXmlParser extends \Swiftlet\Abstracts\Model {

    const PATH_TO_XML = 'chat.xml';
    private $_xml;

    function __construct() {
        $this->createXMLIfNeeded();
        $this->_xml=simplexml_load_file(self::PATH_TO_XML);
        if ($this->_xml === false)
        {
            throw new Exception("Could not parse the XML");
        }
    }

    function createXMLIfNeeded()
    {
        if (!file_exists(self::PATH_TO_XML))
        {
            $generatedFile = fopen(self::PATH_TO_XML, "w");
            fwrite($generatedFile,"<?xml version=\"1.0\" encoding=\"UTF-8\"?><app><messages></messages></app>");
        }
    }

    function updateXML()
    {
        $generatedFile = fopen(self::PATH_TO_XML, "w");
        fwrite($generatedFile,$this->_xml->asXML());
    }

    function getAllMessages()
    {
        return $this->_xml->xpath('/app/messages/message');
    }

    function getNewCookieChatID() {
        $maxID = 0;
        $msgs = $this->getAllMessages();
        foreach($msgs as $msg)
        {
            // For each iteration we save the highest ID encountered
            if (intval($msg['cookie_chat_id']) > $maxID)
                $maxID = intval($msg['cookie_chat_id']);
        }

        return $maxID + 1;
    }

    function addMessage($text)
    {
        if (!isset($_COOKIE['cookie_chat_id']))
            $_COOKIE['cookie_chat_id'] = $this->getNewCookieChatID();

        // Add new task child node
        $newMsg = $this->_xml->messages->addChild('message',$text);

        // Add the attributes
        $newMsg->addAttribute('time',gmdate('h:i:s \G\M\T'));
        $newMsg->addAttribute('cookie_chat_id',$_COOKIE['cookie_chat_id']);


        // Output the new XML
        //echo(json_encode($this->_xml->asXML()));

        // Update
        $this->updateXML();

    }

} 