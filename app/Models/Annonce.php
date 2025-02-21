<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;



class Annonce extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['titre', 'description', 'prix', 'image', 'user_id', 'categorie_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Category::class);
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
