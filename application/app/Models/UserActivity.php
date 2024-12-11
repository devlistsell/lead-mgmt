<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class UserActivity extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     */

     protected $table = 'user_activity';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'url', 'ip','agent', 'user_id','login_at', 'logout_at',
    ];

    /**
     * relatioship business rules:
     *         - the UserACtivity belongs to one User
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
