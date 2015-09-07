### Library for working with API ArchiDelivery

[ArchiDelivery](http://www.archidelivery.ru/ "this is shit")

```
use ArchiDelivery\Autoloader;
use ArchiDelivery\Delivery;
use ArchiDelivery\Order;
use ArchiDelivery\Order\Item;
use ArchiDelivery\Order\Item\Modificator;

require_once 'ArchiDelivery/Autoloader.php';

Autoloader::init();

$delivery = new Delivery();
$delivery->setIp('192.168.0.1');

$order = new Order();
$order->setDelivery($delivery)
    ->setOrderFormatType(Order::ORDER_JSON)
    ->setClient('Проверкин Тест Тестович')
    ->setPhone('+79555555555')
    ->setStreet('street')
    ->setHome('11')
    ->setFrontDoor(1)
    ->setLevel(1)
    ->setDoorPhone(true)
    ->setPayment(false);

$item = new Item();
$item->setId(1234)
    ->setQuantity(1);

$modificator = new Modificator();
$modificator->setId(12)
    ->setReference(123)
    ->setQuantity(1)
    ->setKind(Modificator::KIND_NOMENCLATURE)
    ->setType(Modificator::TYPE_ADD);

$item->addModificator($modificator);

$result = $order->addItem($item)
    ->send();
```

#### Find customers using a telephone number:
```
use ArchiDelivery\Autoloader;
use ArchiDelivery\Delivery;
use ArchiDelivery\Client;

require_once 'ArchiDelivery/Autoloader.php';

Autoloader::init();

$delivery = new Delivery();
$delivery->setIp('192.168.0.1');

$client = new Client();
$client->setDelivery($delivery);
$clients = $client->findByPhone('79555555555');
foreach ($clients as $record) {
    echo $record->getFullName(), '<br>';
}
```