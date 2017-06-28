<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use App\Models\Article;

class HomeAPIController extends AppBaseController{

    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo, TagRepository $tagRepo)
    {
        $this->articleRepository = $articleRepo;
        $this->tagRepository = $tagRepo;
    }


    public function index(){

        $meta = array(
            'banner' => Article::where('is_banner', true)->get(),
            'articles' => Article::limit(7)->orderBy('created_at', 'desc')->offset(0)->get(),
        );

        return response()->json($meta);
    }

    public function getAllTag(){

        return response()->json($this->tagRepository->all());

    }

    public function getAllArticles(){
        return response()->json($this->articleRepository->all());
    }

    public function getAllArticlesByTag($id){
        return response()->json(Article::where('tag', $id)->get());
    }

    public function getArticle($id){
        $article = $this->articleRepository->findWithoutFail($id);
        $bundleArray = json_decode($article->bundle_articles);

        $article['artilce_bundle_data'] = array();

        if (count($bundleArray) > 0){
            $bundle_article_array= array();
            foreach ($bundleArray as &$value) {
                $tempArticle = $this->articleRepository->findWithoutFail($value);
                array_push($bundle_article_array,$tempArticle);
            }
            $article['artilce_bundle_data']= $bundle_article_array;

        }

        return response()->json($article);
    }


}