<?php

namespace Nuxtifyts\NuxtifyPages\Models;

use Illuminate\Database\Eloquent\Model;
use Nuxtifyts\NuxtifyPages\Concerns\Model\HasTablePrefix;

abstract class NuxtifyModel extends Model
{
    use HasTablePrefix;
}
