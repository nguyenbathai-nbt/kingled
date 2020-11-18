<?php

namespace Daudau\Modules\Recipecook\Controllers;

use Daudau\Common\Models\Bookmark\Bookmark;
use Daudau\Common\Models\Bookmark\BookmarkUser;
use Daudau\Common\Models\Bookmark\Category;
use Daudau\Common\Models\Bookmark\CategoryType;
use Daudau\Common\Models\Recipe\Comment;
use Daudau\Common\Models\Recipe\Image;
use Daudau\Common\Models\Recipe\Quantitative;
use Daudau\Common\Models\Recipe\RawMaterial;
use Daudau\Common\Models\Recipe\RecipeCategory;
use Daudau\Common\Models\Recipe\RecipeCook;
use Daudau\Common\Models\Recipe\RecipeMaterial;
use Daudau\Common\Models\Recipe\SeenRecipe;
use Daudau\Common\Models\Recipe\SpamRecipe;
use Daudau\Common\Models\Recipe\Step;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Daudau\Common\Mvc\Controller;
use Daudau\Modules\Recipecook\Forms\IndexForm;

class IndexController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->view->stylesheetsother = [
            "/public/css/recipe.create.min.css",
        ];
        $this->view->scriptsother = [

        ];
    }

    public function indexAction()
    {
        $slug = $this->dispatcher->getParam('slug');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_reject = Status::getStatusIdByCode('reject');
        $status_id_old = Status::getStatusIdByCode('old');
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'code=:code: AND status_id!=:status_id_disable: AND status_id!=:status_id_reject: AND status_id!=:status_id_old: ',
            'bind' => [
                'code' => $slug,
                'status_id_disable' => $status_id_disable,
                'status_id_reject' => $status_id_reject,
                'status_id_old' => $status_id_old,

            ]
        ]);
        $this->checkSeenRecipeAction($recipe_cook);
        if (!$recipe_cook) {
            $this->view->find_recipe = 'false';
        } else {
            if ($recipe_cook->getStatusId() == $status_id_enable) {
                $this->view->find_recipe = 'true';

            } else {
                $this->view->find_recipe = 'confirm';
            }
            $list_category_by_recipe=RecipeCategory::find([
                'conditions'=>'recipe_cook_id=:recipe_cook_id:',
                'bind'=>[
                    'recipe_cook_id'=>$recipe_cook->getId()
                ]
            ]);
            $list_recipe=[];
            foreach($list_category_by_recipe as $item)
            {
                    $value=RecipeCategory::find([
                        'conditions'=>'category_id=:category_id:',
                        'bind'=>[
                            'category_id'=>$item->getCategoryId()
                        ]
                    ]);
                    foreach ($value as $item2)
                    {
                        if(count($list_recipe)==4) {
                            break;
                        }else {
                            $list_recipe[$item2->getRecipeCookId()] = RecipeCook::findFirst([
                                'conditions' => 'id=:id:',
                                'bind' => [
                                    'id' => $item2->getRecipeCookId()
                                ]
                            ]);
                        }
                    }
            }
            $this->view->list_recipe= $list_recipe;
            $auth_site_home = $this->auth->getAuthSiteHome();
            $favourite = Bookmark::findFirst([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'user_id' => $auth_site_home['id'],
                    'status_id' => $status_id_enable,
                    'bookmark_type' => 'favourite'

                ]
            ]);
            if ($favourite) {
                $this->view->favourite = true;
            } else {
                $this->view->favourite = false;
            }
            $bookmark = Bookmark::findFirst([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'user_id' => $auth_site_home['id'],
                    'status_id' => $status_id_enable,
                    'bookmark_type' => 'bookmark'

                ]
            ]);
            if ($bookmark) {
                $this->view->bookmark = true;
            } else {
                $this->view->bookmark = false;
            }
            $total_recipe_favourite = Bookmark::count([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'status_id' => $status_id_enable,
                    'bookmark_type' => 'favourite'
                ]
            ]);
            $total_recipe_bookmark = Bookmark::count([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'status_id' => $status_id_enable,
                    'bookmark_type' => 'bookmark'
                ]
            ]);
            $list_recipe_material = RecipeMaterial::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            $list_step = Step::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'status_id' => $status_id_enable
                ],
                'order' => 'count ASC'
            ]);
            $list_category = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            $list_comment = Comment::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and parent_path=:parent_path: or parent_path=""',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'parent_path' => 'null'
                ],
                'order' => 'created_time DESC'
            ]);
            $array_list_comment = [];
            foreach ($list_comment as $value) {
                $list_respone = Comment::find([
                    'conditions' => 'parent_path=:parent_path:',
                    'bind' => [
                        'parent_path' => $value->getId()
                    ],
                    'order' => 'created_time ASC'
                ]);
                if (count($list_respone) == 0) {
                    $array_list_comment[$value->getId()][] = null;
                } else {
                    $array_list_comment[$value->getId()][] = $list_respone;
                }

            }

            $user = Users::findFirst([
                'conditions' => 'id=:id:',
                'bind' => [
                    'id' => $auth_site_home['id']
                ]
            ]);
            $spam_recipe = SpamRecipe::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and type=:type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'type' => 'spam'
                ],
                'order' => 'created_time DESC'
            ]);

            $total_spam_recipe = count($spam_recipe);
            if ($auth_site_home['id'] == $recipe_cook->getUserId()) {
                $check_btn_bookmark = 'false';
            } else {
                $check_btn_bookmark = 'true';
            }
            $bookmark_user = BookmarkUser::findFirst([
                'conditions' => 'user_id=:user_id: and bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'user_id' => $auth_site_home['id'],
                    'bookmark_user_id' => $recipe_cook->getUserId(),
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            if ($bookmark_user) {
                $this->view->bookmark_user = 'true';
            } else {
                $this->view->bookmark_user = 'false';
            }

            if ($auth_site_home == null) {
                $this->view->auth_site_home = [
                    'id' => '""'
                ];
            } else {
                $this->view->auth_site_home = $auth_site_home;
            }
            $stepImage = Image::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ],
                'order' => 'recipe_cook_id ASC, step_id ASC, count_step ASC'
            ]);
            $list_step_image = [];
            foreach ($stepImage as $item) {
                $list_step_image[$item->getRecipeCookId()][$item->getStepId()][$item->getCountStep()] = $item;
            }

            $total_rate_recipe = SpamRecipe::count([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and  type=:type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'type' => 'rate'
                ]
            ]);

            $rate_recipe = SpamRecipe::average([
                'column' => 'point',
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and  type=:type:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'type' => 'rate'
                ]
            ]);
            if ($rate_recipe == null) {
                $this->view->rate_recipe = 0;
            } else {
                $this->view->rate_recipe = $rate_recipe;
            }
            $this->view->total_rate_recipe = $total_rate_recipe;
            $this->view->list_step_image = $list_step_image;
            $this->view->check_btn_bookmark = $check_btn_bookmark;
            $this->view->total_recipe_favourite = $total_recipe_favourite;
            $this->view->total_recipe_bookmark = $total_recipe_bookmark;
            $this->view->total_spam_recipe = $total_spam_recipe;
            $this->view->spam_recipe = $spam_recipe;
            $this->view->list_comment = $list_comment;
            $this->view->array_list_comment = $array_list_comment;
            $this->view->recipe_cook_id = $recipe_cook->getId();
            $this->view->recipe_cook = $recipe_cook;
            $this->view->list_step = $list_step;
            $this->view->list_category = $list_category;
            $this->view->list_recipe_material = $list_recipe_material;
            $this->view->count_list_recipe_material = count($list_recipe_material);
        }
    }

    public function createAction()
    {
        $form = new IndexForm();
        $form->create();
        $this->db->begin();
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_confirm = Status::getStatusIdByCode('confirm');
        $auth_site_home = $this->auth->getAuthSiteHome();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            foreach ($post as $index => $item) {
                if (is_array($item)) {
                    foreach ($item as $index2 => $item2) {
                        $post[$index][$index2] = trim($item2);
                    }
                } else {
                    $post[$index] = trim($item);
                }
            }
            $file = $_FILES['image-logo']['tmp_name'];
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $image_type = $finfo->file($_FILES['image-logo']['tmp_name']);
            $recipe_cook = new RecipeCook();
            $recipe_cook->setId($recipe_cook->getSequenceId());
            $recipe_cook->setName($post['name-recipe']);
            $post['name-recipe'] = strtolower($post['name-recipe']);
            $post['name-recipe'] = $this->helper->util()->convert_vi_to_en($post['name-recipe']);
            $code_recipe = str_replace(' ', '-', $post['name-recipe']);
            $recipe_cook->setCode($code_recipe . '-' . $recipe_cook->getId());
            $recipe_cook->setDescription($post['description-recipe']);
            $recipe_cook->setLevel($post['level']);
            $recipe_cook->setTimeDo($post['time_do']);
            $recipe_cook->setStatusId($status_id_confirm);
            $recipe_cook->setSeenTotal(0);
            $recipe_cook->setLinkVideo('https://www.youtube.com/embed/' . $post['link-video']);
            $recipe_cook->setLinkShare('http://' . $_SERVER['HTTP_HOST'] . '/cong-thuc/' . $recipe_cook->getCode() . 'html');
            $recipe_cook->setBookmarkTotal(0);
            $recipe_cook->setUserId($auth_site_home['id']);
            if (($image_type == "image/png" || $image_type == "image/svg+xml" || $image_type == "image/svg" || $image_type == "image/jpeg")) {
                move_uploaded_file($_FILES['image-logo']['tmp_name'], BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name']);
                $img = $this->helper->resize_image(BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name'], 300, 300, $image_type);
                if ($image_type == "image/png") {
                    imagepng($img, BASE_PATH . "/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                } else {
                    imagejpeg($img, BASE_PATH . "/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                }
                $image = new Image();
                $image->setId($image->getSequenceId());
                $image->setCode('IMAGE_LOGO_RECIPE_COOK_' . $recipe_cook->getId());
                $image_base = base64_encode(file_get_contents(BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name']));
                $image->setImageBase('data:' . $image_type . ';base64,' . $image_base);
                $image->setImageUrl("/public/image-upload/" . $_FILES['image-logo']['name']);
                $image->setImageUrlResize("/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                $image->setStatusId($status_id_confirm);
                $image->save();
                $recipe_cook->setImageId($image->getId());

            }


            foreach ($post['raw_material'] as $index => $item) {
                $item = $item;
                $convert_item = strtolower($this->helper->util()->convert_vi_to_en($item));
                $raw_material = RawMaterial::findFirst([
                    'conditions' => 'name=:name: OR code=:code:',
                    'bind' => [
                        'name' => $item,
                        'code' => $convert_item
                    ]
                ]);
                if ($raw_material) {

                } else {
                    $raw_material = new RawMaterial();
                    $raw_material->setId($raw_material->getSequenceId());
                    $raw_material->setName($item);
                    $raw_material->setCode($convert_item);
                    $raw_material->setStatusId($status_id_enable);
                    $raw_material->setShortCode($convert_item);

                }
                $post['quantitative'][$index] = strtolower($post['quantitative'][$index]);
                $convert_item_quantitative = $this->helper->util()->convert_vi_to_en($post['quantitative'][$index]);
                $quantitative = Quantitative::findFirst([
                    'conditions' => 'name=:name: and code=:code: ',
                    'bind' => [
                        'name' => $post['quantitative'][$index],
                        'code' => $convert_item_quantitative
                    ]
                ]);
                if ($quantitative) {

                } else {
                    $quantitative = new Quantitative();
                    $quantitative->setId($quantitative->getSequenceId());
                    $quantitative->setName($post['quantitative'][$index]);
                    $quantitative->setCode($convert_item_quantitative);
                    $quantitative->setShortCode($convert_item_quantitative);
                    $quantitative->setStatusId($status_id_enable);

                }
                $recipe_material = new RecipeMaterial();
                $recipe_material->setId($recipe_material->getSequenceId());
                $recipe_material->setRawMaterialId($raw_material->getId());
                $recipe_material->setQuantitativeId($quantitative->getId());
                $recipe_material->setRecipeCookId($recipe_cook->getId());
                $recipe_material->setNumber($post['number'][$index]);
                $recipe_material->setStatusId($status_id_confirm);
                if ($recipe_material->save()) {
                    $raw_material->save();
                    $quantitative->save();
                } else {

                }

            }
            $count_medial = 0;
            foreach ($post['contentStep'] as $index => $contentstep) {
                $index = $index + 1;
                $step = new Step();
                $step->setId($step->getSequenceId());
                $step->setRecipeCookId($recipe_cook->getId());
                $step->setCount($index);
                $step->setName('Bước thứ ' . $index . ' của ' . $recipe_cook->getId());
                $step->setCode('BUOC-THU-' . $index . '-CUA-' . $recipe_cook->getId());
                $step->setDescription($contentstep);
                $step->setStatusId($status_id_confirm);
                if ($post['numberImageStep'][$index - 1] <= 6) {
                    $count = $count_medial + $post['numberImageStep'][$index - 1] + 1;
                } else {
                    $count = $count_medial + $post['numberImageStep'][$index - 1];
                }
                $count_image_step = 1;
                for ($i = $count_medial; $i < $count; $i++) {
                    if ($_FILES['stepImage']['name'][$i] == null || empty($_FILES['stepImage']['name'][$i]) || $_FILES['stepImage']['name'][$i] == '') {

                    } else {

                        move_uploaded_file($_FILES['stepImage']['tmp_name'][$i], BASE_PATH . "/public/image-upload/" . $_FILES['stepImage']['name'][$i]);
                        $image = new Image();
                        $image->setId($image->getSequenceId());
                        $image->setCode('IMAGE_STEP_' . $step->getId() . '_COUNT_' . $index . '_RECIPE_COOK_' . $recipe_cook->getId());
                        $image->setStepId($step->getId());
                        $image->setCountStep($count_image_step);
                        $image->setRecipeCookId($recipe_cook->getId());
                        $image_base = base64_encode(file_get_contents(BASE_PATH . "/public/image-upload/" . $_FILES['stepImage']['name'][$i]));
                        $image->setImageBase('data:' . $image_type . ';base64,' . $image_base);
                        $image->setImageUrl("/public/image-upload/" . $_FILES['stepImage']['name'][$i]);
                        $image->setStatusId($status_id_confirm);
                        $image->save();
                        $count_image_step = $count_image_step + 1;
                    }
                }
                $count_medial = $count;
                $step->save();
            }
            foreach ($post['category'] as $index => $value) {
                $recipe_category = new RecipeCategory();
                $recipe_category->setId($recipe_category->getSequenceId());
                $recipe_category->setRecipeCookId($recipe_cook->getId());
                $recipe_category->setCategoryId($value);
                $recipe_category->setStatusId($status_id_confirm);
                $recipe_category->save();

            }
            $recipe_cook->save();
            $this->db->commit();
            $this->flashSession->success('Công thức đã được gửi đi. Vui lòng chờ đợi để được xét duyệt công thức.');
            return $this->redirect('/cong-thuc/tao-cong-thuc');
        } else {
            $list_category_type = CategoryType::find([
                'conditions'=>'status_id=:status_id:',
                'bind'=>[
                    'status_id'=>$status_id_enable
                ]
            ]);
            $list_raw_material = RawMaterial::find([
                'conditions'=>'status_id=:status_id:',
                'bind'=>[
                    'status_id'=>$status_id_enable
                ]
            ]);
            $list_quantitative = Quantitative::find([
                'conditions'=>'status_id=:status_id:',
                'bind'=>[
                    'status_id'=>$status_id_enable
                ]
            ]);
            $list_category = [];
            foreach ($list_category_type as $item) {
                $list_category_by_category_type = Category::find([
                    'conditions' => 'type_id=:type_id:',
                    'bind' => [
                        'type_id' => $item->getId()
                    ]
                ]);
                $list_category[$item->getName()] = $list_category_by_category_type;
            }
            $this->view->list_raw_material = $list_raw_material;
            $this->view->list_quantitative = $list_quantitative;
            $this->view->list_category_type = $list_category_type;
            $this->view->list_category = $list_category;
            $this->view->form = $form;
        }
    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $recipe = RecipeCook::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);

    }

    public function editRecipeAction()
    {
        $slug = $this->dispatcher->getParam('slug');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_confirm = Status::getStatusIdByCode('confirm');
        $status_id_edit = Status::getStatusIdByCode('edit');
        $status_id_old = Status::getStatusIdByCode('old');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => $slug
            ]
        ]);
        $form = new IndexForm();
        $form->create();
        $this->db->begin();
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            foreach ($post as $index => $item) {
                if (is_array($item)) {
                    foreach ($item as $index2 => $item2) {
                        $post[$index][$index2] = trim($item2);
                    }
                } else {
                    $post[$index] = trim($item);
                }
            }

            $recipe_cook_old = new RecipeCook();
            $recipe_cook_old->setId($recipe_cook_old->getSequenceId());
            $recipe_cook_old->setName($recipe_cook->getName());
            $recipe_cook_old->setCode($recipe_cook->getCode());
            $recipe_cook_old->setBookmarkTotal($recipe_cook->getBookmarkTotal());
            $recipe_cook_old->setUserId($recipe_cook->getUserId());
            $recipe_cook_old->setStatusId($status_id_old);
            $recipe_cook_old->setImageId($recipe_cook->getImageId());
            $recipe_cook_old->setLevel($recipe_cook->getLevel());
            $recipe_cook_old->setTimeDo($recipe_cook->getTimeDo());
            $recipe_cook_old->setDescription($recipe_cook->getDescription());
            $recipe_cook_old->setSeenTotal($recipe_cook->getSeenTotal());
            $recipe_cook_old->save();

            $recipe_cook->setName($post['name-recipe']);
            $post['name-recipe'] = strtolower($post['name-recipe']);
            $post['name-recipe'] = $this->helper->util()->convert_vi_to_en($post['name-recipe']);
            $code_recipe = str_replace(' ', '-', $post['name-recipe']);
            $recipe_cook->setCode($code_recipe . '-' . $recipe_cook->getId());
            $recipe_cook->setDescription($post['description-recipe']);
            $recipe_cook->setLevel($post['level']);
            $recipe_cook->setTimeDo($post['time_do']);
            $recipe_cook->setStatusId($status_id_edit);
            $recipe_cook->setUserId($auth_site_home['id']);
            $recipe_cook->setSeenTotal($recipe_cook_old->getSeenTotal());
            $recipe_cook->setBookmarkTotal($recipe_cook_old->getBookmarkTotal());

            $file = $_FILES['image-logo']['tmp_name'];

            if ($file == null || empty($file)) {
                $recipe_cook->setImageId($recipe_cook->getImageId());
                $recipe_cook->save();

            } else {
                $finfo = new \finfo(FILEINFO_MIME_TYPE);
                $image_type = $finfo->file($_FILES['image-logo']['tmp_name']);
                if (($image_type == "image/png" || $image_type == "image/svg+xml" || $image_type == "image/svg" || $image_type == "image/jpeg")) {
                    move_uploaded_file($_FILES['image-logo']['tmp_name'], BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name']);
                    $img = $this->helper->resize_image(BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name'], 300, 300, $image_type);
                    if ($image_type == "image/png") {
                        imagepng($img, BASE_PATH . "/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                    } else {
                        imagejpeg($img, BASE_PATH . "/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                    }
                    $image = Image::findFirst([
                        'conditions' => 'id=:id:',
                        'bind' => [
                            'id' => $recipe_cook_old->getImageId()
                        ]
                    ]);
                    $image_old = new Image();
                    $image_old->setId($image_old->getSequenceId());
                    $image_old->setCode($image->getCode());
                    $image_old->setImageBase($image->getImageBase());
                    $image_old->setImageUrl($image->getImageUrl());
                    $image_old->setStatusId($status_id_old);
                    $image_old->save();

                    $image = Image::findFirst([
                        'conditions' => 'id=:id:',
                        'bind' => [
                            'id' => $recipe_cook->getImageId()
                        ]
                    ]);
                    $image->setCode('IMAGE_LOGO_RECIPE_COOK_' . $recipe_cook->getId());
                    $image_base = base64_encode(file_get_contents(BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name']));
                    $image->setImageBase('data:' . $image_type . ';base64,' . $image_base);
                    $image->setImageUrl("/public/image-upload/" . $_FILES['image-logo']['name']);
                    $image->setImageUrlResize("/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                    $image->setStatusId($status_id_edit);
                    $image->save();
                    $recipe_cook->setImageId($image->getId());

                }

            }


            $recipe_material = RecipeMaterial::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            foreach ($recipe_material as $item_recipe_material) {
                $item_recipe_material->setStatusId($status_id_old);
                $item_recipe_material->save();
            }
            foreach ($post['raw_material'] as $index => $item) {
                $item = strtolower($item);
                $convert_item = $this->helper->util()->convert_vi_to_en($item);
                $raw_material = RawMaterial::findFirst([
                    'conditions' => 'name=:name: OR code=:code: and status_id=:status_id:',
                    'bind' => [
                        'name' => $item,
                        'code' => $convert_item,
                        'status_id' => $status_id_enable
                    ]
                ]);
                if ($raw_material) {

                } else {
                    $raw_material = new RawMaterial();
                    $raw_material->setId($raw_material->getSequenceId());
                    $raw_material->setName($item);
                    $raw_material->setCode($convert_item);
                    $raw_material->setStatusId($status_id_enable);
                    $raw_material->setShortCode($convert_item);
                    $raw_material->save();
                }
                $post['quantitative'][$index] = strtolower($post['quantitative'][$index]);
                $convert_item_quantitative = $this->helper->util()->convert_vi_to_en($post['quantitative'][$index]);
                $quantitative = Quantitative::findFirst([
                    'conditions' => 'name=:name: and code=:code:',
                    'bind' => [
                        'name' => $post['quantitative'][$index],
                        'code' => $convert_item_quantitative
                    ]
                ]);
                if ($quantitative) {

                } else {
                    $quantitative = new Quantitative();
                    $quantitative->setId($quantitative->getSequenceId());
                    $quantitative->setName($post['quantitative'][$index]);
                    $quantitative->setCode($convert_item_quantitative);
                    $quantitative->setShortCode($convert_item_quantitative);
                    $quantitative->setStatusId($status_id_enable);
                    $quantitative->save();
                }
                $recipe_material = new RecipeMaterial();
                $recipe_material->setId($recipe_material->getSequenceId());
                $recipe_material->setRawMaterialId($raw_material->getId());
                $recipe_material->setQuantitativeId($quantitative->getId());
                $recipe_material->setRecipeCookId($recipe_cook->getId());
                $recipe_material->setStatusId($status_id_edit);
                $recipe_material->setNumber($post['number'][$index]);
                if ($recipe_material->save()) {

                } else {

                }
            }

            $step_old = Step::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id: and status_id=:status_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            foreach ($step_old as $item_step_old) {
                $item_step_old->setStatusId($status_id_old);
                $image_step_old = Image::find([
                    'conditions' => 'step_id=:step_id: and status_id=:status_id:',
                    'bind' => [
                        'status_id' => $status_id_enable,
                        'step_id' => $item_step_old->getId()
                    ]
                ]);
                foreach ($image_step_old as $item) {
                    $item->setStatusId($status_id_old);
                    $item->save();
                }
                $item_step_old->save();
            }

            $count_medial = 0;
            foreach ($post['contentStep'] as $index => $contentstep) {
                $index = $index + 1;
                $step = new Step();
                $step->setId($step->getSequenceId());
                $step->setRecipeCookId($recipe_cook->getId());
                $step->setCount($index);
                $step->setName('Bước thứ ' . $index . ' của ' . $recipe_cook->getId());
                $step->setCode('BUOC-THU-' . $index . '-CUA-' . $recipe_cook->getId());
                $step->setDescription($contentstep);
                $step->setStatusId($status_id_edit);
                if ($post['numberImageStep'][$index - 1] <= 6) {
                    $count = $count_medial + $post['numberImageStep'][$index - 1] + 1;
                } else {
                    $count = $count_medial + $post['numberImageStep'][$index - 1];
                }
                $count_image_step = 1;
                for ($i = $count_medial; $i < $count; $i++) {
                    if ($_FILES['stepImage']['name'][$i] == null || empty($_FILES['stepImage']['name'][$i]) || $_FILES['stepImage']['name'][$i] == '') {

                        if ($post['valueImageBase'][$i] != "" || !empty($post['valueImageBase'][$i]) || $post['valueImageBase'][$i] != null) {
                            $image = new Image();
                            $image->setId($image->getSequenceId());
                            $image->setCode('IMAGE_STEP_' . $step->getId() . '_COUNT_' . $index . '_RECIPE_COOK_' . $recipe_cook->getId());
                            $image->setStepId($step->getId());
                            $image->setCountStep($count_image_step);
                            $image->setRecipeCookId($recipe_cook->getId());
                            $image->setImageUrl($post['valueImageBase'][$i]);
                            $image->setStatusId($status_id_edit);
                            $image->save();
                            $count_image_step = $count_image_step + 1;
                        }

                    } else {

                        move_uploaded_file($_FILES['stepImage']['tmp_name'][$i], BASE_PATH . "/public/image-upload/" . $_FILES['stepImage']['name'][$i]);
                        $image = new Image();
                        $image->setId($image->getSequenceId());
                        $image->setCode('IMAGE_STEP_' . $step->getId() . '_COUNT_' . $index . '_RECIPE_COOK_' . $recipe_cook->getId());
                        $image->setStepId($step->getId());
                        $image->setCountStep($count_image_step);
                        $image->setRecipeCookId($recipe_cook->getId());
                        $image_base = base64_encode(file_get_contents(BASE_PATH . "/public/image-upload/" . $_FILES['stepImage']['name'][$i]));
                        $image->setImageBase('data:' . $image_type . ';base64,' . $image_base);
                        $image->setImageUrl("/public/image-upload/" . $_FILES['stepImage']['name'][$i]);
                        $image->setStatusId($status_id_edit);
                        $image->save();
                        $count_image_step = $count_image_step + 1;
                    }


                }
                $count_medial = $count;
                $step->save();

            }

            $recipe_category_old = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            foreach ($recipe_category_old as $item_recipe_category_old) {
                $item_recipe_category_old->setStatusId($status_id_old);
                $item_recipe_category_old->save();
            }
            foreach ($post['category'] as $index => $value) {
                $recipe_category = new RecipeCategory();
                $recipe_category->setId($recipe_category->getSequenceId());
                $recipe_category->setRecipeCookId($recipe_cook->getId());
                $recipe_category->setCategoryId($value);
                $recipe_category->setStatusId($status_id_edit);
                $recipe_category->save();
            }
            $recipe_cook->save();
            $this->db->commit();
            return $this->redirect('/tai-khoan/cong-thuc');

        } else {
            $recipe_material = RecipeMaterial::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            $step = Step::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ],
                'order' => 'count ASC'
            ]);
            $list_image_step = [];

            foreach ($step as $item) {
                $list_image_step[$item->getId()] = Image::find([
                    'conditions' => 'step_id=:step_id:',
                    'bind' => [
                        'step_id' => $item->getId()
                    ]
                ]);
            }
            if (count($recipe_material) == 0) {
                $this->view->recipe_material = null;
            } else {
                $this->view->recipe_material = $recipe_material;
            }
            if (count($step) == 0) {
                $this->view->step = null;
                $this->view->count_step = 1;
            } else {
                $this->view->step = $step;
                $this->view->count_step = count($step);

            }
            $list_category_type = CategoryType::find();
            $list_raw_material = RawMaterial::find();
            $list_quantitative = Quantitative::find();
            $list_category = [];
            foreach ($list_category_type as $item) {
                $list_category_by_category_type = Category::find([
                    'conditions' => 'type_id=:type_id:',
                    'bind' => [
                        'type_id' => $item->getId()
                    ]
                ]);
                $list_category[$item->getName()] = $list_category_by_category_type;
            }
            $recipe_category = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            $list_recipe_category = [];
            foreach ($recipe_category as $item) {
                $list_recipe_category[$item->getCategoryId()] = $item;
            }
            $this->view->list_image_step = $list_image_step;
            $this->view->list_recipe_category = $list_recipe_category;
            $this->view->list_raw_material = $list_raw_material;
            $this->view->list_quantitative = $list_quantitative;
            $this->view->list_category_type = $list_category_type;
            $this->view->list_category = $list_category;
            $this->view->form = $form;
            $this->view->recipe_cook = $recipe_cook;
        }
    }

    public function rejectRecipeAction()
    {
        $slug = $this->dispatcher->getParam('slug');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_confirm = Status::getStatusIdByCode('confirm');
        $status_id_edit = Status::getStatusIdByCode('edit');
        $status_id_old = Status::getStatusIdByCode('old');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => $slug
            ]
        ]);
        $form = new IndexForm();
        $form->create();
        $this->db->begin();
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            foreach ($post as $index => $item) {
                if (is_array($item)) {
                    foreach ($item as $index2 => $item2) {
                        $post[$index][$index2] = trim($item2);
                    }
                } else {
                    $post[$index] = trim($item);
                }
            }

            $recipe_cook_old = new RecipeCook();

            $recipe_cook_old->setId($recipe_cook_old->getSequenceId());
            $recipe_cook_old->setName($recipe_cook->getName());
            $recipe_cook_old->setCode($recipe_cook->getCode());
            $recipe_cook_old->setBookmarkTotal($recipe_cook->getBookmarkTotal());
            $recipe_cook_old->setUserId($recipe_cook->getUserId());
            $recipe_cook_old->setStatusId($status_id_old);
            $recipe_cook_old->setImageId($recipe_cook->getImageId());
            $recipe_cook_old->setLevel($recipe_cook->getLevel());
            $recipe_cook_old->setTimeDo($recipe_cook->getTimeDo());
            $recipe_cook_old->setDescription($recipe_cook->getDescription());
            $recipe_cook_old->setSeenTotal($recipe_cook->getSeenTotal());
            $recipe_cook_old->save();

            $recipe_cook->setName($post['name-recipe']);
            $post['name-recipe'] = strtolower($post['name-recipe']);
            $post['name-recipe'] = $this->helper->util()->convert_vi_to_en($post['name-recipe']);
            $code_recipe = str_replace(' ', '-', $post['name-recipe']);
            $recipe_cook->setCode($code_recipe . '-' . $recipe_cook->getId());
            $recipe_cook->setDescription($post['description-recipe']);
            $recipe_cook->setLevel($post['level']);
            $recipe_cook->setTimeDo($post['time_do']);
            $recipe_cook->setStatusId($status_id_edit);
            $recipe_cook->setUserId($auth_site_home['id']);
            $recipe_cook->setSeenTotal($recipe_cook_old->getSeenTotal());
            $recipe_cook->setBookmarkTotal($recipe_cook_old->getBookmarkTotal());

            $file = $_FILES['image-logo']['tmp_name'];

            if ($file == null || empty($file)) {
                $recipe_cook->setImageId($recipe_cook->getImageId());
                $recipe_cook->save();

            } else {
                $finfo = new \finfo(FILEINFO_MIME_TYPE);
                $image_type = $finfo->file($_FILES['image-logo']['tmp_name']);
                if (($image_type == "image/png" || $image_type == "image/svg+xml" || $image_type == "image/svg" || $image_type == "image/jpeg")) {
                    move_uploaded_file($_FILES['image-logo']['tmp_name'], BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name']);
                    $img = $this->helper->resize_image(BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name'], 300, 300, $image_type);
                    if ($image_type == "image/png") {
                        imagepng($img, BASE_PATH . "/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                    } else {
                        imagejpeg($img, BASE_PATH . "/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                    }
                    $image_old = Image::findFirst([
                        'conditions' => 'id=:id:',
                        'bind' => [
                            'id' => $recipe_cook->getImageId()
                        ]
                    ]);
                    $image = new Image();
                    $image->setId($image->getSequenceId());
                    $image->setCode('IMAGE_LOGO_RECIPE_COOK_' . $recipe_cook->getId());
                    $image_base = base64_encode(file_get_contents(BASE_PATH . "/public/image-upload/" . $_FILES['image-logo']['name']));
                    $image->setImageBase('data:' . $image_type . ';base64,' . $image_base);
                    $image->setImageUrl("/public/image-upload/" . $_FILES['image-logo']['name']);
                    $image->setImageUrlResize("/public/image-upload-resize/" . $_FILES['image-logo']['name']);
                    $image->setStatusId($status_id_enable);
                    $image->save();
                    $recipe_cook->setImageId($image->getId());
                    $recipe_cook->save();
                }

            }


            $recipe_material = RecipeMaterial::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            foreach ($recipe_material as $item_recipe_material) {
                $item_recipe_material->setStatusId($status_id_old);
                $item_recipe_material->save();
            }
            foreach ($post['raw_material'] as $index => $item) {
                $item = strtolower($item);
                $convert_item = $this->helper->util()->convert_vi_to_en($item);
                $raw_material = RawMaterial::findFirst([
                    'conditions' => 'name=:name: OR code=:code:',
                    'bind' => [
                        'name' => $item,
                        'code' => $convert_item
                    ]
                ]);
                if ($raw_material) {

                } else {
                    $raw_material = new RawMaterial();
                    $raw_material->setId($raw_material->getSequenceId());
                    $raw_material->setName($item);
                    $raw_material->setCode($convert_item);
                    $raw_material->setStatusId($status_id_confirm);
                    $raw_material->setShortCode($convert_item);
                    $raw_material->save();
                }
                $post['quantitative'][$index] = strtolower($post['quantitative'][$index]);
                $convert_item_quantitative = $this->helper->util()->convert_vi_to_en($post['quantitative'][$index]);
                $quantitative = Quantitative::findFirst([
                    'conditions' => 'name=:name: and code=:code: ',
                    'bind' => [
                        'name' => $post['quantitative'][$index],
                        'code' => $convert_item_quantitative
                    ]
                ]);
                if ($quantitative) {

                } else {
                    $quantitative = new Quantitative();
                    $quantitative->setId($quantitative->getSequenceId());
                    $quantitative->setName($post['quantitative'][$index]);
                    $quantitative->setCode($convert_item_quantitative);
                    $quantitative->setShortCode($convert_item_quantitative);
                    $quantitative->setStatusId($status_id_confirm);
                    $quantitative->save();
                }
                $recipe_material = new RecipeMaterial();
                $recipe_material->setId($recipe_material->getSequenceId());
                $recipe_material->setRawMaterialId($raw_material->getId());
                $recipe_material->setQuantitativeId($quantitative->getId());
                $recipe_material->setRecipeCookId($recipe_cook->getId());
                $recipe_material->setStatusId($status_id_edit);
                $recipe_material->setNumber($post['number'][$index]);
                if ($recipe_material->save()) {

                } else {

                }
            }

            $step_old = Step::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            foreach ($step_old as $item_step_old) {
                $item_step_old->setStatusId($status_id_old);
                $item_step_old->save();
            }
            foreach ($post['contentStep'] as $index => $contentstep) {
                $index = $index + 1;
                $step = new Step();
                $step->setId($step->getSequenceId());
                $step->setRecipeCookId($recipe_cook->getId());
                $step->setCount($index);
                $step->setName('Bước thứ ' . $index . ' của ' . $recipe_cook->getId());
                $step->setCode('BUOC-THU-' . $index . '-CUA-' . $recipe_cook->getId());
                $step->setDescription($contentstep);
                $step->setStatusId($status_id_edit);
                $step->save();
            }

            $recipe_category_old = RecipeCategory::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            foreach ($recipe_category_old as $item_recipe_category_old) {
                $item_recipe_category_old->setStatusId($status_id_old);
                $item_recipe_category_old->save();
            }
            foreach ($post['category'] as $index => $value) {
                $recipe_category = new RecipeCategory();
                $recipe_category->setId($recipe_category->getSequenceId());
                $recipe_category->setRecipeCookId($recipe_cook->getId());
                $recipe_category->setCategoryId($value);
                $recipe_category->setStatusId($status_id_edit);
                $recipe_category->save();
            }
            $this->db->commit();
            return $this->redirect('/cong-thuc/tao-cong-thuc');

        } else {
            $recipe_material = RecipeMaterial::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            $step = Step::find([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId()
                ],
                'order' => 'count ASC'
            ]);
            if (count($recipe_material) == 0) {
                $this->view->recipe_material = null;
            } else {
                $this->view->recipe_material = $recipe_material;
            }
            if (count($step) == 0) {
                $this->view->step = null;
                $this->view->count_step = 1;
            } else {
                $this->view->step = $step;
                $this->view->count_step = count($step);

            }
            $list_category = Category::find([
//                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
//                'bind' => [
//                    'recipe_cook_id' => $recipe_cook->getId()
//                ]
            ]);
            $this->view->list_category = $list_category;
            $this->view->form = $form;
            $this->view->recipe_cook = $recipe_cook;
        }
    }

    public function ajaxSearchRecipeAction()
    {
        $this->view->disable();
        $status_id_enable = Status::getStatusIdByCode('enable');
        $value = $this->request->getPost('value');
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
                                $list[$recipe->getId()] = [
                                    'name' => $recipe->getName(),
                                    'image' => $recipe->image->getImageBase(),
                                    'time' => $recipe->getTimeDo(),
                                    'code' => $recipe->getCode(),
                                    'url' => $raw_url_encode
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
                                        'url' => $raw_url_encode
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
                                'code' => $recipe->getCode(),
                                'url' => $raw_url_encode
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
                            $list[$item2->recipe->getId()] = [
                                'name' => $item2->recipe->getName(),
                                'image' => $item2->recipe->image->getImageBase(),
                                'time' => $item2->recipe->getTimeDo(),
                                'code' => $item2->recipe->getCode(),
                                'url' => $raw_url_encode
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
                                    'url' => $raw_url_encode
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
                            $list[$item2->recipe->getId()] = [
                                'name' => $item2->recipe->getName(),
                                'image' => $item2->recipe->image->getImageBase(),
                                'time' => $item2->recipe->getTimeDo(),
                                'code' => $item2->recipe->getCode(),
                                'url' => $raw_url_encode
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
                        $list[$item2->recipe->getId()] = [
                            'name' => $item2->recipe->getName(),
                            'image' => $item2->recipe->image->getImageBase(),
                            'time' => $item2->recipe->getTimeDo(),
                            'code' => $item2->recipe->getCode(),
                            'url' => $raw_url_encode
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
                                'url' => $raw_url_encode
                            ];
                        }
                    }
                }
            }


        }
        echo json_encode($list);
        die();

    }

    public function checkSeenRecipeAction($recipe_cook)
    {
        $auth_site_home = $this->auth->getAuthSiteHome();
        $ip = $this->getClientIP();
        if (count($auth_site_home) == 0) {
            $seen_recipe = SeenRecipe::findFirst([
                'conditions' => 'ip=:ip: and recipe_cook_id=:recipe_cook_id: ',
                'bind' => [
                    'ip' => $ip,
                    'recipe_cook_id' => $recipe_cook->getId()
                ]
            ]);
            if (!$seen_recipe) {
                $seen_recipe = new SeenRecipe();
                $seen_recipe->setId($seen_recipe->getSequenceId());
                $seen_recipe->setIp($ip);
                $seen_recipe->setRecipeCookId($recipe_cook->getId());
                $recipe_cook->setSeenTotal($recipe_cook->getSeenTotal() + 1);
                $recipe_cook->save();
                $seen_recipe->save();
            } else {

            }
        } else {
            $seen_recipe = SeenRecipe::findFirst([
                'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $recipe_cook->getId(),
                    'user_id' => $auth_site_home['id']
                ]
            ]);
            if (!$seen_recipe) {
                $seen_recipe = new SeenRecipe();
                $seen_recipe->setId($seen_recipe->getSequenceId());
                $seen_recipe->setUserId($auth_site_home['id']);
                $seen_recipe->setRecipeCookId($recipe_cook->getId());
                $recipe_cook->setSeenTotal($recipe_cook->getSeenTotal() + 1);
                $recipe_cook->save();
                $seen_recipe->save();
            } else {

            }
        }

    }

    public function getClientIP()
    {
        return isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] :
            isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] :
                isset($_SERVER['HTTP_X_FORWARDED']) ? $_SERVER['HTTP_X_FORWARDED'] :
                    isset($_SERVER['HTTP_FORWARDED_FOR']) ? $_SERVER['HTTP_FORWARDED_FOR'] :
                        isset($_SERVER['HTTP_FORWARDED']) ? $_SERVER['HTTP_FORWARDED'] :
                            isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    }
}

