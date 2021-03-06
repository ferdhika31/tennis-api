<?php
/**
 * ContainerBall.php
 *
 * @package App\Models
 * @author  Ferdhika Yudira
 * @email   fer@dika.web.id
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class ContainerBall extends Model
{
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qty',
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

    /**
     * Get the container of the ball.
     */
    public function container(){
        return $this->belongsTo('App\Models\Container');
    }
}
