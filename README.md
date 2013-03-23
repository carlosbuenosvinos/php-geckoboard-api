```
require __DIR__ . '/vendor/autoload.php';

use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;
use CarlosIO\Geckoboard\Client;

$myWidget = new NumberAndSecondaryStat();
$myWidget->setId('<your widget id>');
$myWidget->setMainValue(100);
$myWidget->setSecondaryValue(50);
$myWidget->setMainPrefix('EUR');

$geckoboardClient = new Client();
$geckoboardClient->setApiKey('<your token>');
$geckoboardClient->push($myWidget);
``