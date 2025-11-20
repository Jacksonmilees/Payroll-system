<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;

class User extends Authenticatable {

	use Notifiable;
	use HasRolesAndPermissions;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'created_by', 'employee_id', 'name', 'name_prefix', 'father_name', 'mother_name', 'spouse_name', 'email', 'password', 'present_address', 'permanent_address', 'home_district', 'id_name', 'id_number', 'contact_no_one', 'contact_no_two', 'emergency_contact', 'web', 'gender', 'date_of_birth', 'marital_status', 'avatar', 'client_type_id', 'designation_id', 'access_label', 'joining_position', 'activation_status', 'academic_qualification', 'professional_qualification', 'experience', 'reference', 'joining_date', 'deletion_status', 'role','nssf_no','nhif_no','passport_picture','kra_no','kin_details_name','kin_details_relation','kin_details_phone','account_name','bank_acc_no','bank_name','bank_branch','bank_sort_code'
	];

	protected $appends = ['display_name'];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	protected static function boot()
	{
		parent::boot();

		static::saving(function ($user) {
			if (empty($user->name_prefix) && !empty($user->name)) {
				$user->name_prefix = self::generateNamePrefix($user->name);
			}
		});
	}

	public function getEmployeeIdAttribute($value)
	{
		return sprintf('%04s', $value);
	}

	public function getDisplayNameAttribute()
	{
		$prefix = $this->name_prefix ? strtoupper($this->name_prefix) . ' - ' : '';

		return trim($prefix . $this->attributes['name']);
	}

	protected static function generateNamePrefix($name)
	{
		$segments = preg_split('/\s+/', trim($name));
		$initials = '';

		foreach ($segments as $segment) {
			if ($segment === '') {
				continue;
			}

			$initials .= strtoupper(substr($segment, 0, 1));
		}

		return substr($initials, 0, 3);
	}
// 	public function getEmployeeId($value) {
// 	    sprintf('%04s', 
// 	}

}
