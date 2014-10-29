<?php

namespace Symfony\Bundle\MinimalBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MinimalBundle extends Bundle
{
    public function getParent()
    {
        return 'FrameworkBundle';
    }
}
