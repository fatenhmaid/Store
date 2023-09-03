<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','description','image','category_id','store_id',
        'price','compare_price','status',
    ];
    protected static function booted(){
        static::addGlobalScope('store', new StoreScope());
        
    }
    public function category(){
       return $this->belongsTo(Category::class,'category_id','id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
     }
     public function tags(){
        return $this->belongsToMany(
            Tag::class,//related model
            'product_tag',//pivot table name
            'product_id',//fk in pivot table for the current model
            'tag_id',//fk in pivot table for the related model
            'id',//pk current model
            'id'//pk related model
        );
     }
     public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
     }
     public function getImageUrlAttribute(){
        if(!$this->image){
            return 'https://www.ehabra.com/storage/images/documents/_res/wrh/def_product.png';
        }
        if(str::startsWith($this->image,['http://','https://'])){
            return $this->image;
        }

        return asset('storage/' . $this->image);    
     }

     public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }
        return number_format( 100-(100 * $this->price / $this->compare_price),1);
     }
}
