<?php

namespace app\Helper;

use App\Models\SeoMeta;

class SeoHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function get($pageType, $referenceId = null)
    {
        return SeoMeta::where('page_type', $pageType)
            ->where('reference_id', $referenceId)
            ->first();
    }
}
