<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'nohp',
        'avatar',
        'alamat',
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

    public function scopefilterTableModel($query)
    {
        if (request('cari')){
            $variabelCari = '%' . request('cari') . '%';
            $query->where('name', 'like', $variabelCari);
        }
    }

    public function postUser()
    {
        return $this->hasMany(Post::class)->with('user');
    }

    public function profileShow()
    {
        return $this->hasMany(Post::class)->with('user');
    }

    public function hideShows()
    {
        return $this->hasMany(PostHide::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    
}
