<?php

namespace Daudau\Modules\Api\Rest;

use Daudau\Common\Models\Bookmark\Bookmark;
use Daudau\Common\Models\Bookmark\Category;
use Daudau\Common\Models\Bookmark\CategoryType;
use Daudau\Common\Models\Recipe\RecipeCategory;
use Daudau\Common\Models\Recipe\SeenRecipe;
use Daudau\Common\Models\Users\Status;
use Phalcon\Mvc\Controller;

class RestCategoryController extends Controller
{
    protected function getCategoryFather()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $category = CategoryType::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_enable
            ]
        ]);
        $list = [];
        foreach ($category as $index => $item) {
            $list[$index]['id'] = $item->getId();
            $list[$index]['name'] = $item->getName();
            // $list[$index]['image']=$item->image->getImageUrlResize();
            $list[$index]['image'] = "";
        }
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }


    protected function getCategory($id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $category = Category::find([
            'conditions' => 'type_id=:type_id: and status_id=:status_id:',
            'bind' => [
                'type_id' => $id,
                'status_id'=>$status_id_enable
            ]
        ]);
        $list = [];
        foreach ($category as $index => $item) {

            $list[$index]['id'] = $item->getId();
            $list[$index]['name'] = $item->getName();
            // $list[$index]['image']=$item->image->getImageUrlResize();
            $list[$index]['image'] = "null";
        }
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getRecipeByCategory($user_id, $category_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');

        $format = $this->request->getQuery('format', null, 'json');
        $recipe_category = RecipeCategory::find([
            'conditions' => 'category_id=:category_id: and status_id=:status_id:',
            'bind' => [
                'category_id' => $category_id,
                'status_id'=>$status_id_enable
            ]
        ]);
        $list = [];
        foreach ($recipe_category as $index => $item) {
            $recipecategory = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $item->recipe->getId(),
                    'status_id'=>$status_id_enable
                ]
            ]);
            $list_recipe_category = '';
            foreach ($recipecategory as $item2) {
                $list_recipe_category .= $item2->category->getName() . ',';
            }
            if ($list_recipe_category != null || $list_recipe_category != '') {
                $list_recipe_category = substr($list_recipe_category, 0, -1);
            }
            $seen_recipe = SeenRecipe::count([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: ',
                'bind' => [
                    'recipe_cook_id' => $item->recipe->getId()

                ]
            ]);
            $favourite = Bookmark::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'bookmark_type' => 'favourite',
                    'status_id' => $status_id_enable,
                    'recipe_cook_id' => $item->recipe->getId()
                ]
            ]);
            $bookmark = Bookmark::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'bookmark_type' => 'bookmark',
                    'status_id' => $status_id_enable,
                    'recipe_cook_id' => $item->recipe->getId()
                ]
            ]);
            if ($favourite) {
                $like = 'true';
            } else {
                $like = 'false';
            }
            if ($bookmark) {
                $bookmark = 'true';
            } else {
                $bookmark = 'false';
            }
            $list[$index]['id'] = $item->recipe->getId();
            $list[$index]['name'] = $item->recipe->getName();
            $list[$index]['category'] = $list_recipe_category;
            $list[$index]['image'] = $item->recipe->image->getImageUrlResize();
            $list[$index]['views'] = $seen_recipe;
            $list[$index]['times'] = $item->recipe->getTimeDo();
            $list[$index]['like'] = $like;
            $list[$index]['bookmark'] = $bookmark;
        }
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }
}

