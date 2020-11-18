<?php

namespace Daudau\Modules\Api\Controllers;

use Daudau\Modules\Api\Rest\RestRecipeCookController;

class RecipeCookController extends RestRecipeCookController
{

    public function recipeCookNewestAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $this->getRecipeCookNewest($user_id);
        die();
    }

    public function recipeByUserAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $this->getRecipeByUser($user_id);
        die();
    }

    public function recipeByOtherUserAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $user_id_other = $this->request->getQuery('user_id_other');
        $this->getRecipeByOtherUser($user_id, $user_id_other);
        die();
    }

    public function recipeUserFavouriteAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $this->getRecipeUserFavourite($user_id);
        die();
    }

    public function recipeUserBookmarkAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $this->getRecipeUserBookmark($user_id);
        die();
    }

    public function favouriteRecipeAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $recipe_cook_id = $this->request->getQuery('recipe_cook_id');
        $this->getFavouriteRecipe($user_id, $recipe_cook_id);
        die();
    }

    public function recipeFavouritest6Action()
    {
        $this->getRecipeFavouritest6();
        die();
    }

    public function informationRecipeAction()
    {
        $user_id =$this->request->getQuery('user_id');
        $recipe_cook_id = $this->request->getQuery('recipe_cook_id');
        $this->getInformationRecipe($user_id,$recipe_cook_id);
        die();
    }

    public function commentRecipeAction()
    {
        $recipe_cook_id = $this->request->getQuery('recipe_cook_id');
        $this->getCommentRecipe($recipe_cook_id);
        die();
    }

    public function sendCommentRecipeAction()
    {
        $this->getSendCommentRecipe();
        die();
    }

    public function bookmarkRecipeAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $recipe_cook_id = $this->request->getQuery('recipe_cook_id');
        $this->getBookmarkRecipe($user_id, $recipe_cook_id);
    }

    public function recipePopularAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $this->getRecipePopular($user_id);
        die();
    }

    public function recipeByBookmarkUserAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $this->getRecipeByBookmarkUser($user_id);
        die();
    }

    public function seenRecipeAction(){
        $user_id = $this->request->getQuery('user_id');
        $recipe_cook_id= $this->request->getQuery('recipe_cook_id');
        $this->getSeenRecipe($user_id,$recipe_cook_id);
        die();
    }
    public function searchRecipeAction()
    {
        $user_id=$this->request->getQuery('user_id');
        $code_search =$this->request->getQuery('value');
        $this->getSearchRecipe($user_id,$code_search);
        die();
    }

    public function rateRecipeAction()
    {
        $point = $this->request->getQuery('point');
        $user_id = $this->request->getQuery('user_id');
        $recipe_cook_id = $this->request->getQuery('recipe_cook_id');
        $this->getRateRecipe($point,$user_id, $recipe_cook_id);
        die();
    }
}

