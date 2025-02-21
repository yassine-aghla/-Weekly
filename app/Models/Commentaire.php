<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    
    protected $fillable = [
        'contenu',   
        'user_id',   
        'annonce_id' 
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
