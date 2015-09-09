### Library for working with API ArchiDelivery

[ArchiDelivery](http://www.archidelivery.ru/ "this is shit")

```
use ArchiDelivery\Autoloader;
use ArchiDelivery\Delivery;
use ArchiDelivery\Client;
use ArchiDelivery\Client\Address;
use ArchiDelivery\Order;
use ArchiDelivery\Order\Item;
use ArchiDelivery\Order\Item\Modificator;

require_once 'ArchiDelivery/Autoloader.php';

Autoloader::init();

$delivery = new Delivery();
$delivery->setIp('192.168.0.1');

$client = new Client($delivery, array(
  'fullName' => 'Проверкин Тест Тестович',
  'phone' => '+79555555555',
));

$address = new Address();
$address->setStreet('Street')
    ->setHome('Home')
    ->setFrontDoor(1)
    ->setLevel(5)
    ->setRoom(20);

$order = $delivery->createOrder();
$order->setClient($client)
    ->setAddress($address)
    ->setOrderType(1)
    ->setPaymentType(1)
    ->setComment('comment')
    ->setFlatwareCount(2)
    ->setChangeFrom(1000);

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

$client = new Client($delivery);
$clients = $client->findByPhone('79555555555');
foreach ($clients as $record) {
    echo $record->getFullName(), '<br>';
}
```