<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @package App
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property float $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return Order
     */
    public function setQuantity(int $quantity): Order
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     * @return Order
     */
    public function setTotal(float $total): Order
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->created_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->updated_at;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return Order
     */
    public function setProduct(Product $product): Order
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Order
     */
    public function setUser(User $user): Order
    {
        $this->user = $user;
        return $this;
    }
}
