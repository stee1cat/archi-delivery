<?php

namespace ArchiDelivery;

use Codeception\Specify;
use Codeception\TestCase\Test;
use Codeception\Util\Stub;

class ClientTest extends Test
{

    use Specify;

    public function testSetId()
    {
        $client = self::create();
        $client->setId(1);
        expect('ID type of integer', is_int($client->getId()))->true();
        $client->setId('string');
        expect('Set string to ID', $client->getId())->equals(0);
    }

    public function testGetType()
    {
        $client = self::create();
        expect('Type equals ' . Client::TYPE_NAME, $client->getType())->equals(Client::TYPE_NAME);
        $client->setId(1);
        expect('Type equals ' . Client::TYPE_ID, $client->getType())->equals(Client::TYPE_ID);
    }

    public function testToArray()
    {
        $this->specify('Client type equals ' . Client::TYPE_NAME, function () {
            $client = self::create();
            $client->setFullName('Ivan Ivanov')
                ->setPhone('8 (955) 555-5555')
                ->setMail('ivan@example.com');
            $array = $client->toArray();
            expect($array)->hasKey('client');
            expect('Name equals', $array['client'])->equals('Ivan Ivanov');
            expect($array)->hasKey('mail');
            expect('Mail equals', $array['mail'])->equals('ivan@example.com');
            expect($array)->hasKey('phone');
            expect('Phone equals', $array['phone'])->equals('7 (955) 555-55-55');
            expect($array)->hasntKey('type');
            expect($array)->hasntKey('clientid');
        });
        $this->specify('Client type equals ' . Client::TYPE_ID, function () {
            $client = self::create();
            $client->setId(13)
                ->setPhone('8 (955) 555-5555')
                ->setMail('ivan@example.com');
            $array = $client->toArray();
            expect($array)->hasKey('clientid');
            expect('ID equals', $array['clientid'])->equals(13);
            expect($array)->hasKey('mail');
            expect('Mail equals', $array['mail'])->equals('ivan@example.com');
            expect($array)->hasKey('phone');
            expect('Phone equals', $array['phone'])->equals('7 (955) 555-55-55');
            expect($array)->hasKey('type');
            expect('Type equals', $array['type'])->equals(Client::TYPE_ID);
            expect($array)->hasntKey('client');
        });
    }

    /**
     * @return Client
     */
    private static function create()
    {
        /** @var Delivery $delivery */
        $delivery = Stub::make('ArchiDelivery\Delivery');
        $client = new Client($delivery);
        return $client;
    }

}