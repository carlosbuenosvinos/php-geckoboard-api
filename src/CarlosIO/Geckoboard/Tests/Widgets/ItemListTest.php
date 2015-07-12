<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Data\ItemList\Label;
use CarlosIO\Geckoboard\Data\ItemList\Title;
use CarlosIO\Geckoboard\Widgets\ItemList;

class ItemListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getDataWithNoItems()
    {
        $widget = new ItemList();

        $json = json_encode($widget->getData());
        $this->assertEquals('[]', $json);
    }

    /**
     * @test
     */
    public function canAddSingleItem()
    {
        $widget = new ItemList();

        $title = new Title();
        $title->setText("Title text");
        $title->setHighlight(true);

        $label = new Label();
        $label->setName("Label name");
        $label->setColor("red");

        $widget->addItem($title, $label, 'description');
        $json = json_encode($widget->getData());
        $this->assertEquals('[{"title":{"text":"Title text","highlight":true},"label":{"name":"Label name","color":"red"},"description":"description"}]', $json);
    }

    /**
     * @test
     */
    public function canAddMultipleItems()
    {
        $widget = new ItemList();

        $title = new Title();
        $title->setText("Title text");
        $title->setHighlight(true);

        $title2 = new Title();
        $title2->setText("Title2 text");
        $title2->setHighlight(false);

        $label = new Label();
        $label->setName("Label name");
        $label->setColor("red");

        $label2 = new Label();
        $label2->setName("Label2 name");
        $label2->setColor("blue");

        $widget->addItem($title, $label, 'description1');
        $widget->addItem($title2, $label2, 'description2');
        $json = json_encode($widget->getData());
        $this->assertEquals('[{"title":{"text":"Title text","highlight":true},"label":{"name":"Label name","color":"red"},"description":"description1"},{"title":{"text":"Title2 text","highlight":false},"label":{"name":"Label2 name","color":"blue"},"description":"description2"}]', $json);
    }

    /**
     * @test
     */
    public function canHaveNoLabel()
    {
        $widget = new ItemList();

        $title = new Title();
        $title->setText("Title text");
        $title->setHighlight(true);

        $widget->addItem($title, null, 'description');
        $json = json_encode($widget->getData());
        $this->assertEquals('[{"title":{"text":"Title text","highlight":true},"description":"description"}]', $json);
    }
}
