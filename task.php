<?php
class Task {
    public $id;
    public $title;
    public $description;
    public $category_id;

    public function __construct($id, $title, $description, $category_id) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
    }
}
