<?php 
namespace App\Traits;
use Jenssegers\Date\Date;
// Para traducir fechas al español :JB
trait DatesTranslator
{
	public function getCreatedAtAttribute($created_at)
	{
		return new Date($created_at);
	}
	public function getUpdatedAtAttribute($updated_at)
	{
		return new Date($updated_at);
	}
	public function getDeletedAtAttribute($deleted_at)
	{
		return new Date($deleted_at);
	}
	public function getDatebirthAttribute($datebirth)
	{
		dd('entro aqui');
		return new Date($datebirth);
	}

	public function getSubmitedAtAttribute($submited_at)
	{
		return new Date($submited_at);
	}
}

 ?>