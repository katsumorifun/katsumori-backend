<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditAnimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mal_id' => 'integer',
            'mal_score' => 'integer',
            'title_jp' => 'string',
            'title_en' => 'string',
            'title_ru' => 'string',
            'synopsis_en' => 'string',
            'synopsis_ru' => 'string',
            'type' => 'in:serial,film,ova,ona,clip,special,tv',
            'approved' => 'boolean',
            'status' => 'in:announced,ongoing,finished',
            //            'image_x32' => 'required|string',
            //            'image_x64' => 'required|string',
            //            'image_x128' => 'required|string',
            //            'image_original' => 'required|string',
            'title_synonyms' => 'json',
            'source' => 'in:manga,light novel,original',
            'episodes' => 'integer',
            'episodes_aired' => 'integer',
            'episodes_to' => 'datetime',
            'episodes_from' => 'date',
            'duration' => 'integer',
            'age_rating' => 'in:g,pg,pg-13,r-17,r+',
            'season' => 'in:summer,autumn,winter,spring',
        ];
    }
}
