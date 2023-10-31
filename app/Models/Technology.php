<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }


    public function getTechnologyBadge()
    {
        return $this->label ? "<span class='badge' style='background-color: {$this->color}'>{$this->label}</span>" : "Nessuna tecnologia utilizzata";
    }
}
