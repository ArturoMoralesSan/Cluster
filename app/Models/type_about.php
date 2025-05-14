<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_about extends Model
{
    use HasFactory;

     /**
     * Get the links that belong to the submenu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function about()
    {
        return $this->hasMany(About::class, 'type_about_id');
    }
}
