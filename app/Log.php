<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\Relations\BelongsTo;
class Log extends Model
{
    protected $fillable = ['user_id', 'input', 'result','log_name'];

    /**
     * saveLogData function populates the Logs database with parameters(results) provided.
     * @param $input
     * @param $result
     * @param $logName
     * @return mixed
     */
    public static function saveLogData(string $input, string $result, string $logName)
    {
        return self::create([
            'user_id' => Auth::id(),
            'input' => $input,
            'result' => $result,
            'log_name' => $logName,
        ]);

    }

    /**
     * Belongs to relationship between logs and user .
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
