<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Player
 *
 * @package App
 * @property string $team
 * @property string $name
 * @property string $surname
 * @property string $birth_date
*/
class Player extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'birth_date', 'team_id'];
}
