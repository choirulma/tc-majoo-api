<?php

namespace App\Common;

use Illuminate\Database\Schema\Blueprint;

class CustomBlueprint extends Blueprint
{
    public function commonFields()
    {
        $this->timestamp('created_at')->nullable();
        $this->unsignedBigInteger('created_by')->nullable();
        $this->timestamp('updated_at')->nullable();
        $this->unsignedBigInteger('updated_by')->nullable();
    }
}
