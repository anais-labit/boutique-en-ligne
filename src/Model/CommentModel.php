<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;

class CommentModel extends AbstractModel {

    public function __construct()
    {
        parent::connect();
        $this->tableName = 'reviews';
    }

    public function getAverageRating(int $id) {

        return $this->readOneSingleInfo('AVG(rate)', 'id_product', $id);

    }

    public function getCommentsNumber(int $id) {

        return $this->readOneSingleInfo('COUNT(id)', 'id_product', $id);

    }

    public function sendAnswer(array $params) {

        $this->tableName = 'answers';

        $this->createOne([$params]);

    }

}
?>