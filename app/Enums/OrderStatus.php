<?php

namespace App\Enums;

enum OrderStatus
{
    // order status table status
    const PAYMENT_PENDING = 0;
    const PAYMENT_COMPLETED = 1;

    const PROCESSING_PENDING = 0;
    const PROCESSING_COMPLETED = 1;
    
    const PICKED_PENDING = 0;
    const PICKED_COMPLETED = 1;
    
    const SHIPPED_PENDING = 0;
    const SHIPPED_COMPLETED = 1;
    
    const DELIVERED_PENDING = 0;
    const DELIVERED_COMPLETED = 1;
    
    const CONFIRM_PENDING = 0;
    const CONFIRM_COMPLETED = 1;

    // order master table status
    const PLACED = 'Placed';
    const PROCESSING = 'Processing';
    const PICKED = 'Picked';
    const SHIPPED = 'Shipped';
    const DELIVERED = 'Delivered';
    const CONFIRMED = 'Confirmed';
    const CANCEL = 'Cancel';
}
