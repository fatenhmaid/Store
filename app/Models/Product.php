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
        static::creating(function(Product $product){
            $product->Slug =Str::slug($product->name);
           });
        
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

     public function scopeFilter(Builder $builder, $filters)
     {
         $options = array_merge([
             'store_id' => null,
             'category_id' => null,
             'tag_id' => null,
             'status' => 'active',
         ], $filters);
 
         $builder->when($options['status'], function ($query, $status) {
             return $query->where('status', $status);
         });
 
         $builder->when($options['store_id'], function($builder, $value) {
             $builder->where('store_id', $value);
         });
         $builder->when($options['category_id'], function($builder, $value) {
             $builder->where('category_id', $value);
         });
         $builder->when($options['tag_id'], function($builder, $value) {
 
             $builder->whereExists(function($query) use ($value) {
                 $query->select(1)
                     ->from('product_tag')
                     ->whereRaw('product_id = products.id')
                     ->where('tag_id', $value);
             });
     });
    }
}
