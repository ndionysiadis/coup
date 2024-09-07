<?php

namespace App\Data;

use App\Data\HandleInertiaRequest\AppUrlsData;
use App\Data\HandleInertiaRequest\FlashData;
use Spatie\LaravelData\Data;

class HandleInertiaRequestData extends Data
{
    public function __construct(
        public object      $errors,
        public FlashData   $flashData,
        public mixed       $oneResponse,
        public ToastData   $toast,
        public array       $shared,
        public AppUrlsData $appUrls,
    )
    {
    }
}
