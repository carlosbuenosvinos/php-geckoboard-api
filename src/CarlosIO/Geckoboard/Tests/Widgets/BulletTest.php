<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Data\Bullet\Item;
use CarlosIO\Geckoboard\Widgets\Bullet;

class BulletTest extends \PHPUnit_Framework_TestCase
{
    public function testOrientation()
    {
        $myBullet = new Bullet();

        $this->assertEquals('horizontal', $myBullet->getOrientation());

        $myBullet->setOrientation('vertical');

        $this->assertEquals('vertical', $myBullet->getOrientation());
    }

    public function testGetDataWithItem()
    {
        $myBullet = new Bullet();

        $item = new Item();
        $item->setAxisPoint('x');
        $item->setComparative('comparative');
        $item->setLabel('label');
        $item->setMeasure('measure');
        $item->setRange('range');
        $item->setSublabel('sublabel');

        $myBullet->setItem($item);

        $expectedData = array(
            'orientation' => 'horizontal',
            'item' => array(
                'label' => $item->getLabel(),
                'sublabel' => $item->getSublabel(),
                'axis' => array('point' => $item->getAxisPoint()),
                'range' => $item->getRange(),
                'measure' => $item->getMeasure(),
                'comparative' => array('point' => $item->getComparative()),
            )
        );

        $this->assertEquals($expectedData, $myBullet->getData());
    }
}
