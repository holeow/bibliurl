<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookmarkTag
 * 
 * @property int $Bookmark
 * @property string $Tag
 * 
 * @property Bookmark $bookmark
 *
 * @package App\Models
 */
class BookmarkTag extends Model
{
	protected $table = 'Bookmark_Tag';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Bookmark' => 'int'
	];

	public function bookmark()
	{
		return $this->belongsTo(Bookmark::class, 'Bookmark');
	}
}
