<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Match
 *
 * @package App
 * @property string $team1
 * @property string $team2
 * @property string $start_time
 * @property integer $result1
 * @property integer $result2
*/
class Match extends Model
{
    use HasFactory;

    protected $fillable = ['start_time', 'result1', 'result2', 'team1_id', 'team2_id'];
}
