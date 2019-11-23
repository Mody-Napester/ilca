<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'num_of_words', 'num_of_papers',
        'lang_from', 'lang_to', 'task_name',
        'task_type', 'rate', 'project_manger_id',
        'deadline', 'activity_status_id',
        'comments','created_by', 'updated_by'];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) \Webpatser\Uuid\Uuid::generate(config('vars.uuid_ver'));
        });
    }

    /**
     *  Create new resource
     */
    public static function store($inputs)
    {
        return self::create($inputs);
    }

    /**
     *  Update existing resource
     */
    public static function edit($inputs, $resource)
    {
        return self::where('id', $resource)->update($inputs);
    }

    /**
     *  Delete existing resource
     */
    public static function remove($resource)
    {
        return self::where('id', $resource)->delete();
    }

    /**
     *  Get a specific resource
     */
    public static function getBy($by, $resource)
    {
        return self::where($by, $resource)->first();
    }

    /**
     *  Relationship with users
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');

    }

    /**
     *  Relationship with users
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');

    }

    /**
     *  Relationship with users
     */
    public function projectManager()
    {
        return $this->belongsTo('App\User', 'project_manger_id');

    }

    /**
     *  Relationship with client
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     *  Relationship with Language
     */
    public function langFrom()
    {
        return $this->belongsTo('App\Language', 'lang_from');
    }

    /**
     *  Relationship with Language
     */
    public function langTo()
    {
        return $this->belongsTo('App\Language', 'lang_to');
    }

    /**
     *  Relationship with Activity Status
     */
    public function activityStatus()
    {
        return $this->belongsTo('App\ActivityStatus');
    }

    /**
     *  Relationship with Activity Payment
     */
    public function payments()
    {
        return $this->hasMany(ActivityPayment::class);
    }
}
