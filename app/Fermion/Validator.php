<?php 
namespace Fermion;

class Validator {
	
	/**
	 * Validating input
	 *
	 * @param array
	 * @return object
	 */
	public function validate($input, $rules) {
	
		$res = new \StdClass;
		$res->hasPassed = true;
		foreach($rules as $rule) {
			if(empty($input[$rule])) {
				$res->hasPassed = false;
				$res->errorMessage = 'Please fill in the "'. $rule .'" field.';
			}
		}
		
		return $res;
	}
}