<?php 

    class CartItem
    {
        public $id;
        public $cart_id;
        public $food_id;
        public $name;   //duped in case of changes
        public $price;

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
    