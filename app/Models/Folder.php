<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Folder
 * 
 * @property int $ID
 * @property string $Name
 * @property string|null $ImgUrl
 * @property int|null $Container
 * @property int $WebUser
 * 
 * @property Folder|null $folder
 * @property User $user
 * @property Collection|Bookmark[] $bookmarks
 * @property Collection|Folder[] $folders
 * @property Collection|FolderTag[] $folder_tags
 *
 * @package App\Models
 */
class Folder extends Model
{
	protected $table = 'Folder';
	protected $primaryKey = 'ID';
	public $timestamps = false;

	protected $casts = [
		'Container' => 'int',
		'WebUser' => 'int'
	];

	protected $fillable = [
		'Name',
		'ImgUrl',
		'Container',
		'WebUser'
	];

	public function folder()
	{
		return $this->belongsTo(Folder::class, 'Container');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'WebUser');
	}

	public function bookmarks()
	{
		return $this->hasMany(Bookmark::class, 'Folder');
	}

	public function folders()
	{
		return $this->hasMany(Folder::class, 'Container');
	}

	public function folder_tags()
	{
		return $this->hasMany(FolderTag::class, 'Folder');
	}
}
