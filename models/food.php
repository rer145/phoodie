<?php 

    class Food
    {
        public $id;
        public $name;
        public $price;
        public $description;
        public $photo_url;
        public $restaurant;
        public $location;
        public $category;

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
    