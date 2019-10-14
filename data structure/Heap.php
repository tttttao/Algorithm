<?php

class Heap
{
    private $heap = [];

    public function add(int $val)
    {
        $index = $this->getNextIndex();

        $this->heap[$index] = $val;

        $this->adjustParentNode($index);
    }

    private function adjustParentNode(int $index)
    {
        $parentNodeIndex = ceil($index / 2) - 1;


        if ($parentNodeIndex >= 0
            && $this->heap[$parentNodeIndex] > $this->heap[$index]) {

            list($this->heap[$parentNodeIndex], $this->heap[$index]) =
                [$this->heap[$index], $this->heap[$parentNodeIndex]];

            $this->adjustParentNode($parentNodeIndex);
        }
    }

    public function remove()
    {
        if (count($this->heap) == 0) {
            return null;
        }

        $indexOfEnd = $this->getNextIndex() - 1;


        list($this->heap[$indexOfEnd], $this->heap[0]) =
            [$this->heap[0], $this->heap[$indexOfEnd]];

        $res = array_pop($this->heap);

        $this->adjustChildNode(0);

        return $res;
    }

    public function __toString()
    {
        return implode($this->heap, ',');
    }

    private function getNextIndex(): int
    {
        return count($this->heap);
    }

    private function adjustChildNode(int $index)
    {
        $left = $index * 2 + 1;

        $right = ($index + 1) * 2;

        if ($left == count($this->heap)) {

            return;

        } else if ($left == count($this->heap) - 1) {

            if ($this->heap[$index] > $this->heap[$left]) {
                list ($this->heap[$index], $this->heap[$left]) =
                    [$this->heap[$left], $this->heap[$index]];
            }

        } else {

            if ($this->heap[$left] > $this->heap[$right]) {
                $indexToSwap = $right;
            } else {
                $indexToSwap = $left;
            }

            if ($this->heap[$indexToSwap] < $this->heap[$index]) {

                list ($this->heap[$index], $this->heap[$indexToSwap]) =
                    [$this->heap[$indexToSwap], $this->heap[$index]];

                $this->adjustChildNode($indexToSwap);
            }
        }
    }
}
