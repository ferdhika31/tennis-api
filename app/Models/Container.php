<?php
/**
 * Container.php
 *
 * @package App\Models
 * @author  Ferdhika Yudira
 * @email   fer@dika.web.id
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;
use DB;

class Container extends Model
{
    use SearchableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'max_balls',
    ];

    protected $appends = [
        'remain_qty'
    ];

    /**
     * @param $request
     * @return mixed
     */
    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "max_balls" => "=",
        ]);

        return $data;
    }

    public function getRemainQtyAttribute(){
        $maxBalls = $this->max_balls;
        // sum ball in container
        $qtyBalls = ContainerBall::where('container_id', $this->id)->sum('qty');

        return !empty($this->ball_in_container) ? $maxBalls - $this->ball_in_container : $maxBalls - $qtyBalls;
    }

    /**
     * Get the user of the container.
     */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the balls for container.
     */
    public function balls()
    {
        return $this->hasMany('App\Models\ContainerBall');
    }

    public static function getFullContainer(){
        $model = new self();

        $sumBalls = "(SELECT SUM(qty) from container_balls where container_balls.container_id = containers.id)";

        $model = $model->select(DB::raw("name, max_balls, {$sumBalls} as ball_in_container"));

        $model = $model->whereRaw("{$sumBalls} >= containers.max_balls");

        return $model;
    }
}
