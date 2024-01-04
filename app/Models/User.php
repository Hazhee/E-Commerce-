<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return $this->hasRole(['Admin', 'Vendor']);
    // }


    public function products()
    {
        return $this->hasMany(Product::class,'vender_id');
    }

    // protected static function booted(): void
    // {
    //     // if (auth()->check()) {
    //     //     static::addGlobalScope('user', function (Builder $query) {
    //     //         $query->where('id', auth()->user()->id);
    //     //         // or with a `team` relationship defined:
    //     //         $query->whereBelongsTo(auth()->user()->name);
    //     //     });
    //     // }

    //     static::addGlobalScope('by_user', function (Builder $builder) {
    //         if(auth()->check()){
    //             if(auth()->user()->hasRole('Admin')){
    //                 $builder->latest();
    //             }elseif(auth()->user()->hasRole('Vendor')){
    //                 $builder->where('vender_id', auth()->user()->id);
    //             }
                
    //         }
    //     });
    // }
}
