<?php 

    class Foodie
    {
        public $id;
        public $default_name;
        public $default_address1;
        public $default_address2;
        public $default_city;
        public $default_state;
        public $default_zip;
        public $default_phone;

        public $email;
        public $password;

        public $default_cc_name;
        public $default_cc_number;
        public $default_cc_cvv;
        public $default_cc_exp_mo;
        public $default_cc_exp_yr;
        public $default_cc_zip;

        public function __construct($data = null)
        {
            // if (is_array($data)) {
            //     if (isset($data['id'])) $this->id = $data['id'];

            //     $this->username = $data['username'];
            //     $this->password = $data['password'];
            //     $this->email = $data['email'];
            //     $this->verified = $data['verified'];
            //     $this->mod_timestamp = $data['mod_timestamp'];
            // }
        }
    }
    