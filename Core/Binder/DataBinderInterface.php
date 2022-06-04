<?php

namespace Core\Binder;

interface DataBinderInterface
{
    public function bind($formData,$className);
}