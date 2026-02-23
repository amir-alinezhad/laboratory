<?php
namespace App\Http\Enums;

enum StatusEnums : string
{
    case CONFIRMED = "تایید شده";
    case FAILED = "رد شده";
    case PENDING = "در انتظار تایید";
    case ACTIVE = "فعال";
    case DE_ACTIVE = "غیر فعال";
}
