```
require __DIR__ . '/vendor/autoload.php';

use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;
use CarlosIO\Geckoboard\Client;

$myWidget = new NumberAndSecondaryStat();
$myWidget->setId('29473-7de96f52-0202-4bed-b2fc-cd84e9c2efd9');
$myWidget->setMainValue(100);
$myWidget->setSecondaryValue(50);
$myWidget->setMainPrefix('EUR');

$geckoboardClient = new Client();
$geckoboardClient->setApiKey('f8c0c9b4de0592dc403aa6b11a219348');
$geckoboardClient->push($myWidget);
```