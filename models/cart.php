<?php 

    class Cart
    {
        public $id;
        public $foodie_id;
        public $session_id;
        public $email;
        public $delivery_name;
        public $delivery_address1;
        public $delivery_address2;
        public $delivery_city;
        public $delivery_state;
        public $delivery_zip;
        public $delivery_phone;
        public $order_timestamp;
        public $order_complete;

        public $cc_name;
        public $cc_number;
        public $cc_cvv;
        public $cc_exp_mo;
        public $cc_exp_yr;
        public $cc_zip;

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
    