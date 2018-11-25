<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, Sluggable, Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password', 'role_id', 'brand_id', 'department_id', 'picture'
    ];

    /**
     * Attribute for soft delete
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // created_at accessor
    public function getCreatedAtAttribute($date){
        return $date ? date('m/d/Y', strtotime($date)) : null;
    } //end of create_at accessor

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function sticky_notes() {
        return $this->hasMany('App\StickyNote');
    }

    public function brand() {
        $this->hasOne('App\Brand');
    }

    public function ga_tandem() {
        return $this->hasOne('App\Tandem', 'ga_id');
    }

    public function acma_tandem() {
        return $this->hasOne('App\Tandem', 'acma_id');
    }

    public function department() {
        return $this->belongsTo('App\Department');
    }

    public function created_conversation() {
        return $this->hasMany('App\Conversation', 'created_by');
    }

    public function conversations() {
        return $this->belongsToMany('App\Conversation')->withPivot('added_by')->withTimestamps();
    }

    public function sender(){
        return $this->hasMany('App\Message', 'sender_id');
    }

    public function receiver(){
        return $this->hasMany('App\Message', 'receiver_id');
    }

    public function getPictureAttribute($pic) {
        return '/images/'.$pic;
    }
}
