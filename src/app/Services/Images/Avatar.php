<?php

namespace App\Services\Images;

use App\Jobs\MinimizeAvatar;
use App\Jobs\UpdateUserAvatars;
use App\Repositories\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use App\Contracts\Images\Avatar as AvatarsContract;

class Avatar implements AvatarsContract
{
    public function update(Model $user, UploadedFile $image)
    {
        $name = $user->id . '_' . $user->name . '.' . $image->extension();

        $avatar_path = $image->storeAs('original', $name, ['disk' => 'avatars']);

        app(User::class)->updateAvatar($user->id, '/' . $avatar_path);

        MinimizeAvatar::dispatch($avatar_path, [32, 64, 128], $user->id, $image->extension())->delay(now()->addSeconds(15));
    }
}
