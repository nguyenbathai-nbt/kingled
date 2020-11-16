<?php

namespace Daudau\Modules\Recipecook\Controllers;

use Daudau\Common\Models\Bookmark\Category;
use Daudau\Common\Models\Recipe\RawMaterial;
use Daudau\Common\Models\Recipe\RecipeCategory;
use Daudau\Common\Models\Recipe\RecipeCook;
use Daudau\Common\Models\Recipe\RecipeMaterial;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Mvc\Controller;

class MakeController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->view->stylesheetsother = [
            "/public/css/recipe.css",
        ];
        $this->view->scriptsother = [

        ];
    }

    public function indexAction()
    {
        $st = $this->request->getQuery('st');
        $list = $this->SearchRecipeAction($st);
        $auth_site_home = $this->auth->getAuthSiteHome();
        $list_recipe = [];
        foreach ($list as $item) {
            $recipe = RecipeCook::findFirst([
                'conditions' => 'code=:code:',
                'bind' => [
                    'code' => $item['code']
                ]
            ]);
            $list_recipe[] = $recipe;
        }
        $this->view->st=$st;
        $this->view->list_recipe = $list_recipe;
        $this->view->auth_site_home = $auth_site_home;
        $this->view->count_list_recipe = count($list_recipe);
    }

    public function infoAction($id)
    {
        $ids = $id;
        var_dump($this->request->getQuery());
        die();
    }

    public function SearchRecipeAction($url)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $value = $url;
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
                            if (in_array($item2, $value)) {
                                $check = 1;
                                $list[$recipe->getId()] = [
                                    'name' => $recipe->getName(),
                                    'image' => $recipe->image->getImageBase(),
                                    'time' => $recipe->getTimeDo(),
                                    'code' => $recipe->getCode()
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
                                    $list[$recipe->getId()] = [
                                        'name' => $recipe->getName(),
                                        'image' => $recipe->image->getImageBase(),
                                        'time' => $recipe->getTimeDo(),
                                        'code' => $recipe->getCode(),
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
                            $list[$recipe->getId()] = [
                                'name' => $recipe->getName(),
                                'image' => $recipe->image->getImageBase(),
                                'time' => $recipe->getTimeDo(),
                                'code' => $recipe->getCode()
                            ];

                        }
                    }
                }
            }

        } else {
            $raw_material = RawMaterial::find();
            $list_raw_material = [];
           if(count($value)>1){
               foreach ($raw_material as $item) {
                   if (strtolower($item->getCode())== implode(' ',$value)) {
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
                           $list[$item2->recipe->getId()] = [
                               'name' => $item2->recipe->getName(),
                               'image' => $item2->recipe->image->getImageBase(),
                               'time' => $item2->recipe->getTimeDo(),
                               'code' => $item2->recipe->getCode(),

                           ];
                       }
                   }
                   $recipe = RecipeCook::find();
                   foreach ($recipe as $item) {
                       $code_recipe = explode('-', $item->getCode());
                       foreach ($code_recipe as $item2) {
                           if (in_array(strtolower($item2), $value)) {
                               $list[$item->getId()] = [
                                   'name' => $item->getName(),
                                   'image' => $item->image->getImageBase(),
                                   'time' => $item->getTimeDo(),
                                   'code' => $item->getCode(),

                               ];
                           }
                       }
                   }
               }else{
                   foreach ($list_raw_material as $item) {
                       $recipe_raw_material = RecipeMaterial::find([
                           'conditions' => 'raw_material_id=:raw_material_id:',
                           'bind' => [
                               'raw_material_id' => $item
                           ]
                       ]);
                       foreach ($recipe_raw_material as $item2) {
                           $list[$item2->recipe->getId()] = [
                               'name' => $item2->recipe->getName(),
                               'image' => $item2->recipe->image->getImageBase(),
                               'time' => $item2->recipe->getTimeDo(),
                               'code' => $item2->recipe->getCode(),

                           ];
                       }
                   }
               }
           }else{
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
                       $list[$item2->recipe->getId()] = [
                           'name' => $item2->recipe->getName(),
                           'image' => $item2->recipe->image->getImageBase(),
                           'time' => $item2->recipe->getTimeDo(),
                           'code' => $item2->recipe->getCode(),

                       ];
                   }
               }
               $recipe = RecipeCook::find();
               foreach ($recipe as $item) {
                   $code_recipe = explode('-', $item->getCode());
                   foreach ($code_recipe as $item2) {
                       if (in_array(strtolower($item2), $value)) {
                           $list[$item->getId()] = [
                               'name' => $item->getName(),
                               'image' => $item->image->getImageBase(),
                               'time' => $item->getTimeDo(),
                               'code' => $item->getCode(),

                           ];
                       }
                   }
               }
           }
        }
        return $list;

    }


}

