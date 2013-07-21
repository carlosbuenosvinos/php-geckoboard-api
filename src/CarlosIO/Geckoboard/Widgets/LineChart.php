<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

/**
 * Class LineChart 
 * @package CarlosIO\Geckoboard\Widgets
 */
class LineChart extends Widget
{
    CONST DIMENSION_X = 'x';
    CONST DIMENSION_Y = 'y';

    CONST DEFAULT_COLOUR = "ff9900";   

    /**
     * @var array
     */
    protected $items;

    /**
     * @var string
     */
    protected $colour;

    /**
     * @var array
     */
    protected $axis;

    /**
     * Set the items property
     *
     * @param array $items Set of items to add to the widget
     * @return $this
     */
    public function setItems(array $items)
    {
        foreach ($items as $item) {
          $this->addItem($item);
        }

        return $this;
    }

    /**
     * Return the items attribute
     *
     * @return array
     */
    public function getItems()
    {
        if (null === $this->items) {
            $this->items = array();
        }

        return $this->items;
    }

    /**
     * Add an item to the item list
     *
     * @param \CarlosIO\Geckoboard\Data\Text\Item $item Item to be added
     * @return $this
     */
    public function addItem($item)
    {
        if (!is_numeric($item)) {
          throw new \InvalidArgumentException(sprintf("Value '%s' must be a numeric value", $item));
        }

        $this->items[] = $item;

        return $this;
    }

    /**
     * Set the colour of the line in the widget
     *
     * @param string $colour Colour of the line in the widget in hexadecimal format
     * @return $this
     */
    public function setColour($colour)
    {
      if (!preg_match('/^[a-f0-9]{6}$/i', $colour)) {
        throw new \InvalidArgumentException(sprintf("Value %s must be a valid hex colour", $colour));
      }
     
      $this->colour = $colour;

      return $this;
    }

    /**
     * Return the colour of the line in the widget
     * 
     * @return string
     */
    public function getColour()
    {
      if (null === $this->colour) {
        $this->colour = self::DEFAULT_COLOUR;
      }

      return $this->colour;
    }

    /**
     * Set the elements to appear evenly spread along dimension
     *
     * @param string $dimension The dimension where labels will be displayed
     * @param array  $labels    Labels displayed in this axis
     */
    public function setAxis($dimension, $labels)
    {
      foreach($labels as $label) {
        $this->addLabel($dimension, $label);
      }
    }

    /**
     * Add a new label to an specific axis
     *
     * @param string $dimension The dimension where labels will be displayed
     * @param mix    $label     Label displayed in this axis
     */
    protected function addLabel($dimension, $label)
    {
      if (!in_array($dimension, array(self::DIMENSION_X, self::DIMENSION_Y))) {
        throw new \InvalidArgumentException(sprintf("Value '%s' is not a valid dimension", $dimension));
      }

      $this->axis[$dimension][] = $label;
    }

    /**
     * Return axises in a 2D array
     */
    public function getAxis()
    {
      if (null === $this->axis) {
        $this->axis[self::DIMENSION_X] = array();
        $this->axis[self::DIMENSION_Y] = array();
      }

      return $this->axis;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $axis = $this->getAxis();

        return array(
            'item' => $this->getItems(),
            'settings' => array(
              'axisx'  => $axis[self::DIMENSION_X],
              'axisy'  => $axis[self::DIMENSION_Y],
              'colour' => $this->getColour()
            )
        );
    }
}
