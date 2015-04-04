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

    function trimMessagesCount($number) {
        $initialCount = count($this->getAllMessages());
        for($i = 1 ; $i <= $initialCount - $number ; ++$i)
        {
            if (count($this->getAllMessages()) > $number)
            {
                $node = $this->_xml->xpath('/app/messages/message[1]');

                // Extract the first occurance
                if (count($node) >= 1)
                {
                    $node = $node[0];
                }

                // Remove the <task> node
                $dom = dom_import_simplexml($node);
                $dom->parentNode->removeChild($dom);

                // Save to file
                $this->updateXML();
            }
            else
                return true;
        }
        return true;
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
        $this->trimMessagesCount(19);

        if (!isset($_COOKIE['cookie_chat_id'])) {
            setcookie("cookie_chat_id", $this->getNewCookieChatID());
        }

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