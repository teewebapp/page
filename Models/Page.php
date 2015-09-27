<?php

namespace Tee\Page\Models;

use Tee\System\Models\Model;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Tee\System\Traits\CurrentSiteTrait;
use URL;

class Page extends Model implements SluggableInterface, StaplerableInterface
{
    use CurrentSiteTrait;
    use SluggableTrait;
    use EloquentTrait; // Stapler Image Upload

    const NORMAL = 1;
    const LINKED = 2;

    const VISIBLE = 1;
    const HIDDEN = 0;

    const HOME = 'home';

    protected $defaults = [
        'type' => Page::NORMAL,
        'visibility' => Page::VISIBLE
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

	public static $rules = [
		'title' => 'required'
	];
	protected $fillable = [
        'link',
        'type',
        'visibility',
        'order',
        'image',
        'title',
        'keywords',
        'language',
        'description',
        'text',
        'page_category_id'
    ];

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('image', [
            'styles' => [
                'medium' => '300x300',
            ]
        ]);

        parent::__construct($attributes);
    }

    public static function getAttributeNames()
    {
        return array(
            'title' => 'Título',
            'description' => 'Descrição',
            'text' => 'Texto',
            'keywords' => 'Palavras Chave',
            'image' => 'Imagem',
            'type' => 'Tipo',
            'link' => 'Link Externo',
            'language' => 'Linguagem',
            'visibility' => 'Visibilidade',
        );
    }

    public function getImageUrlAttribute()
    {
        if($this->image_file_name)
            return URL::to($this->image->url());
        else
            return URL::to(moduleAsset('system', 'images/no-photo.jpg'));
    }

    public function category()
    {
        return $this->belongsTo(__NAMESPACE__.'\\PageCategory', 'page_category_id');
    }

    public function scopeSpecial($query, $name)
    {
        return $query->where('special', '=', $name);
    }

    public function getUrlAttribute()
    {
        if($this->type == Page::LINKED)
            return $this->link;
        else
            return URL::route('page.show', $this->slug);
    }
}