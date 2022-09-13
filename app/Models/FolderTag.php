<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FolderTag
 * 
 * @property int $Folder
 * @property string $Tag
 * 
 * @property Folder $folder
 *
 * @package App\Models
 */
class FolderTag extends Model
{
	protected $table = 'Folder_Tag';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Folder' => 'int'
	];

	public function folder()
	{
		return $this->belongsTo(Folder::class, 'Folder');
	}
}
