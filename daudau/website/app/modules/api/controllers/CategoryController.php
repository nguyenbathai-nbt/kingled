<?php

namespace Daudau\Modules\Api\Controllers;


use Daudau\Modules\Api\Rest\RestCategoryController;

class CategoryController extends RestCategoryController
{

    public function categoryFatherAction()
    {
        $this->getCategoryFather();
        die();
    }

    public function categoryAction()
    {
        $category_id= $this->request->getQuery('category_id');
        $this->getCategory($category_id);
        die();
    }
    public function recipeByCategoryAction()
    {
        $user_id=$this->request->getQuery('user_id');
        $category_id= $this->request->getQuery('category_id');
        $this->getRecipeByCategory($user_id,$category_id);
        die();

    }


}

