<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'conversation_id',
        'user_id',
        'type',
        'body',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function attachments()
    {
        return $this->hasMany(MessageAttachment::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Deleted User',
        ]);
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipients')->withPivot('read_at')->withTimestamps();
    }
}
