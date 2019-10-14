<?php

class Windmill
{

    const DIRECTION_LEFT = 1;

    const DIRECTION_DOWN = 2;

    const DIRECTION_RIGHT = 3;

    const DIRECTION_UP = 4;

    private $windmill = [];

    private $direction;

    private $boundary;

    private $lastPoint;

    private $total;

    private $n;

    /**
     * Windmill constructor.
     *
     * @param int $num
     * @throws Exception
     */
    public function __construct(int $num)
    {
        if ($num < 0) throw new Exception('Invalid argument.');

        $this->boundary = $num - 1;

        $this->n = $num;

        $this->total = $num * $num;

        $this->addValue($this->getEnd());

        $this->initDirection();
    }

    /**
     * 获取风车
     *
     * @return array
     */
    public function getWindmill()
    {
        while ($this->total > 0) {

            $this->turn();

            $loc = $this->getNextLoc();

            $this->addValue($loc);
        }

        $this->sortWindmill();

        return $this->windmill;
    }

    /**
     * 对风车进行排序
     */
    private function sortWindmill()
    {
        array_walk($this->windmill, 'ksort');

        ksort($this->windmill);
    }

    /**
     * 初始化方向
     */
    private function initDirection()
    {
        $direction = ($this->n % 2)
            ? self::DIRECTION_LEFT
            : self::DIRECTION_RIGHT;

        $this->setDirection($direction);
    }

    /**
     * 向风车中增加新的值
     *
     * @param array $loc
     */
    private function addValue(array $loc)
    {
        $x = $loc[0];

        $y = $loc[1];

        $this->lastPoint = $loc;

        $this->windmill[$y][$x] = $this->getTotal();

        $this->decreaseTotal();
    }

    /**
     * 获取终点坐标
     *
     * @return array
     */
    private function getEnd():array
    {
        $n = $this->n;

        $loc = $n - 1;

        if ($n % 2) {
            $end = [$loc, 0];
        } else {
            $end = [0, $loc];
        }

        return $end;
    }

    /**
     * 设置方向
     *
     * @param int $direction
     */
    private function setDirection(int $direction)
    {
        $this->direction = $direction;
    }

    /**
     * 获取方向
     *
     * @return int
     */
    private function getDirection():int
    {
        return $this->direction;
    }

    /**
     * 是否需要转向
     *
     * @return bool
     */
    private function isNeedToTurn(): bool
    {
        $nextLoc = $this->getNextLoc();

        if (
            $nextLoc[0] > $this->boundary
            || $nextLoc[1] > $this->boundary
            || $nextLoc[0] < 0
            || $nextLoc[1] < 0
        ) return true;

        //下一个坐标点是否已存在
        if ($this->hasLacExist($nextLoc)) return true;

        return false;
    }

    /**
     * @param array $loc
     * @return bool
     */
    private function hasLacExist(array $loc): bool
    {
        $x = $loc[0];

        $y = $loc[1];

        return (!empty($this->windmill[$y][$x]));
    }

    /**
     * 获取下一个坐标点的坐标
     *
     * @return array
     */
    private function getNextLoc(): array
    {
        $last = $this->lastPoint;

        switch ($this->getDirection()) {
            case self::DIRECTION_LEFT:
                $last[0] = $last[0] - 1;
                break;
            case self::DIRECTION_DOWN:
                $last[1] = $last[1] + 1;
                break;
            case self::DIRECTION_RIGHT:
                $last[0] = $last[0] + 1;
                break;
            case self::DIRECTION_UP:
                $last[1] = $last[1] - 1;
                break;
        }

        return $last;
    }

    /**
     * 转向
     */
    private function turn()
    {
        if (!$this->isNeedToTurn()) return;

        if ($this->getDirection() + 1 > self::DIRECTION_UP) {
            $direction = self::DIRECTION_LEFT;
        } else {
            $direction = $this->getDirection() + 1;
        }

        $this->setDirection($direction);
    }

    /**
     * @return int
     */
    private function getTotal():int
    {
        return $this->total;
    }

    /**
     * 减少total
     */
    private function decreaseTotal()
    {
        $this->total--;
    }
}

$windmill = new Windmill(1000);

var_dump($windmill->getWindmill());