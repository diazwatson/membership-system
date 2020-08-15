<?php namespace BB\Validators;

class UserValidator extends FormValidator
{

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'given_name'            => 'required',
        'family_name'           => 'required',
        'email'                 => 'required|email|unique:users',
        'secondary_email'       => 'email|unique:users',
        'display_name'          => 'required|unique:users',
        'announce_name'         => '',
        'password'              => 'required|min:8',
        'phone'                 => 'required|min:10',
        'address.line_1'        => 'required',
        'address.line_2'        => '',
        'address.line_3'        => '',
        'address.line_4'        => '',
        'address.postcode'      => 'required|postcode',
        'monthly_subscription'  => 'required|integer|min:12',
        'emergency_contact'     => 'required',
        'rules_agreed'          => 'accepted',
    
    ];


    //During an update these rules will override the ones above
    protected $updateRules = [
        'email'                => 'required|email|unique:users,email,{id}',
        'secondary_email'      => 'email|unique:users,secondary_email,{id}',
        'password'             => 'min:8',
        'display_name'          => '',
        'monthly_subscription' => '',
        'rules_agreed'         => '',
    ];


    protected $adminOverride = [
        'password'          => 'min:8',
        'emergency_contact' => '',
        'phone'             => '',
    ];

} 
