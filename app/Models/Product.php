<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;
    use HasFactory;
    public $table = 'products';
    protected $translatable = ['name'];
    // protected $fillable = ['name', 'image', 'category_id', 'purchase_price', 'sale_price', 'stock'];
    protected $appends = ['image_path', 'profit_precent'];

    protected $guarded = [];

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    } //end of get image




    public function getProfitPrecentAttribute()
    {

        $profit = $this->sale_price - $this->purchase_price;

        $profit_precent = $profit * 100 / $this->purchase_price;

        return number_format($profit_precent, 2);
    } //end of get profit precent



    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }



    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order', 'product_id', 'order_id');
    }
}
