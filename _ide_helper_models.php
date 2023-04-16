<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Anime
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $mal_id
 * @property float|null $mal_score
 * @property string $title_jp
 * @property string|null $title_en
 * @property string|null $title_ru
 * @property string|null $synopsis_en
 * @property string|null $synopsis_en_author
 * @property string|null $synopsis_en_author_url
 * @property string|null $synopsis_ru
 * @property string|null $synopsis_ru_author
 * @property string|null $synopsis_ru_author_url
 * @property string|null $type
 * @property int $approved
 * @property string|null $status
 * @property string $image_x96
 * @property string $image_x48
 * @property string $image_preview
 * @property string $image_original
 * @property array|null $title_synonyms
 * @property string|null $source
 * @property int|null $episodes
 * @property int|null $episodes_aired
 * @property \Illuminate\Support\Carbon|null $episodes_from
 * @property \Illuminate\Support\Carbon|null $episodes_to
 * @property int $duration
 * @property string|null $age_rating
 * @property string|null $season
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read int|null $licensors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read int|null $staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read int|null $studios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read int|null $themes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\AnimeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Anime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime ofGenres(array $genre_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime ofStaff(array $staff_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime ofStudios(array $studio_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime query()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereAgeRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodesAired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodesFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodesTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImageOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImagePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImageX48($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImageX96($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereMalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisEnAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisEnAuthorUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisRuAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisRuAuthorUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleSynonyms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 */
	class Anime extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Character
 *
 * @property int $id
 * @property int|null $mal_id
 * @property string $name_jp
 * @property string|null $name_en
 * @property string|null $name_ru
 * @property string $image_x32
 * @property string $image_x64
 * @property string $image_original
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read int|null $staff_count
 * @method static \Database\Factories\CharacterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereImageOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereImageX32($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereImageX64($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 */
	class Character extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $name_jp
 * @property string $name_en
 * @property string $name_ru
 * @method static \Database\Factories\GenreFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
	class Genre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\History
 *
 * @property int $id
 * @property array $old_data
 * @property array $new_data
 * @property string $type
 * @property int $user_id
 * @property int $rejected
 * @property int|null $moderator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $moderator
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History query()
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereModeratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereNewData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereOldData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
	class History extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Licensor
 *
 * @property int $id
 * @property string $name
 * @method static \Database\Factories\LicensorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
	class Licensor extends \Eloquent {}
}

namespace App\Models\OAuth{
/**
 * App\Models\OAuth\ClientInfo
 *
 * @property int $id
 * @property int $client_id
 * @property string|null $description
 * @property string $logo_url
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientInfo whereLogoUrl($value)
 * @mixin \Eloquent
 */
	class ClientInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Staff
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $mal_id
 * @property string $name_jp
 * @property string|null $name_en
 * @property string|null $name_ru
 * @property string $image_x32
 * @property string $image_x64
 * @property string $image_original
 * @property int $is_voice_actor
 * @property string|null $voice_language
 * @method static \Database\Factories\StaffFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff query()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereImageOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereImageX32($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereImageX64($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereIsVoiceActor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereVoiceLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
	class Staff extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Studio
 *
 * @property int $id
 * @property string $name
 * @method static \Database\Factories\StudioFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Studio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
	class Studio extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Theme
 *
 * @property int $id
 * @property string $name_jp
 * @property string|null $name_en
 * @property string|null $name_ru
 * @method static \Database\Factories\ThemeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme query()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
	class Theme extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $description
 * @property string|null $gender
 * @property int $custom_avatar
 * @property int $group_id
 * @property string $timezone
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Anime> $anime
 * @property-read int|null $anime_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \ALajusticia\AuthTracker\Models\Login> $logins
 * @property-read int|null $logins_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VerifyEmail> $verifyEmil
 * @property-read int|null $verify_emil_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCustomAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withAll()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\VerifyEmail
 *
 * @property int $id
 * @property int $user_id
 * @property string $hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 */
	class VerifyEmail extends \Eloquent {}
}

