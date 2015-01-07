<?php
namespace CarlosIO\Geckoboard;

use CarlosIO\Geckoboard\Exceptions\InvalidDataException;
use CarlosIO\Geckoboard\Widgets\Funnel;
use CarlosIO\Geckoboard\Widgets\Text;
use CarlosIO\Geckoboard\Widgets\GeckoMeter;
use CarlosIO\Geckoboard\Widgets\HighchartsChart;
use CarlosIO\Geckoboard\Widgets\RagColumnAndNumbers;
use CarlosIO\Geckoboard\Widgets\Bullet;
use CarlosIO\Geckoboard\Widgets\LineChart;
use CarlosIO\Geckoboard\Widgets\Map;
use CarlosIO\Geckoboard\Widgets\PieChart;
use CarlosIO\Geckoboard\Widgets\ItemList;
use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;

class Factory
{
    /**
     * @desc    Default Gecko Url
     * @var     string
     */
    const DEFAULT_GECKO_URL = 'https://push.geckoboard.com/v1/send';

    /**
     * @desc    identifier for BulletGraph widget
     * @var        integer
     */
    const WIDGET_BULLET    = 0;

    /**
     * @desc    identifier for funnel widget
     * @var        integer
     */
    const WIDGET_FUNNEL    = 1;

    /**
     * @desc    identifier for geckometer widget
     * @var        integer
     */
    const WIDGET_GECKOMETER    = 2;

    /**
     * @desc    identifier for highCharts widget
     * @var        integer
     */
    const WIDGET_HIGHCHARTS    = 3;

    /**
     * @desc    identifier for leaderBoard widget
     * @var        integer
     */
    const WIDGET_LEADERBOARD    = 4;

    /**
     * @desc    identifier for LineChart widget
     * @var        integer
     */
    const WIDGET_LINE_CHART    = 5;

    /**
     * @desc    identifier for List widget
     * @var        integer
     */
    const WIDGET_LIST    = 6;

    /**
     * @desc    identifier for Map widget
     * @var        integer
     */
    const WIDGET_MAP    = 7;

    /**
     * @desc    identifier for monitoring widget
     * @var        integer
     */
    const WIDGET_MONITORING    = 8;

    /**
     * @desc    identifier for Number And Secondary Stats widget
     * @var        integer
     */
    const WIDGET_NUMBER_AND_SECONDARY_STATS    = 9;

    /**
     * @desc    identifier for Pie Chart widget
     * @var        integer
     */
    const WIDGET_PIE_CHART    = 10;

    /**
     * @desc    identifier for RAG widget
     * @var        integer
     */
    const WIDGET_RAG    = 11;

    /**
     * @desc    identifier for text widget
     * @var        integer
     */
    const WIDGET_TEXT    = 12;

    /**
     * @desc    create a gecko Client object
     * @param    string $sAPIKey : Gecko API key attached to account
     * @return    \CarlosIO\Geckoboard\Client
     */
    public static function createGeckoClient($sAPIKey)
    {
        $oGeckoClient = new Client(self::DEFAULT_GECKO_URL, $sAPIKey);
        $oGeckoClient->setHTTPClient(new \Guzzle\Http\Client());
        $oGeckoClient->setRequestTimeout(Client::DEFAULT_REQUEST_TIMEOUT);

        return $oGeckoClient;
    }

    /**
     * @desc    create a widget from it's TypeId and widget id attached to dashboard
     * @param    integer $iWidgetTypeId
     * @param    string $sWidgetId
     * @throws    InvalidDataException
     * @return    \CarlosIO\Geckoboard\Widgets\Widget
     */
    public static function createGeckoWidget($iWidgetTypeId, $sWidgetId)
    {
        if (false === is_integer($iWidgetTypeId)) {
            throw new InvalidDataException('Invalid widget type id');
        }

        switch($iWidgetTypeId) {
            case self::WIDGET_BULLET:
                $oWidget    = self::createBulletWidget($sWidgetId);
                break;
            case self::WIDGET_FUNNEL:
                $oWidget    = self::createFunnelWidget($sWidgetId);
                break;
            case self::WIDGET_GECKOMETER:
                $oWidget    = self::createGeckOMeterWidget($sWidgetId);
                break;
            case self::WIDGET_HIGHCHARTS:
                $oWidget    = self::createHighChartsWidget($sWidgetId);
                break;
            case self::WIDGET_LEADERBOARD:
                throw new InvalidDataException('Non implemented widget type');
            case self::WIDGET_LINE_CHART:
                $oWidget    = self::createLineChartWidget($sWidgetId);
                break;
            case self::WIDGET_LIST:
                $oWidget    = self::createItemListWidget($sWidgetId);
                break;
            case self::WIDGET_MAP:
                $oWidget    = self::createMapWidget($sWidgetId);
                break;
            case self::WIDGET_MONITORING:
                throw new InvalidDataException('Non implemented widget type');
            case self::WIDGET_NUMBER_AND_SECONDARY_STATS:
                $oWidget    = self::createNumberAndSecondaryStatWidget($sWidgetId);
                break;
            case self::WIDGET_PIE_CHART:
                $oWidget    = self::createPieChartWidget($sWidgetId);
                break;
            case self::WIDGET_RAG:
                $oWidget    = self::createRAGWidget($sWidgetId);
                break;
            case self::WIDGET_TEXT:
                $oWidget    = self::createTextWidget($sWidgetId);
                break;
            default:
                throw new InvalidDataException('Invalid widget type id');
        }

        return $oWidget;
    }

    /**
     * @desc    create an instance of Funnel Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\Funnel
     */
    public static function createFunnelWidget($sWidgetId)
    {
        $oWidget = new Funnel();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of Bullet Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\Bullet
     */
    public static function createBulletWidget($sWidgetId)
    {
        $oWidget = new Bullet();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of Map Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\Map
     */
    public static function createMapWidget($sWidgetId)
    {
        $oWidget = new Map();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of LineChart Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\LineChart
     */
    public static function createLineChartWidget($sWidgetId)
    {
        $oWidget = new LineChart();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of PieChart Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\PieChart
     */
    public static function createPieChartWidget($sWidgetId)
    {
        $oWidget = new PieChart();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of GeckOMeter Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\GeckoMeter
     */
    public static function createGeckOMeterWidget($sWidgetId)
    {
        $oWidget = new GeckoMeter();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of HighCharts Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\HighchartsChart
     */
    public static function createHighChartsWidget($sWidgetId)
    {
        $oWidget = new HighchartsChart();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of RAG Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\RagColumnAndNumbers
     */
    public static function createRAGWidget($sWidgetId)
    {
        $oWidget = new RagColumnAndNumbers();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of Text Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\Text
     */
    public static function createTextWidget($sWidgetId)
    {
        $oWidget = new Text();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of Item List Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\ItemList
     */
    public static function createItemListWidget($sWidgetId)
    {
        $oWidget = new ItemList();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }

    /**
     * @desc    create an instance of Number And Secondary Stat Widget
     * @param    string $sWidgetId
     * @return    \CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat
     */
    public function createNumberAndSecondaryStatWidget($sWidgetId)
    {
        $oWidget = new NumberAndSecondaryStat();
        $oWidget->setId($sWidgetId);

        return $oWidget;
    }
}
