<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;

class CommentModel extends AbstractModel {

    public function __construct()
    {
        parent::connect();
        $this->tableName = 'reviews';
    }



}
?>