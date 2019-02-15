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
        'name', 'slug', 'email', 'password', 'role_id', 'brand_id', 'department_id', 'picture', 'bg_image'
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

    public function acma() {
        return $this->hasMany('App\Brand', 'acma_id');
    }

    public function department() {
        return $this->belongsTo('App\Department');
    }

    public function created_conversation() {
        return $this->hasMany('App\Conversation', 'created_by');
    }

    public function created_jos() {
        return $this->hasMany('App\JobOrder', 'created_by');
    }

    public function signed_creativejos() {
        return $this->hasMany('App\JoCreative', 'signed_by');
    }

    public function proofed_webs() {
        return $this->hasMany('App\JoWeb', 'web_proofed_by');
    }

    public function proofed_acmas() {
        return $this->hasMany('App\JoWeb', 'acma_proofed_by');
    }

    public function boards() {
        return $this->hasMany('App\Board', 'created_by');
    }

    public function sprints() {
        return $this->hasMany('App\Sprint', 'created_by');
    }

    public function cards() {
        return $this->hasMany('App\Card', 'created_by');
    }

    public function tasks() {
        return $this->hasMany('App\Task', 'created_by');
    }

    public function task_assigned_by() {
        return $this->hasMany('App\Task', 'assigned_by');
    }

    public function task_assigned_to() {
        return $this->hasMany('App\Task', 'assigned_to');
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
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function userBoards() {
        return $this->belongsToMany('App\Board')->withPivot('added_by', 'bRole_id', 'isAdmin')->withTimestamps();
    }

    public function getPictureAttribute($pic) {
        return '/storage/'.$pic;
    }

    public function getBgImageAttribute($bg) {
        return '/storage/'.$bg;
    }
}
