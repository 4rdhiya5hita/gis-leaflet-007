<?php

namespace App;

use App\User;
use App\School;
use App\Jenjang;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alamat', 'image', 'akreditas', 'latitude', 'longitude', 'creator_id', 'jenjang_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
        'coordinate', 'map_popup_content',
    ];

    /**
     * Get outlet name_link attribute.
     *
     * @return string
     */
    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->name, 'type' => __('outlet.outlet'),
        ]);
        $link = '<a style="text-decoration: none; color:white;" href="'.route('outlets.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }

    /**
     * Outlet belongs to User model relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id', 'id');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'school_id', 'id');
    }

    public function school_map($school_id)
    {
        $school = School::find($school_id);
        return $school;
    }

    /**
     * Get outlet coordinate attribute.
     *
     * @return string|null
     */
    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude.', '.$this->longitude;
        }
    }

    /**
     * Get outlet map_popup_content attribute.
     *
     * @return string
     */
    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = ''; 
        $mapPopupContent .= '<img src="' . secure_asset('img/'.$this->image) . '" alt="Gambar" style="width: 100%; height: 180px">';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.name').':</strong><br>'.$this->name.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.akreditas').':</strong><br>'. $this->akreditas .'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.alamat').':</strong><br>'.$this->alamat.'</div>';

        $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.coordinate').':</strong><br>'.$this->coordinate.'</div>';
        $mapPopupContent .= '<div class="btn btn-primary" style="display: flex; justify-content: center;">'.$this->name_link.'</div>';

        return $mapPopupContent;
    }
}
