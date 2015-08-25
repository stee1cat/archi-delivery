<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery\Order\Item;

class Modificator {

    /**
     * Ссылка на номенклатуру
     */
    const KIND_NOMENCLATURE = 0;

    /**
     * Ссылка на меню
     */
    const KIND_MENU = 1;

    /**
     * Исключение из существующей калькуляции блюда
     */
    const TYPE_DELETE = 0;

    /**
     * Добавление модификатора
     */
    const TYPE_ADD = 1;

    /**
     * Ссылка на модификатор (заполняется только при kind = 1)
     *
     * @var int
     */
    protected $modificatorId;

    /**
     * На что ссылается ссылка (ref)
     *
     * @var int
     */
    protected $kind;

    /**
     * Тип модификатора
     *
     * @var int
     */
    protected $kind1;

    /**
     * Ссылка (определяется полем kind)
     *
     * @var int
     */
    protected $ref;

    /**
     * Количество
     *
     * @var float
     */
    protected $quant;

    protected $params = array(
        'modificatorId',
        'kind',
        'kind1',
        'ref',
        'quant',
    );

    /**
     * @return int
     */
    public function getId() {
        return $this->modificatorId;
    }

    /**
     * @param int $id
     * @return Modificator
     */
    public function setId($id) {
        $this->modificatorId = intval($id);
        return $this;
    }

    /**
     * @return int
     */
    public function getKind() {
        return $this->kind;
    }

    /**
     * @param int $kind
     * @return Modificator
     */
    public function setKind($kind) {
        $this->kind = intval($kind);
        return $this;
    }

    /**
     * @return int
     */
    public function getType() {
        return $this->kind1;
    }

    /**
     * @param int $type
     * @return Modificator
     */
    public function setType($type) {
        $this->kind1 = intval($type);
        return $this;
    }

    /**
     * @return int
     */
    public function getReference() {
        return $this->ref;
    }

    /**
     * @param int $reference
     * @return Modificator
     */
    public function setReference($reference) {
        $this->ref = intval($reference);
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
     * @return Modificator
     */
    public function setQuantity($quantity) {
        $this->quant = $quantity;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray() {
        $result = array();
        foreach ($this->params as $paramName) {
            $result[$paramName] = $this->{$paramName};
        }
        return $result;
    }

}