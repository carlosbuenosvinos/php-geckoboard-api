<?php
namespace CarlosIO\Geckoboard\Widgets;

abstract class Widget
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    abstract public function getData();
}