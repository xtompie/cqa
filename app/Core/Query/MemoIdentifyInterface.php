<?php

namespace App\Core\Query;

interface MemoIdentifyInterface
{
    public function memoIdentify(object $query): string;
}
