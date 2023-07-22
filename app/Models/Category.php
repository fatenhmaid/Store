<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Rules\filter;




class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','parent_id','description','image','status','slug'
    ];
    protected $guarded = [
      'id'
    ];
    //Rule::unique('categories','name')->ignore($id)
  public static function rules($id=0) {
 
   return[
      'name'=>[     
        'required','string','min:3','max:255',"unique:categories,name,$id", 
          'filter:laravel,php,html',
        
        //new Filter(['laravel','php','html']),
        /*function($attribute,$value,$fails){
         if(strtolower($value)=='laravel'){
          $fails('This name is forbidden!');
         }
        },*/
       
      ],
      'parent_id'=>[
      'nullable','int','exists:categories,id',
      ],
      'image'=>[
        'image','max:1048576','dimensions:min_width=100,min_height=100'
      ],
      'status'=>[
        'required','in:active,archived',
      ]
      
    ];
    // protected $guarded=[];
}
}
