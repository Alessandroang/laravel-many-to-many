<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'title', 'content', 'slug', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getTypeBadge()
    {
        return $this->type ? "<span class='badge' style='background-color: {$this->type->color}'>{$this->type->label}</span>" : "Nessuna tipologia";
    }



    public function getAbstract($chars = 50)
    {
        return strlen($this->content) > $chars ? substr($this->content, 0, $chars) . "..." : $this->content;
    }
}
