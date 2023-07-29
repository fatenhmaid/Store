<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Scopes\StoreScope;
class Product extends Model
{
    use HasFactory;
   
    protected static function booted(){
        static::addGlobalScope('store', new StoreScope());
        
    }
}
