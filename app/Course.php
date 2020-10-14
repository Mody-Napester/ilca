<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'details', 'location_id',
        'price_egp', 'price_usd', 'comments',
        'date_from', 'date_to',
        'sales_id','is_active',
        'created_by', 'updated_by'];

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
    public function sales()
    {
        return $this->belongsTo('App\User', 'sales_id');

    }

    /**
     *  Relationship with users
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');

    }

    /**
     *  Relationship with certificates
     */
    public function certificates()
    {
        return $this->belongsToMany('App\Certificate', 'course_certificate')->withTimestamps();
    }

    /**
     *  Relationship with trainers
     */
    public function trainers()
    {
        return $this->belongsToMany('App\Trainer', 'course_trainer')->withTimestamps();
    }

    /**
     *  Relationship with prices
     */
    public function prices()
    {
        return $this->belongsToMany('App\CoursePrice', 'course_course_price')->withTimestamps();
    }

    /**
     *  Relationship with students
     */
    public function students()
    {
        return $this->belongsToMany('App\Student', 'course_student')
            ->withPivot(['sales_id', 'course_price_id', 'joined_at', 'attendance_type'])->withTimestamps();
    }

    /**
     *  Relationship with location
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
