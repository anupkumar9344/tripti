<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Support\AdminPermissions;
use App\Support\MediaPath;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    public const STATUS_ACTIVE = true;

    public const STATUS_INACTIVE = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'is_admin',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'status' => 'boolean',
        ];
    }

    /**
     * Check if the user is an active admin panel user.
     */
    public function isActiveAdmin(): bool
    {
        return $this->is_admin && $this->status;
    }

    /**
     * Determine whether the user is a super admin with full access.
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole(AdminPermissions::SUPER_ADMIN_ROLE);
    }

    /**
     * Check if the user can perform an admin panel action.
     */
    public function canAdmin(string $permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->can($permission);
    }

    /**
     * Get the URL for the user's profile image or the default avatar.
     */
    public function avatarUrl(): string
    {
        if ($this->image) {
            return MediaPath::url($this->image);
        }

        return asset('admin/assets/images/users/user-4.jpg');
    }

    /**
     * Display label for the assigned role.
     */
    public function roleLabel(): string
    {
        return $this->roles->first()?->name ?? 'No role';
    }
}
