<?php

namespace CarlosIO\Geckoboard\Widgets;

class HighchartsChartTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonForSingleSeriesData()
    {
        $myWidget = new HighchartsChart();
        $myWidget->setId('56797-7e3d4237-f798-433a-abe7-ac1857dfdf0f');

        $myWidget->setType('line');
        $myWidget->setTitle('Monthly Average Temperature');
        $myWidget->setSubtitle('Source: WorldClimate.com');
        $myWidget->setXAxisLabels(array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'));
        $myWidget->setYAxisTitle('Temperature (°C)');
        $myWidget->setSingleSerie('Tokyo', array(7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6));
        $myWidget->setSingleSerie('London', array(3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8));

        $data = $myWidget->getData();
        $json = json_encode($data);

        $testJson = '{"highchart":{"chart":{"type":"line"},"title":{"text":"Monthly Average Temperature"},"subtitle":{"text":"Source: WorldClimate.com"},'.
            '"xAxis":{"categories":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]},'.
            '"yAxis":{"title":{"text":"Temperature (\u00b0C)"}},"plotOptions":{"line":{"dataLabels":{"enabled":true},"enableMouseTracking":false}},'.
            '"series":[{"name":"Tokyo","data":[7,6.9,9.5,14.5,18.4,21.5,25.2,26.5,23.3,18.3,13.9,9.6],"type":"line"},{"name":"London","data":[3.9,4.2,5.7,8.5,'.
            '11.9,15.2,17,16.6,14.2,10.3,6.6,4.8],"type":"line"}]}}';

        $this->assertEquals($testJson, $json);
    }

    public function testJsonForFullData()
    {
        $myWidget = new HighchartsChart();
        $myWidget->setId('56797-7e3d4237-f798-433a-abe7-ac1857dfdf0f');

        $myWidget->setType('line');
        $myWidget->setTitle('Monthly Average Temperature');
        $myWidget->setSubtitle('Source: WorldClimate.com');
        $myWidget->setXAxisLabels(array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'));
        $myWidget->setXAxisTitle('Month');
        $series = array(
            'Tokyo' => array(7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6),
            'London' => array(3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8),
        );
        $myWidget->setSeries($series);

        $data = $myWidget->getData();
        $json = json_encode($data);

        $testJson = '{"highchart":{"chart":{"type":"line"},"title":{"text":"Monthly Average Temperature"},"subtitle":{"text":"Source: WorldClimate.com"},'.
            '"xAxis":{"categories":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"title":{"text":"Month"}},'.
            '"plotOptions":{"line":{"dataLabels":{"enabled":true},"enableMouseTracking":false}},'.
            '"series":[{"name":"Tokyo","data":[7,6.9,9.5,14.5,18.4,21.5,25.2,26.5,23.3,18.3,13.9,9.6],"type":"line"},{"name":"London","data":[3.9,4.2,5.7,8.5,'.
            '11.9,15.2,17,16.6,14.2,10.3,6.6,4.8],"type":"line"}]}}';

        $this->assertEquals($testJson, $json);
    }

    public function testJsonAddingData()
    {
        $myWidget = new HighchartsChart();
        $myWidget->setId('56797-7e3d4237-f798-433a-abe7-ac1857dfdf0f');

        $myWidget->setType('line');
        $myWidget->setTitle('Monthly Average Temperature');
        $myWidget->setSubtitle('Source: WorldClimate.com');
        $myWidget->setYAxisLabels(array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'));
        $myWidget->setYAxisTitle('Temperature (°C)');

        $series = array(
            'Tokyo' => array(7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6),
            'London' => array(3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8),
        );

        foreach ($series as $city => $values) {
            foreach ($values as $val) {
                $myWidget->addItemSerie($city, $val);
            }
        }

        $data = $myWidget->getData();
        $json = json_encode($data);

        $testJson = '{"highchart":{"chart":{"type":"line"},"title":{"text":"Monthly Average Temperature"},"subtitle":{"text":"Source: WorldClimate.com"},'.
            '"yAxis":{"categories":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],'.
            '"title":{"text":"Temperature (\u00b0C)"}},"plotOptions":{"line":{"dataLabels":{"enabled":true},"enableMouseTracking":false}},'.
            '"series":[{"name":"Tokyo","data":[7,6.9,9.5,14.5,18.4,21.5,25.2,26.5,23.3,18.3,13.9,9.6],"type":"line"},{"name":"London","data":[3.9,4.2,5.7,8.5,'.
            '11.9,15.2,17,16.6,14.2,10.3,6.6,4.8],"type":"line"}]}}';

        $this->assertEquals($testJson, $json);
    }
}
