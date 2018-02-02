<?php

namespace Olla\Flow\Logic;


abstract class Repository
{
    protected $class;

    public function supports($resourceClass) {
        if($this->class === $resourceClass) {
            return true;
        }
    }
}