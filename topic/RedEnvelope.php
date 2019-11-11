<?php

class RedEnvelope
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var int
     */
    private $num;

    /**
     * RedEnvelope constructor.
     * @param float $amount
     * @param int $num
     */
    public function __construct(float $amount, int $num)
    {
        $this->amount = $amount;
        $this->num = $num;
    }

    /**
     * 获取红包数量
     *
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * 获取总红包金额
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * 拆分红包
     *
     * @return array
     */
    public function divide(): array
    {
        $restAmount = $this->getAmount();
        $nums = $this->getNum();
        $list = $this->generateRandomNumbers();
        $res = [];

        for ($i = $nums; $i > 0; $i--) {
            $item = (float)array_shift($list);
            $res[] = bcsub($restAmount, $item, 2);
            $restAmount = $item;
        }

        return $res;
    }

    /**
     * 生成随机数
     *
     * @return array
     */
    private function generateRandomNumbers(): array
    {
        $amount = $this->getAmount() * 100;
        $num = $this->getNum();
        $max = $amount - 1;
        $min = 1;
        $list = [];

        while (count($list) < $num - 1) {
            $list[] = bcdiv(rand($min, $max), 100, 2);
            $list = array_unique($list);
        }
        rsort($list);
        return $list;
    }
}

$resEnvelope = new RedEnvelope(1, 10);

$res = $resEnvelope->divide();

var_dump(array_sum($res), $res);
