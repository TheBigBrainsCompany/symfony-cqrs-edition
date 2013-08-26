<?php

namespace Acme\Task\Query\ViewModel;

use Doctrine\Common\Collections\ArrayCollection;

class ViewModelCollection extends ArrayCollection
{
    public $offset;
    public $limit;
    public $totalCount;

    public function __construct(array $elements = array(), $offset, $limit, $totalCount)
    {
        $this->offset = (int) $offset;
        $this->limit = (int) $limit;
        $this->totalCount = (int) $totalCount;

        parent::__construct($elements);
    }
}
