<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Album
 * 
 * @property int $id
 * @property string|null $album_id
 * @property string|null $name
 * @property string|null $artists
 * @property string|null $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Album extends Model
{
	use SoftDeletes;
	protected $table = 'albums';

	protected $fillable = [
		'album_id',
		'name',
		'artists',
		'image_url'
	];
}
