<?php

namespace Daudau\Modules\Api\Rest;

use Daudau\Common\Models\Bookmark\Bookmark;
use Daudau\Common\Models\Bookmark\BookmarkUser;
use Daudau\Common\Models\Bookmark\Category;
use Daudau\Common\Models\Recipe\Comment;
use Daudau\Common\Models\Recipe\Image;
use Daudau\Common\Models\Recipe\RawMaterial;
use Daudau\Common\Models\Recipe\RecipeCategory;
use Daudau\Common\Models\Recipe\RecipeCook;
use Daudau\Common\Models\Recipe\RecipeMaterial;
use Daudau\Common\Models\Recipe\SeenRecipe;
use Daudau\Common\Models\Recipe\SpamRecipe;
use Daudau\Common\Models\Recipe\Step;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Phalcon\Mvc\Controller;

class RestRecipeCookController extends Controller
{
    protected function getRecipeCookNewest($user_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $recipe = RecipeCook::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_enable,
            ],
            'order' => 'created_time DESC'
        ]);
        $list = [];
        foreach ($recipe as $index => $item) {
            $recipecategory = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $item->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $list_recipe_category = '';
            foreach ($recipecategory as $item2) {
                $list_recipe_category .= $item2->category->getName() . ',';
            }
            if ($list_recipe_category != null || $list_recipe_category != '') {
                $list_recipe_category = substr($list_recipe_category, 0, -1);
            }
            $favourite = Bookmark::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'recipe_cook_id' => $item->getId(),
                    'bookmark_type' => 'favourite',
                    'status_id' => $status_id_enable
                ]
            ]);
            $bookmark = Bookmark::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'recipe_cook_id' => $item->getId(),
                    'bookmark_type' => 'bookmark',
                    'status_id' => $status_id_enable
                ]
            ]);

            $list[$index]['id'] = $item->getId();
            $list[$index]['name'] = $item->getName();
            $list[$index]['category'] = $list_recipe_category;
            $list[$index]['image'] = $item->image->getImageUrl();
            $list[$index]['view'] = SeenRecipe::count([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $item->getId()
                ]
            ]);
            $list[$index]['times'] = $item->getTimeDo();
            if ($favourite) {
                $list[$index]['like'] = 'true';
            } else {
                $list[$index]['like'] = 'false';
            }
            if ($bookmark) {
                $list[$index]['bookmark'] = 'true';
            } else {
                $list[$index]['bookmark'] = 'false';
            }
            $list[$index]['link_video'] = $item->getLinkVideo();
            $list[$index]['link_share'] = $item->getLinkShare();
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


    protected function getRecipeByUser($user_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_confirm = Status::getStatusIdByCode('confirm');
        $status_id_edit = Status::getStatusIdByCode('edit');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_reject = Status::getStatusIdByCode('reject');
        $format = $this->request->getQuery('format', null, 'json');
        $recipe = RecipeCook::find([
            'conditions' => 'user_id=:user_id: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id,
                'status_id' => $status_id_enable
            ]
        ]);

        $list = [];
        foreach ($recipe as $index => $item) {
            $recipecategory = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $item->getId(),
                    'status_id' => $status_id_enable
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
                    'recipe_cook_id' => $item->getId(),
                ]
            ]);
            $list[$index]['id'] = $item->getId();
            $list[$index]['name'] = $item->getName();
            $list[$index]['category'] = $list_recipe_category;
            $list[$index]['view'] = $seen_recipe;
            $list[$index]['image'] = $item->image->getImageUrl();
            $list[$index]['times'] = $item->getTimeDo();
            if ($item->getStatusId() == $status_id_enable) {
                $list[$index]['status'] = '1';
            } elseif ($item->getStatusId() == $status_id_confirm) {
                $list[$index]['status'] = '2';
            } elseif ($item->getStatusId() == $status_id_edit) {
                $list[$index]['status'] = '3';
            } elseif ($item->getStatusId() == $status_id_disable || $item->getStatusId() == $status_id_reject) {
                $list[$index]['status'] = '4';
            }
            $list[$index]['link_video'] = $item->getLinkVideo();
            $list[$index]['link_share'] = $item->getLinkShare();

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

    protected function getRecipeByOtherUser($user_id, $user_id_other)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_confirm = Status::getStatusIdByCode('confirm');
        $status_id_edit = Status::getStatusIdByCode('edit');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_reject = Status::getStatusIdByCode('reject');
        $format = $this->request->getQuery('format', null, 'json');

        $recipe = RecipeCook::find([
            'conditions' => 'user_id=:user_id: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id_other,
                'status_id' => $status_id_enable
            ]
        ]);

        $list = [];
        foreach ($recipe as $index => $item) {
            $recipecategory = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $item->getId(),
                    'status_id' => $status_id_enable
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
                    'recipe_cook_id' => $item->getId()
                ]
            ]);
            $favourite = Bookmark::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'recipe_cook_id' => $item->getId(),
                    'bookmark_type' => 'favourite',
                    'status_id' => $status_id_enable
                ]
            ]);
            $bookmark = Bookmark::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'recipe_cook_id' => $item->getId(),
                    'bookmark_type' => 'bookmark',
                    'status_id' => $status_id_enable
                ]
            ]);
            $list[$index]['id'] = $item->getId();
            $list[$index]['name'] = $item->getName();
            $list[$index]['category'] = $list_recipe_category;
            $list[$index]['view'] = $seen_recipe;
            $list[$index]['image'] = $item->image->getImageUrl();
            $list[$index]['times'] = $item->getTimeDo();
            if ($favourite) {
                $list[$index]['like'] = 'true';
            } else {
                $list[$index]['like'] = 'false';
            }
            if ($bookmark) {
                $list[$index]['bookmark'] = 'true';
            } else {
                $list[$index]['bookmark'] = 'false';
            }
            $list[$index]['link_video'] = $item->getLinkVideo();
            $list[$index]['link_share'] = $item->getLinkShare();


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


    protected function getRecipeUserFavourite($user_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $format = $this->request->getQuery('format', null, 'json');
        $favourite = Bookmark::find([
            'conditions' => 'user_id=:user_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id,
                'bookmark_type' => 'favourite',
                'status_id' => $status_id_enable
            ]
        ]);
        $list = [];
        foreach ($favourite as $index => $item) {
            $recipe = RecipeCook::findFirst([
                'conditions' => 'id=:id: and status_id=:status_id:',
                'bind' => [
                    'id' => $item->getRecipeCookId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            if ($recipe) {
                $seen = SeenRecipe::count([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getRecipeCookId()
                    ]
                ]);
                $recipecategory = RecipeCategory::find([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getRecipeCookId(),
                        'status_id' => $status_id_enable
                    ]
                ]);
                $list_recipe_category = '';
                foreach ($recipecategory as $item2) {
                    $list_recipe_category .= $item2->category->getName() . ',';
                }
                if ($list_recipe_category != null || $list_recipe_category != '') {
                    $list_recipe_category = substr($list_recipe_category, 0, -1);
                }
                $bookmark = Bookmark::findFirst([
                    'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                    'bind' => [
                        'user_id' => $user_id,
                        'recipe_cook_id' => $recipe->getId(),
                        'bookmark_type' => 'bookmark',
                        'status_id' => $status_id_enable
                    ]
                ]);
                if ($bookmark) {
                    $bookmark = 'true';
                } else {
                    $bookmark = 'false';
                }
                $list[$index]['id'] = $recipe->getId();
                $list[$index]['name'] = $recipe->getName();
                $list[$index]['category'] = $list_recipe_category;
                $list[$index]['view'] = $seen;
                $list[$index]['image'] = $recipe->image->getImageUrl();
                $list[$index]['times'] = $recipe->getTimeDo();
                $list[$index]['like'] = 'true';
                $list[$index]['bookmark'] = $bookmark;
                $list[$index]['link_video'] = $recipe->getLinkVideo();
                $list[$index]['link_share'] = $recipe->getLinkShare();
            } else {

            }


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

    protected function getRecipeUserBookmark($user_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $format = $this->request->getQuery('format', null, 'json');
        $bookmark = Bookmark::find([
            'conditions' => 'user_id=:user_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id,
                'bookmark_type' => 'bookmark',
                'status_id' => $status_id_enable
            ]
        ]);
        $list = [];
        foreach ($bookmark as $index => $item) {
            $recipe = RecipeCook::findFirst([
                'conditions' => 'id=:id: and status_id=:status_id:',
                'bind' => [
                    'id' => $item->getRecipeCookId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $seen = SeenRecipe::count([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $item->getRecipeCookId()
                ]
            ]);
            $recipecategory = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $item->getRecipeCookId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $list_recipe_category = '';
            foreach ($recipecategory as $item2) {
                $list_recipe_category .= $item2->category->getName() . ',';
            }
            if ($list_recipe_category != null || $list_recipe_category != '') {
                $list_recipe_category = substr($list_recipe_category, 0, -1);
            }
            $favourite = Bookmark::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'bookmark_type' => 'favourite',
                    'status_id' => $status_id_enable,
                    'recipe_cook_id' => $recipe->getId()
                ]
            ]);
            $list[$index]['id'] = $recipe->getId();
            $list[$index]['name'] = $recipe->getName();
            $list[$index]['category'] = $list_recipe_category;
            $list[$index]['view'] = $seen;
            $list[$index]['image'] = $recipe->image->getImageUrl();
            $list[$index]['times'] = $recipe->getTimeDo();
            $list[$index]['link_video'] = $recipe->getLinkVideo();
            $list[$index]['link_share'] = $recipe->getLinkShare();
            if ($favourite) {
                $list[$index]['like'] = 'true';

            } else {
                $list[$index]['like'] = 'false';
            }

            $list[$index]['bookmark'] = 'true';

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

    protected function getFavouriteRecipe($user_id, $recipe_cook_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $this->view->disable();
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'id=:id: and status_id=:status_id:',
            'bind' => [
                'id' => $recipe_cook_id,
                'status_id' => $status_id_enable
            ]
        ]);
        $bookmark = Bookmark::findFirst([
            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type:',
            'bind' => [
                'user_id' => $user_id,
                'recipe_cook_id' => $recipe_cook_id,
                'bookmark_type' => 'favourite'
            ]
        ]);
        if ($recipe_cook) {
            if ($bookmark) {
                if ($bookmark->getStatusId() == $status_id_disable) {
                    $bookmark->setStatusId($status_id_enable);
                    $bookmark->setBookmarkType('favourite');
                    $bookmark->save();
                    $recipe_cook->setBookmarkTotal($recipe_cook->getBookmarkTotal() + 1);
                    $bookmarktotal = $recipe_cook->getBookmarkTotal();
                    $recipe_cook->save();
                    $list = [
                        'code' => 1,
                        'message' => 'favourite',
                        'bookmarktotal' => $bookmarktotal
                    ];
                } else {
                    $bookmark->setStatusId($status_id_disable);
                    $bookmark->setBookmarkType('favourite');
                    $bookmark->save();
                    $recipe_cook->setBookmarkTotal($recipe_cook->getBookmarkTotal() - 1 < 0 ? 0 : $recipe_cook->getBookmarkTotal() - 1);
                    $bookmarktotal = $recipe_cook->getBookmarkTotal();
                    $recipe_cook->save();
                    $list = [
                        'code' => 1,
                        'message' => 'quit favourite',
                        'bookmarktotal' => $bookmarktotal
                    ];

                }
            } else {
                $bookmark = new Bookmark();
                $bookmark->setId($bookmark->getSequenceId());
                $bookmark->setUserId($user_id);
                $bookmark->setRecipeCookId($recipe_cook_id);
                $bookmark->setStatusId($status_id_enable);
                $bookmark->setBookmarkType('favourite');
                $bookmark->save();
                $recipe_cook->setBookmarkTotal($recipe_cook->getBookmarkTotal() + 1);
                $bookmarktotal = $recipe_cook->getBookmarkTotal();
                $recipe_cook->save();
                $list = [
                    'code' => 1,
                    'message' => 'quit favourite',
                    'bookmarktotal' => $bookmarktotal
                ];
            }
        } else {
            $list = [
                'code' => 2,
                'message' => 'Không tìm thấy công thức'
            ];
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

    protected function getRecipeFavouritest6()
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $format = $this->request->getQuery('format', null, 'json');

        $recipe = RecipeCook::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_enable
            ],
            'order' => 'bookmark_total DESC'
        ]);

        $list = [];
        foreach ($recipe as $index => $item) {
            if ($index < 6) {
                $recipecategory = RecipeCategory::find([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getId(),
                        'status_id' => $status_id_enable
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
                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getId()
                    ]
                ]);
                $list[$index]['id'] = $item->getId();
                $list[$index]['name'] = $item->getName();
                $list[$index]['category'] = $list_recipe_category;
                $list[$index]['view'] = $seen_recipe;
                $list[$index]['image'] = $item->image->getImageUrl();
                $list[$index]['times'] = $item->getTimeDo();
                $list[$index]['link_video'] = $item->getLinkVideo();
                $list[$index]['link_share'] = $item->getLinkShare();
            }

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

    protected function getInformationRecipe($user_id, $recipe_cook_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'id=:id: and status_id=:status_id:',
            'bind' => [
                'id' => $recipe_cook_id,
                'status_id' => $status_id_enable
            ]
        ]);
        $user = Users::findFirst([
            'conditions' => 'id=:id: and status_id=:status_id:',
            'bind' => [
                'id' => $user_id,
                'status_id' => $status_id_enable
            ]
        ]);

        $recipe_ingredients = [];
        $list_recipe_material = RecipeMaterial::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id: ',
            'bind' => [
                'recipe_cook_id' => $recipe_cook->getId(),
                'status_id' => $status_id_enable
            ]
        ]);
        foreach ($list_recipe_material as $item) {
            $recipe_ingredients[] = [
                'name' => $item->rawmaterial->getName(),
                'quality' => $item->quantitative->getName(),
                'number' => $item->getNumber()
            ];
        }


        foreach ($list_recipe_material as $item) {
            $item->setRawMaterialId($item->rawmaterial->getName());
        }

        $list_step = Step::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook->getId(),
                'status_id' => $status_id_enable
            ]
        ]);
        $recipe_direction = [];
        foreach ($list_step as $item) {
            $recipe_direction[] = [
                'step_number' => $item->getCount(),
                'step_image' => Image::find([
                    'conditions' => 'step_id=:step_id: and status_id=:status_id:',
                    'bind' => [
                        'step_id' => $item->getId(),
                        'status_id' => $status_id_enable
                    ],
                    'order' => 'count_step ASC'
                ]),
                'step_dec' => $item->getDescription(),

            ];
        }

        $list_category = RecipeCategory::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook->getId(),
                'status_id' => $status_id_enable
            ]
        ]);
        $list_recipe_category = '';
        foreach ($list_category as $item2) {
            $list_recipe_category .= $item2->category->getName() . ',';
        }
        if ($list_recipe_category != null || $list_recipe_category != '') {
            $list_recipe_category = substr($list_recipe_category, 0, -1);
        }
        $favourite = Bookmark::findFirst([
            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id,
                'recipe_cook_id' => $recipe_cook_id,
                'bookmark_type' => 'favourite',
                'status_id' => $status_id_enable
            ]
        ]);
        $bookmark = Bookmark::findFirst([
            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id,
                'recipe_cook_id' => $recipe_cook_id,
                'bookmark_type' => 'bookmark',
                'status_id' => $status_id_enable
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
        $user_info = [
            'user_id' => $recipe_cook->user->getId(),
            'name' => $recipe_cook->user->getUserName(),
            'image' => $recipe_cook->user->image->getImageUrl()
        ];
        $list = [
            'id' => $recipe_cook->getId(),
            'name' => $recipe_cook->getName(),
            'time' => $recipe_cook->getTimeDo(),
            'category' => $list_recipe_category,
            'image' => $recipe_cook->image->getImageUrl(),
            'views' => SeenRecipe::count(['conditions' => 'recipe_cook_id=:recipe_cook_id:', 'bind' => ['recipe_cook_id' => $recipe_cook_id]]),
            'like' => $like,
            'rate' => SpamRecipe::average([
                'column' => 'point',
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and type=:type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'type' => 'rate'
                ]
            ]),
            'bookmark' => $bookmark,
            'link_video' => $recipe_cook->getLinkVideo(),
            'link_share' => $recipe_cook->getLinkShare(),
            'level' => $recipe_cook->getLevel(),
            'user_name' => $recipe_cook->user->getUserName(),
            'user_avata' => $recipe_cook->user->image->getImageUrl(),
            'recipe_ingredients' => $recipe_ingredients,
            'recipe_direction' => $recipe_direction,
            'user' => $user_info
        ];
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

    protected function getCommentRecipe($recipe_cook_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'id=:id: and status_id=:status_id:',
            'bind' => [
                'id' => $recipe_cook_id,
                'status_id' => $status_id_enable
            ]
        ]);
        $list = [];
        $list_comment = Comment::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook->getId()
            ],
            'order' => 'created_time DESC'
        ]);
        foreach ($list_comment as $item) {
            $list[] = [
                'id' => $item->getId(),
                'comment_father_id' => $item->getParentPath(),
                'user_id' => $item->user->getId(),
                'user_name' => $item->user->getUserName(),
                'user_avata' => $item->user->image->getImageUrl(),
                'content' => $item->getComment(),
                'time' => $item->getCreatedTime()
            ];
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

    protected function getBookmarkRecipe($user_id, $recipe_cook_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $this->view->disable();
        $post = $this->request->getPost();
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'id=:id: and status_id=:status_id:',
            'bind' => [
                'id' => $recipe_cook_id,
                'status_id' => $status_id_enable
            ]
        ]);
        $auth_site_home = $this->auth->getAuthSiteHome();
        $bookmark = Bookmark::findFirst([
            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type:',
            'bind' => [
                'user_id' => $user_id,
                'recipe_cook_id' => $recipe_cook_id,
                'bookmark_type' => 'bookmark'
            ]
        ]);
        if ($bookmark) {
            if ($bookmark->getStatusId() == $status_id_disable) {
                $bookmark->setStatusId($status_id_enable);
                $bookmark->setBookmarkType('bookmark');
                $bookmark->save();
                $bookmarktotal = Bookmark::count([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                    'bind' => [
                        'recipe_cook_id' => $recipe_cook_id,
                        'bookmark_type' => 'bookmark',
                        'status_id' => $status_id_enable
                    ]
                ]);
                $list = [
                    'code' => 1,
                    'message' => 'bookmark',
                    'totalbookmark' => $bookmarktotal,
                ];
            } else {
                $bookmark->setStatusId($status_id_disable);
                $bookmark->setBookmarkType('bookmark');
                $bookmark->save();
                $bookmarktotal = Bookmark::count([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                    'bind' => [
                        'recipe_cook_id' => $recipe_cook_id,
                        'bookmark_type' => 'bookmark',
                        'status_id' => $status_id_enable
                    ]
                ]);
                $list = [
                    'code' => 2,
                    'message' => 'quit bookmark',
                    'totalbookmark' => $bookmarktotal,
                ];
            }
        } else {
            $bookmark = new Bookmark();
            $bookmark->setId($bookmark->getSequenceId());
            $bookmark->setUserId($user_id);
            $bookmark->setRecipeCookId($recipe_cook_id);
            $bookmark->setStatusId($status_id_enable);
            $bookmark->setBookmarkType('bookmark');
            $bookmark->save();
            $bookmarktotal = Bookmark::count([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook_id,
                    'bookmark_type' => 'bookmark',
                    'status_id' => $status_id_enable
                ]
            ]);

            $list = [
                'code' => 1,
                'message' => 'bookmark',
                'totalbookmark' => $bookmarktotal,
            ];

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

    protected function getSendCommentRecipe()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $infomation = json_decode(file_get_contents('php://input'), true);
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        $comment = new Comment();
        $comment->setId($comment->getSequenceId());
        $comment->setUserId($infomation['user_id']);
        $comment->setRecipeCookId($infomation['recipe_id']);
        $comment->setComment($infomation['message']);
        if ($infomation['comment_id'] == "null" || empty($infomation['comment_id']) || $infomation['comment_id'] == null) {
            $comment->setParentPath('null');
        } else {
            $comment->setParentPath($infomation['comment_id']);
        }

        $comment->save();
        $id = $comment->getId();
        if ($comment->save()) {
            $list = [
                'code' => 1,
                'message' => 'Gửi bình luận thành công',
                'id' => $id
            ];
        } else {
            $list = [
                'code' => 2,
                'message' => 'Gửi bình luận không thành công'
            ];
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

    protected function getRecipePopular($user_id)
    {
        $date_now = date('Y-m-d G:i:s');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $format = $this->request->getQuery('format', null, 'json');
        $seen_recipe = SeenRecipe::find([
            'order' => "created_time DESC"
        ]);
        $list_seen_popular = [];
        foreach ($seen_recipe as $item) {
            if (count($list_seen_popular) != 6) {
                if ($item->recipe->getStatusId() == $status_id_enable) {
                    // $list_seen_popular[$item->getRecipeCookId()] = $item;
                    $demo = date('Y-m-d H:i:s', (strtotime($date_now) - 2692000));
                    $list_seen_popular[$item->getRecipeCookId()] = SeenRecipe::count([
                        'conditions' => 'created_time> :created_time: and recipe_cook_id=:recipe_cook_id:',
                        'bind' => [
                            'created_time' => date('Y-m-d H:i:s', (strtotime($date_now) - 2692000)),
                            'recipe_cook_id' => $item->getRecipeCookId()
                        ]
                    ]);
                }

            } else {
                break;
            }
        }
        arsort($list_seen_popular);
        foreach ($list_seen_popular as $index => $item) {
            $list_seen_popular[$index] = SeenRecipe::findFirst([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $index
                ]
            ]);
        }
        $list = [];
        foreach ($list_seen_popular as $item) {
            $recipecategory = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $item->getRecipeCookId(),
                    'status_id' => $status_id_enable
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
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
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
            if ($item->recipe->getStatusId() == $status_id_enable) {
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
                $list[] = [
                    'id' => $item->recipe->getId(),
                    'name' => $item->recipe->getName(),
                    'category' => $list_recipe_category,
                    'image' => $item->recipe->image->getImageUrl(),
                    'views' => $seen_recipe,
                    'times' => $item->recipe->getTimeDo(),
                    'like' => $like,
                    'bookmark' => $bookmark,
                    'link_video' => $item->recipe->getLinkVideo(),
                    'link_share' => $item->recipe->getLinkShare(),
                ];
            }

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

    protected function getRecipeByBookmarkUser($user_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $format = $this->request->getQuery('format', null, 'json');
        $list_user = BookmarkUser::find([
            'conditions' => 'user_id=:user_id: and status_id=:status_id: and type=:type:',
            'bind' => [
                'user_id' => $user_id,
                'status_id' => $status_id_enable,
                'type' => 'bookmark_user'
            ]
        ]);
        $list_user_id = [];
        foreach ($list_user as $item) {
            $list_user_id[] = $item->getBookmarkUserId();

        }
        if (count($list_user_id) != 0) {
            $rs = RecipeCook::query()
                ->columns("Daudau\Common\Models\Recipe\RecipeCook.*")
                ->where("Daudau\Common\Models\Recipe\RecipeCook.user_id IN (" . implode(',', $list_user_id) . ")")
                ->andWhere("Daudau\Common\Models\Recipe\RecipeCook.status_id=4");
            $sid = $rs->execute();
            $list = [];
            foreach ($sid as $item) {
                $recipecategory = RecipeCategory::find([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getId()
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
                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getId()
                    ]
                ]);
                $favourite = Bookmark::findFirst([
                    'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                    'bind' => [
                        'user_id' => $user_id,
                        'bookmark_type' => 'favourite',
                        'status_id' => $status_id_enable,
                        'recipe_cook_id' => $item->getId()
                    ]
                ]);
                $bookmark = Bookmark::findFirst([
                    'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                    'bind' => [
                        'user_id' => $user_id,
                        'bookmark_type' => 'bookmark',
                        'status_id' => $status_id_enable,
                        'recipe_cook_id' => $item->getId()
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
                $list[] = [
                    'id' => $item->getId(),
                    'name' => $item->getName(),
                    'category' => $list_recipe_category,
                    'image' => $item->image->getImageUrl(),
                    'views' => $seen_recipe,
                    'times' => $item->getTimeDo(),
                    'like' => $like,
                    'bookmark' => $bookmark,
                    'link_video' => $item->getLinkVideo(),
                    'link_share' => $item->getLinkShare(),
                ];
            }
        } else {
            $list = [];
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

    protected function getSeenRecipe($user_id, $recipe_cook_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_reject = Status::getStatusIdByCode('reject');
        $status_id_old = Status::getStatusIdByCode('old');
        $format = $this->request->getQuery('format', null, 'json');
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'id=:id: AND status_id!=:status_id_disable: AND status_id!=:status_id_reject: AND status_id!=:status_id_old: ',
            'bind' => [
                'id' => $recipe_cook_id,
                'status_id_disable' => $status_id_disable,
                'status_id_reject' => $status_id_reject,
                'status_id_old' => $status_id_old,

            ]
        ]);
        $seen_recipe = SeenRecipe::findFirst([
            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook_id,
                'user_id' => $user_id
            ]
        ]);
        if (!$seen_recipe) {
            $seen_recipe = new SeenRecipe();
            $seen_recipe->setId($seen_recipe->getSequenceId());
            $seen_recipe->setUserId($user_id);
            $seen_recipe->setRecipeCookId($recipe_cook_id);
            $recipe_cook->setSeenTotal($recipe_cook->getSeenTotal() + 1);
            $recipe_cook->save();
            $seen_recipe->save();
        } else {

        }
        $list = [
            'code' => 1,
            'message' => 'Xem thành công'
        ];

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

    protected function getSearchRecipe($user_id, $code_search)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $value = $code_search;
        $format = $this->request->getQuery('format', null, 'json');
        $raw_url_encode = urlencode($value);
        $value = preg_replace('([\s]+)', ' ', $value);
        $value = $this->helper->util()->convert_vi_to_en($value);
        $value = strtolower($value);
        $value = explode(' ', $value);
        $category = Category::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_enable
            ]
        ]);
        $list = [];
        $list_category = [];
        foreach ($category as $item) {
            $code_category = explode('-', $item->getCode());
            foreach ($code_category as $item2) {
                if (in_array(strtolower($item2), $value)) {
                    $list_category[$item->getId()] = $item->getId();
                }
            }
        }
        if (count($list_category) != 0) {
            $list_recipe = [];
            foreach ($list_category as $item) {
                $recipe_category = RecipeCategory::find([
                    'conditions' => 'category_id=:category_id: and status_id=:status_id:',
                    'bind' => [
                        'category_id' => $item,
                        'status_id' => $status_id_enable
                    ]
                ]);
                if (count($recipe_category) == 0) {

                } else {
                    foreach ($recipe_category as $item) {
                        $list_recipe[] = $item->getRecipeCookId();
                    }
                    $check = 0;
                    foreach ($list_recipe as $item) {
                        $recipe = RecipeCook::findFirst([
                            'conditions' => 'id=:id: and status_id=:status_id:',
                            'bind' => [
                                'id' => $item,
                                'status_id' => $status_id_enable
                            ]
                        ]);
                        $recipe_code = $recipe->getCode();
                        $recipe_code = explode('-', $recipe_code);
                        foreach ($recipe_code as $item2) {
                            if (in_array(strtolower($item2), $value)) {
                                $check = 1;
                                $recipecategory = RecipeCategory::find([
                                    'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                                    'bind' => [
                                        'recipe_cook_id' => $recipe->getId(),
                                        'status_id' => $status_id_enable
                                    ]
                                ]);
                                $list_recipe_category = '';
                                foreach ($recipecategory as $item9) {
                                    $list_recipe_category .= $item9->category->getName() . ',';
                                }
                                if ($list_recipe_category != null || $list_recipe_category != '') {
                                    $list_recipe_category = substr($list_recipe_category, 0, -1);
                                }
                                $favourite = Bookmark::findFirst([
                                    'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                    'bind' => [
                                        'user_id' => $user_id,
                                        'recipe_cook_id' => $recipe->getId(),
                                        'bookmark_type' => 'favourite',
                                        'status_id' => $status_id_enable
                                    ]
                                ]);
                                $bookmark = Bookmark::findFirst([
                                    'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                    'bind' => [
                                        'user_id' => $user_id,
                                        'recipe_cook_id' => $recipe->getId(),
                                        'bookmark_type' => 'bookmark',
                                        'status_id' => $status_id_enable
                                    ]
                                ]);
                                if ($favourite) {
                                    $favourite = 'true';
                                } else {
                                    $favourite = 'false';
                                }
                                if ($bookmark) {
                                    $bookmark = 'true';
                                } else {
                                    $bookmark = 'false';
                                }
                                $list[$recipe->getId()] = [
                                    'id' => $recipe->getId(),
                                    'name' => $recipe->getName(),
                                    'category' => $list_recipe_category,
                                    'image' => $recipe->image->getImageUrl(),
                                    'view' => SeenRecipe::count([
                                        'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                        'bind' => [
                                            'recipe_cook_id' => $recipe->getId()
                                        ]
                                    ]),
                                    'times' => $recipe->getTimeDo(),
                                    'like' => $favourite,
                                    'bookmark' => $bookmark
                                ];
                            }
                        }
                        $recipe_material = RecipeMaterial::find([
                            'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                            'bind' => [
                                'recipe_cook_id' => $recipe->getId(),
                                'status_id' => $status_id_enable
                            ]
                        ]);
                        foreach ($recipe_material as $item3) {
                            $code_recipe_material = explode('-', $item3->rawmaterial->getCode());
                            foreach ($code_recipe_material as $item4) {
                                if (in_array(strtolower($item4), $value)) {
                                    $check = 1;
                                    $recipecategory = RecipeCategory::find([
                                        'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                                        'bind' => [
                                            'recipe_cook_id' => $recipe->getId(),
                                            'status_id' => $status_id_enable
                                        ]
                                    ]);
                                    $list_recipe_category = '';
                                    foreach ($recipecategory as $item9) {
                                        $list_recipe_category .= $item9->category->getName() . ',';
                                    }
                                    if ($list_recipe_category != null || $list_recipe_category != '') {
                                        $list_recipe_category = substr($list_recipe_category, 0, -1);
                                    }
                                    $favourite = Bookmark::findFirst([
                                        'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                        'bind' => [
                                            'user_id' => $user_id,
                                            'recipe_cook_id' => $recipe->getId(),
                                            'bookmark_type' => 'favourite',
                                            'status_id' => $status_id_enable
                                        ]
                                    ]);
                                    $bookmark = Bookmark::findFirst([
                                        'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                        'bind' => [
                                            'user_id' => $user_id,
                                            'recipe_cook_id' => $recipe->getId(),
                                            'bookmark_type' => 'bookmark',
                                            'status_id' => $status_id_enable
                                        ]
                                    ]);
                                    if ($favourite) {
                                        $favourite = 'true';
                                    } else {
                                        $favourite = 'false';
                                    }
                                    if ($bookmark) {
                                        $bookmark = 'true';
                                    } else {
                                        $bookmark = 'false';
                                    }
                                    $list[$recipe->getId()] = [
                                        'id' => $recipe->getId(),
                                        'name' => $recipe->getName(),
                                        'category' => $list_recipe_category,
                                        'image' => $recipe->image->getImageUrl(),
                                        'view' => SeenRecipe::count([
                                            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                            'bind' => [
                                                'recipe_cook_id' => $recipe->getId()
                                            ]
                                        ]),
                                        'times' => $recipe->getTimeDo(),
                                        'like' => $favourite,
                                        'bookmark' => $bookmark
                                    ];
                                }
                            }
                        }

                    }
                    if ($check == 0) {
                        foreach ($list_recipe as $item) {
                            $recipe = RecipeCook::findFirst([
                                'conditions' => 'id=:id: and status_id=:status_id:',
                                'bind' => [
                                    'id' => $item,
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $recipecategory = RecipeCategory::find([
                                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                                'bind' => [
                                    'recipe_cook_id' => $recipe->getId(),
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $list_recipe_category = '';
                            foreach ($recipecategory as $item9) {
                                $list_recipe_category .= $item9->category->getName() . ',';
                            }
                            if ($list_recipe_category != null || $list_recipe_category != '') {
                                $list_recipe_category = substr($list_recipe_category, 0, -1);
                            }
                            $favourite = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $recipe->getId(),
                                    'bookmark_type' => 'favourite',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $bookmark = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $recipe->getId(),
                                    'bookmark_type' => 'bookmark',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            if ($favourite) {
                                $favourite = 'true';
                            } else {
                                $favourite = 'false';
                            }
                            if ($bookmark) {
                                $bookmark = 'true';
                            } else {
                                $bookmark = 'false';
                            }
                            $list[$recipe->getId()] = [
                                'id' => $recipe->getId(),
                                'name' => $recipe->getName(),
                                'category' => $list_recipe_category,
                                'image' => $recipe->image->getImageUrl(),
                                'view' => SeenRecipe::count([
                                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                    'bind' => [
                                        'recipe_cook_id' => $recipe->getId()
                                    ]
                                ]),
                                'times' => $recipe->getTimeDo(),
                                'like' => $favourite,
                                'bookmark' => $bookmark
                            ];

                        }
                    }
                }
            }

        } else {
            $raw_material = RawMaterial::find();
            $list_raw_material = [];
            if (count($value) > 1) {
                foreach ($raw_material as $item) {
                    if (strtolower($item->getCode()) == implode(' ', $value)) {
                        $list_raw_material[$item->getId()] = $item->getId();
                    }
                }
                if (count($list_raw_material) == 0) {
                    foreach ($raw_material as $item) {
                        $code_raw_material = explode(' ', $item->getCode());
                        foreach ($code_raw_material as $item2) {
                            if (in_array(strtolower($item2), $value)) {
                                $list_raw_material[$item->getId()] = $item->getId();
                            }
                        }
                    }
                    foreach ($list_raw_material as $item) {
                        $recipe_raw_material = RecipeMaterial::find([
                            'conditions' => 'raw_material_id=:raw_material_id:',
                            'bind' => [
                                'raw_material_id' => $item
                            ]
                        ]);
                        foreach ($recipe_raw_material as $item2) {
                            $recipecategory = RecipeCategory::find([
                                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                                'bind' => [
                                    'recipe_cook_id' => $item2->recipe->getId(),
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $list_recipe_category = '';
                            foreach ($recipecategory as $item9) {
                                $list_recipe_category .= $item9->category->getName() . ',';
                            }
                            if ($list_recipe_category != null || $list_recipe_category != '') {
                                $list_recipe_category = substr($list_recipe_category, 0, -1);
                            }
                            $favourite = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $item2->recipe->getId(),
                                    'bookmark_type' => 'favourite',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $bookmark = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $item2->recipe->getId(),
                                    'bookmark_type' => 'bookmark',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            if ($favourite) {
                                $favourite = 'true';
                            } else {
                                $favourite = 'false';
                            }
                            if ($bookmark) {
                                $bookmark = 'true';
                            } else {
                                $bookmark = 'false';
                            }
                            $list[$item2->recipe->getId()] = [
                                'id' => $item2->recipe->getId(),
                                'name' => $item2->recipe->getName(),
                                'category' => $list_recipe_category,
                                'image' => $item2->recipe->image->getImageUrl(),
                                'view' => SeenRecipe::count([
                                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                    'bind' => [
                                        'recipe_cook_id' => $item2->recipe->getId()
                                    ]
                                ]),
                                'times' => $item2->recipe->getTimeDo(),
                                'like' => $favourite,
                                'bookmark' => $bookmark
                            ];
                        }
                    }
                    $recipe = RecipeCook::find();
                    foreach ($recipe as $item) {
                        $code_recipe = explode('-', $item->getCode());
                        foreach ($code_recipe as $item2) {
                            if (in_array(strtolower($item2), $value)) {
                                $recipecategory = RecipeCategory::find([
                                    'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                                    'bind' => [
                                        'recipe_cook_id' => $item->getId(),
                                        'status_id' => $status_id_enable
                                    ]
                                ]);
                                $list_recipe_category = '';
                                foreach ($recipecategory as $item9) {
                                    $list_recipe_category .= $item9->category->getName() . ',';
                                }
                                if ($list_recipe_category != null || $list_recipe_category != '') {
                                    $list_recipe_category = substr($list_recipe_category, 0, -1);
                                }
                                $favourite = Bookmark::findFirst([
                                    'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                    'bind' => [
                                        'user_id' => $user_id,
                                        'recipe_cook_id' => $item->getId(),
                                        'bookmark_type' => 'favourite',
                                        'status_id' => $status_id_enable
                                    ]
                                ]);
                                $bookmark = Bookmark::findFirst([
                                    'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                    'bind' => [
                                        'user_id' => $user_id,
                                        'recipe_cook_id' => $item->getId(),
                                        'bookmark_type' => 'bookmark',
                                        'status_id' => $status_id_enable
                                    ]
                                ]);
                                if ($favourite) {
                                    $favourite = 'true';
                                } else {
                                    $favourite = 'false';
                                }
                                if ($bookmark) {
                                    $bookmark = 'true';
                                } else {
                                    $bookmark = 'false';
                                }
                                $list[$item->getId()] = [
                                    'id' => $item->getId(),
                                    'name' => $item->getName(),
                                    'category' => $list_recipe_category,
                                    'image' => $item->image->getImageUrl(),
                                    'view' => SeenRecipe::count([
                                        'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                        'bind' => [
                                            'recipe_cook_id' => $item->getId()
                                        ]
                                    ]),
                                    'times' => $item->getTimeDo(),
                                    'like' => $favourite,
                                    'bookmark' => $bookmark
                                ];
                            }
                        }
                    }
                } else {
                    foreach ($list_raw_material as $item) {
                        $recipe_raw_material = RecipeMaterial::find([
                            'conditions' => 'raw_material_id=:raw_material_id:',
                            'bind' => [
                                'raw_material_id' => $item
                            ]
                        ]);
                        foreach ($recipe_raw_material as $item2) {
                            $recipecategory = RecipeCategory::find([
                                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                                'bind' => [
                                    'recipe_cook_id' => $item2->recipe->getId(),
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $list_recipe_category = '';
                            foreach ($recipecategory as $item9) {
                                $list_recipe_category .= $item9->category->getName() . ',';
                            }
                            if ($list_recipe_category != null || $list_recipe_category != '') {
                                $list_recipe_category = substr($list_recipe_category, 0, -1);
                            }
                            $favourite = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $item2->recipe->getId(),
                                    'bookmark_type' => 'favourite',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $bookmark = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $item2->recipe->getId(),
                                    'bookmark_type' => 'bookmark',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            if ($favourite) {
                                $favourite = 'true';
                            } else {
                                $favourite = 'false';
                            }
                            if ($bookmark) {
                                $bookmark = 'true';
                            } else {
                                $bookmark = 'false';
                            }
                            $list[$item2->recipe->getId()] = [
                                'id' => $item2->recipe->getId(),
                                'name' => $item2->recipe->getName(),
                                'category' => $list_recipe_category,
                                'image' => $item2->recipe->image->getImageUrl(),
                                'view' => SeenRecipe::count([
                                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                    'bind' => [
                                        'recipe_cook_id' => $item2->recipe->getId()
                                    ]
                                ]),
                                'times' => $item2->recipe->getTimeDo(),
                                'like' => $favourite,
                                'bookmark' => $bookmark
                            ];
                        }
                    }
                }
            } else {
                foreach ($raw_material as $item) {
                    $code_raw_material = explode(' ', $item->getCode());
                    foreach ($code_raw_material as $item2) {
                        if (in_array(strtolower($item2), $value)) {
                            $list_raw_material[$item->getId()] = $item->getId();
                        }
                    }
                }
                foreach ($list_raw_material as $item) {
                    $recipe_raw_material = RecipeMaterial::find([
                        'conditions' => 'raw_material_id=:raw_material_id:',
                        'bind' => [
                            'raw_material_id' => $item
                        ]
                    ]);
                    foreach ($recipe_raw_material as $item2) {
                        $recipecategory = RecipeCategory::find([
                            'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                            'bind' => [
                                'recipe_cook_id' => $item2->recipe->getId(),
                                'status_id' => $status_id_enable
                            ]
                        ]);
                        $list_recipe_category = '';
                        foreach ($recipecategory as $item9) {
                            $list_recipe_category .= $item9->category->getName() . ',';
                        }
                        if ($list_recipe_category != null || $list_recipe_category != '') {
                            $list_recipe_category = substr($list_recipe_category, 0, -1);
                        }
                        $favourite = Bookmark::findFirst([
                            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                            'bind' => [
                                'user_id' => $user_id,
                                'recipe_cook_id' => $item2->recipe->getId(),
                                'bookmark_type' => 'favourite',
                                'status_id' => $status_id_enable
                            ]
                        ]);
                        $bookmark = Bookmark::findFirst([
                            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                            'bind' => [
                                'user_id' => $user_id,
                                'recipe_cook_id' => $item2->recipe->getId(),
                                'bookmark_type' => 'bookmark',
                                'status_id' => $status_id_enable
                            ]
                        ]);
                        if ($favourite) {
                            $favourite = 'true';
                        } else {
                            $favourite = 'false';
                        }
                        if ($bookmark) {
                            $bookmark = 'true';
                        } else {
                            $bookmark = 'false';
                        }
                        $list[$item2->recipe->getId()] = [
                            'id' => $item2->recipe->getId(),
                            'name' => $item2->recipe->getName(),
                            'category' => $list_recipe_category,
                            'image' => $item2->recipe->image->getImageUrl(),
                            'view' => SeenRecipe::count([
                                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                'bind' => [
                                    'recipe_cook_id' => $item2->recipe->getId()
                                ]
                            ]),
                            'times' => $item2->recipe->getTimeDo(),
                            'like' => $favourite,
                            'bookmark' => $bookmark
                        ];
                    }
                }
                $recipe = RecipeCook::find();
                foreach ($recipe as $item) {
                    $code_recipe = explode('-', $item->getCode());
                    foreach ($code_recipe as $item2) {
                        if (in_array(strtolower($item2), $value)) {
                            $recipecategory = RecipeCategory::find([
                                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                                'bind' => [
                                    'recipe_cook_id' => $item->getId(),
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $list_recipe_category = '';
                            foreach ($recipecategory as $item9) {
                                $list_recipe_category .= $item9->category->getName() . ',';
                            }
                            if ($list_recipe_category != null || $list_recipe_category != '') {
                                $list_recipe_category = substr($list_recipe_category, 0, -1);
                            }
                            $favourite = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $item->getId(),
                                    'bookmark_type' => 'favourite',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            $bookmark = Bookmark::findFirst([
                                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and bookmark_type=:bookmark_type: and status_id=:status_id:',
                                'bind' => [
                                    'user_id' => $user_id,
                                    'recipe_cook_id' => $item->getId(),
                                    'bookmark_type' => 'bookmark',
                                    'status_id' => $status_id_enable
                                ]
                            ]);
                            if ($favourite) {
                                $favourite = 'true';
                            } else {
                                $favourite = 'false';
                            }
                            if ($bookmark) {
                                $bookmark = 'true';
                            } else {
                                $bookmark = 'false';
                            }
                            $list[$item->getId()] = [
                                'id' => $item->getId(),
                                'name' => $item->getName(),
                                'category' => $list_recipe_category,
                                'image' => $item->image->getImageUrl(),
                                'view' => SeenRecipe::count([
                                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                                    'bind' => [
                                        'recipe_cook_id' => $item->getId()
                                    ]
                                ]),
                                'times' => $item->getTimeDo(),
                                'like' => $favourite,
                                'bookmark' => $bookmark
                            ];
                        }
                    }
                }
            }

        }
//        $list2=[];
//        foreach ($list as $item)
//        {
//            $list2[]= $item;
//        }
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

    protected function getRateRecipe($point, $user_id, $recipe_cook_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $rate_recipe = SpamRecipe::findFirst([
            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and type=:type:',
            'bind' => [
                'user_id' => $user_id,
                'recipe_cook_id' => $recipe_cook_id,
                'type' => 'rate'
            ]
        ]);
        if ($rate_recipe) {
            $rate_recipe->setPoint($point);
            $rate_recipe->save();
            $total = SpamRecipe::average([
                'column' => 'point',
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and type=:type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook_id,
                    'type' => 'rate'
                ]
            ]);
            $list =
                [
                    'value' => $total,
                ];

        } else {
            $rate_recipe = new SpamRecipe();
            $rate_recipe->setId($rate_recipe->getSequenceId());
            $rate_recipe->setUserId($user_id);
            $rate_recipe->setRecipeCookId($recipe_cook_id);
            // $rate_recipe->setStatusId($status_id_enable);
            $rate_recipe->setType('rate');
            $rate_recipe->setPoint($point);
            $rate_recipe->save();
            $total = SpamRecipe::average([
                'column' => 'point',
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and type=:type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook_id,
                    'type' => 'rate'
                ]
            ]);
            $list =
                [
                    'value' => $total
                ];
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

