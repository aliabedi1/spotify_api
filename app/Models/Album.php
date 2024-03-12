<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Album
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $artists
 * @property string|null $image_url
 * @property string $selected
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Album extends Model
{
	protected $table = 'albums';

	protected $fillable = [
		'name',
		'artists',
		'image_url',
		'selected'
	];
}
