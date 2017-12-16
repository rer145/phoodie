<?php 

    class Foodie
    {
        public $id;
        public $session_id;
        public $delivery_name;
        public $delivery_address1;
        public $delivery_address2;
        public $delivery_city;
        public $delivery_state;
        public $delivery_zip;
        public $delivery_phone;

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
    