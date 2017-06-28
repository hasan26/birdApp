<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Tag;
use App\Repositories\TagRepository;
use App\Repositories\ArticleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class ArticleController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo, TagRepository $tagRepo)
    {
        $this->articleRepository = $articleRepo;
        $this->tagRepository = $tagRepo;
    }

    /**
     * Display a listing of the Article.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->articleRepository->pushCriteria(new RequestCriteria($request));
        $articles = $this->articleRepository->all();

        return view('articles.index')
            ->with('articles', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        $article['tag_data']=$this->getAllTag();
        $article['tag']=1;

        return view('articles.create')->with('article', $article);;
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $input = $request->all();
        if (isset($input['bundle_articles'])){
            if (count($input['bundle_articles']) > 0){
                $input['bundle_articles'] = "[".implode(",",$input['bundle_articles'])."]";

            }
        }
        if (!isset($input['is_banner'])){
            $input['is_banner'] = 0;
        }
        $article = $this->articleRepository->create($input);

        Flash::success('Article saved successfully.');

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $bundleArray = json_decode($article->bundle_articles);


        if (count($bundleArray) > 0){
            $article->bundle_articles = "";
            foreach ($bundleArray as &$value) {
                $tempArticle = $this->articleRepository->findWithoutFail($value);
                $article->bundle_articles .= $tempArticle->title .", ";
            }
        }

        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        $article['tag_data']=$this->getAllTag();

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $bundleArray = json_decode($article->bundle_articles);
        $article['artilce_bundle_data'] = array();

        if (count($bundleArray) > 0){
            $bundle_article_array= array();
            foreach ($bundleArray as &$value) {
                $tempArticle = $this->articleRepository->findWithoutFail($value);
                array_push($bundle_article_array,[$tempArticle->id, $tempArticle->title]);
            }
            $article['artilce_bundle_data']= $bundle_article_array;

        }

        return view('articles.edit')->with('article', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int              $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);
        $input = $request->all();
        if (isset($input['bundle_articles'])){
            if (count($input['bundle_articles']) > 0){
                $input['bundle_articles'] = "[".implode(",",$input['bundle_articles'])."]";

            }
        }

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }
        if (!isset($input['is_banner'])){
            $input['is_banner'] = 0;
        }
        $article = $this->articleRepository->update($input, $id);


        Flash::success('Article updated successfully.');

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('Article deleted successfully.');

        return redirect(route('articles.index'));
    }

    private function getAllTag(){
        $tags    = $this->tagRepository->all();
        $tagArray = array();

        foreach ($tags as $tag)
        {
            $tagArray[$tag->id] = $tag->title;
        }

        return $tagArray;


    }

    public function autocomplete(Request $request){
        $term = $request->get('term','');

        $results = array();

        $queries = DB::table('articles')
            ->where('title', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->title];
        }
        return Response::json($results);
    }
}
