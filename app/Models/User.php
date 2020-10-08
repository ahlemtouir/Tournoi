<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns user status in json format
     * @param $data
     * $return json
     */
    public static function handleUserData($data) {
        $response = [];
        try {
            $email = $data['email'];
            $user = User::where("email", "=", $email)->first();
            $name = trim($data['name']);
            $name = preg_replace('/\s+/', '', $name);
            $name = str_replace("+", "", $name);
            $name = str_replace("(", "", $name);
            $name = str_replace(")", "", $name);
            $name = str_replace(".", "", $name);
            
            if (!isset($user)) {
                $token = hash('sha256', Str::random(10), false);
                $user = Sentinel::register(array(
                            'email' => $email,
                            'password' => $data['password'],
                            'name' => $data['name'],
                            'api_token' => $token,
                ));
                if (isset($user)) {

                    $group = Sentinel::findRoleByName("CLIENT");
                    $group->users()->attach($user);
                    $user->save();
                    $response = [
                        "status" => 200,
                        "data" => $user
                    ];
                } else {
                    $response = [
                        "status" => 400,
                        "error" => "FAILED"
                    ];
                }
            } else {
                $response = [
                    "status" => 400,
                    "error" => "AlreadyExists"
                ];
            }
        } catch (Exception $e) {
            $response = [
                "status" => 400,
                "error" => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
        return $response;
    }
}
