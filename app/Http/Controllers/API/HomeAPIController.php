<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Repositories\ArticleRepository;
use App\Repositories\NewsRepository;
use App\Repositories\TagRepository;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Repositories\CustomerRepository;
use App\Repositories\ScheduleRepository;

use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Models\Customer;

class HomeAPIController extends AppBaseController{

    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo,
                                TagRepository $tagRepo,
                                NewsRepository $newsRepository,
                                CustomerRepository $customerRepository,
                                ScheduleRepository $scheduleRepository
                                )
    {
        $this->articleRepository = $articleRepo;
        $this->tagRepository = $tagRepo;
        $this->newsRepository = $newsRepository;
        $this->customerRepository = $customerRepository;
        $this->scheduleRepository = $scheduleRepository;
    }


    public function index(){

        $meta = array(
            'banner' => Article::where('is_banner', true)->get(),
            'articles' => Article::limit(15)->orderBy('created_at', 'desc')->offset(0)->get(),
        );

        return response()->json($meta);
    }

    public function getAllTag(){

        return response()->json($this->tagRepository->all());

    }

    public function getAllArticles(){
        $metha = array(
            'data'=> $this->articleRepository->all(),
            'next_page_url'=>null
        );
        return response()->json($metha);

        //return response()->json($this->articleRepository->paginate($limit = null, $columns = ['*']));
    }

    public function getAllArticlesByTag($id){
        $metha = array(
            'data'=> $this->articleRepository->findByField('tag',$id,$columns = ['*']),
            'next_page_url'=>null
        );
        return response()->json($metha);
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

    public function getAllnews(){
        return response()->json($this->newsRepository->all());
    }

    public function registerUser(Request $request){

        $input = $request->all();

        $customer = $this->customerRepository->create($input);

        return response()->json($customer);
    }

    public function login(Request $request){

        $input = $request->all();

        $customer = Customer::where('email', $input['email'])
                    ->where('password', $input['password'])
                    ->first();
        $metha = array(
            'status'=> 'ERROR',
            'message'=>'User not found',
            'token' => null
        );

        if(count($customer) > 0){
            $token = JWTAuth::fromUser($customer);

            $metha = array(
                'token' => $token
            );
        }


        return response()->json($metha);
    }

    public function makeScedule(Request $request){
        $input = $request->all();
        $token = $input['token'];
        $user = $this->getUserDetail($token);
        $input['customer_id'] = $user->id;
        $schedule = $this->scheduleRepository->create($input);

        return response()->json(['result' => $schedule]);

    }

    private function getUserDetail($token){
        try {
            $user = JWTAuth::toUser($token);
            return $user;
        } catch (JWTException $e) {

            return response()->json(['error' => 'invalid token'], 401);
        }

    }




}