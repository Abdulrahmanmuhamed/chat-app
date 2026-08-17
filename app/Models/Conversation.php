<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_id',
        'last_message_id',
    ];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')
            ->withPivot('role', 'joined_at')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id')->withDefault([
            'body' => 'No messages yet.',
        ]);
    }
}
