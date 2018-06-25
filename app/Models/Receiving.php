<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'user_id',
        'comments',
    ];

    /**
     * The model rules.
     *
     * @var array
     */
    public static $rules = [
        'supplier_id' => 'required',
        'user_id' => 'required',
        'items' => 'min:1'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
        ];
    }

    public function getCodeAttribute()
    {
        return 'RCV-' . $this->id;
    }

    public function getTotalItemsAttribute()
    {
        return $this->items->count();
    }

    public function items()
    {
        return $this->hasMany(ReceivingItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withDefault([
            'name' => '-',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => '-',
        ]);
    }
}
