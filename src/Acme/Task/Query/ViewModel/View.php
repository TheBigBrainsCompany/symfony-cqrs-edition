<?php

namespace Acme\Task\Query\ViewModel;

/**
 * Default Implementation for the View interface.
 *
 * Convenience View that helps with construction by mapping an array input
 * to view properties. If a passed property does not exist on the class,
 * it is simply ignored.
 *
 * @example
 *
 *   class PostView extends View
 *   {
 *      public $title;
 *      public $content;
 *   }
 *   $view = new PostView(array('title' => 'My title', 'content' => 'My content'));
 */
abstract class View implements ViewInterface
{
    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key )) {
                $this->$key = $value;
            }
        }
    }

    public function toArray()
    {
        $data = array();

        $reflection = new \ReflectionClass($this);
        foreach($reflection->getProperties() as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }
}
