<?php

namespace App\Enums;

enum Status
{
    const ACTIVE = 1;
    const INACTIVE = 0;

    // product stock status
    const STOCK_AVAILABLE = 1;
    const STOCK_OUT = 2;
    const UPCOMING = 3;
}
