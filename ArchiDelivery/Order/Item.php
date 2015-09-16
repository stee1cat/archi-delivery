<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery\Order;

/**
 * Class Item
 * @package ArchiDelivery\Order
 */
class Item {

    /**
     * @var int
     */
    protected $menuId;

    /**
     * @var float
     */
    protected $quant = 1;

    /**
     * @var Item\Modificator[]
     */
    protected $modificators = array();

    /**
     * @return int
     */
    public function getId() {
        return $this->menuId;
    }

    /**
     * @param int $menuId
     * @return Item
     */
    public function setId($menuId) {
        $this->menuId = intval($menuId);
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity() {
        return $this->quant;
    }

    /**
     * @param float $quantity
     * @return Item
     */
    public function setQuantity($quantity) {
        $this->quant = $quantity;
        return $this;
    }

    public function addModificator(Item\Modificator $modificator) {
        $this->modificators[] = $modificator;
    }

    /**
     * @return Item\Modificator[]
     */
    public function getModificators() {
        return $this->modificators;
    }

    /**
     * @return array
     */
    public function toArray() {
        $result = array(
            'menuId' => $this->getId(),
            'quant' => $this->getQuantity()
        );
        $modificators = $this->getModificators();
        foreach ($modificators as $modificator) {
            $result['mods'][] = $modificator->toArray();
        }
        return $result;
    }

    /**
     * @return string
     */
    public function toString() {
        return $this->getId() . '#' . $this->getQuantity();
    }

    /**
     * @return string
     */
    public function toJson() {
        return json_encode($this->toArray());
    }

}