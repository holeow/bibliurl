<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bookmark
 * 
 * @property int $ID
 * @property string $Name
 * @property string|null $Comment
 * @property string $URL
 * @property Carbon|null $CreationDate
 * @property string|null $ImgUrl
 * @property int $Folder
 * 
 * @property Folder $folder
 * @property Collection|BookmarkTag[] $bookmark_tags
 *
 * @package App\Models
 */
class Bookmark extends Model
{
	protected $table = 'Bookmark';
	protected $primaryKey = 'ID';
	public $timestamps = false;

	protected $casts = [
		'Folder' => 'int'
	];

	protected $dates = [
		'CreationDate'
	];

	protected $fillable = [
		'Name',
		'Comment',
		'URL',
		'CreationDate',
		'ImgUrl',
		'Folder'
	];

	public function folder()
	{
		return $this->belongsTo(Folder::class, 'Folder');
	}

	public function bookmark_tags()
	{
		return $this->hasMany(BookmarkTag::class, 'Bookmark');
	}
}
