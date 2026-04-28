<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'last_active_at',
    ];

    protected $casts = [
        'f_name' => 'string',
        'l_name' => 'string',
        'dial_country_code' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'image' => 'string',
        'type' => 'integer',
        'role' => 'integer',
        'password' => 'string',
        'is_phone_verified' => 'integer',
        'is_email_verified' => 'integer',
        'last_active_at' => 'datetime',
        'unique_id' => 'string',
        'referral_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['image_fullpath', 'identification_image_fullpath', 'merchant_identification_image_fullpath'];

    public function getImageFullPathAttribute(): ?string
    {
        $image = $this->image ?? null;

        $path = dynamicAsset(path: 'public/assets/admin/img/160x160/img1.jpg');

        if ($image == null) {
            if (request()->is('api/*')) {
                $path = null;
            }
            return $path;
        }

        $folderNames = [0 => 'admin', 1 => 'agent', 2 => 'customer'];
        $folder = $folderNames[$this->type] ?? 'merchant';
        if (!is_null($image) && Storage::disk('public')->exists($folder . '/' . $image)) {
            $path = dynamicStorage(path: 'storage/app/public/' . $folder . '/' . $image);
        }

        return $path;
    }

    public function getIdentificationImageFullPathAttribute(): array
    {
        $value = $this->identification_image ?? [];
        $folder = $this->type == 3 ? 'merchant' : 'identity';
        $imageUrlArray = is_array($value) ? $value : json_decode($value, true);
        if (is_array($imageUrlArray)) {
            foreach ($imageUrlArray as $key => $item) {
                if (Storage::disk('public')->exists('user/identity/' . $item)) {
                    $imageUrlArray[$key] = dynamicStorage(path: 'storage/app/public/user/identity/' . $item);
                } else {
                    $imageUrlArray[$key] = dynamicAsset(path: 'public/assets/admin/img/900x400/img1.jpg');
                }
            }
        }
        return $imageUrlArray;
    }

    public function getMerchantIdentificationImageFullPathAttribute(): array
    {
        $value = $this->identification_image ?? [];
        $imageUrlArray = is_array($value) ? $value : json_decode($value, true);
        if (is_array($imageUrlArray)) {
            foreach ($imageUrlArray as $key => $item) {
                if (Storage::disk('public')->exists('merchant/' . $item)) {
                    $imageUrlArray[$key] = dynamicStorage(path: 'storage/app/public/merchant/' . $item);
                } else {
                    $imageUrlArray[$key] = dynamicAsset(path: 'public/assets/admin/img/160x160/img1.jpg');
                }
            }
        }
        return $imageUrlArray;
    }

    public function AauthAcessToken(): HasMany
    {
        return $this->hasMany(OauthAccessToken::class);
    }

    public function scopeAgent(Builder $query): Builder
    {
        return $query->where('type', '=', 1);
    }

    public function scopeCustomer(Builder $query): Builder
    {
        return $query->where('type', '=', 2);
    }

    public function scopeMerchantUser(Builder $query): Builder
    {
        return $query->where('type', '=', 3);
    }

    public function scopeOfType(Builder $query, int $user_type): Builder
    {
        return $query->where('type', '=', $user_type);
    }

    public function emoney(): HasOne
    {
        return $this->hasOne(EMoney::class, 'user_id', 'id');
    }

    public function user_log_histories(): HasMany
    {
        return $this->hasMany(UserLogHistory::class, 'user_id', 'id');
    }

    public function merchant(): HasOne
    {
        return $this->hasOne(Merchant::class, 'user_id', 'id');
    }

    public static function boot(): void
    {
        parent::boot();

        self::updated(function ($model) {
            if ($model->isDirty('is_active')) {
                if ($model->is_active == 0) {
                    $model->tokens->each(function ($token, $key) {
                        $token->revoke();
                    });
                }
            }
        });
    }
}
