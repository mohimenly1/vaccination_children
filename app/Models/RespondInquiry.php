<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondInquiry extends Model
{

    use HasFactory;
    protected $table = 'respond_inquiries';

    protected $fillable = [
        'FeedBackText',
        'FeedBackType',
        'FeedBackState',
        'FeedBackReply',
        'users_app_id',
        'users_health_center_id',
    ];

  public function user_app()
    {
        return $this->belongsTo(User::class, 'users_app_id','id');
    }

    public function user_health_center()
    {
        return $this->belongsTo(User::class, 'users_health_center_id','id');
    }
}
