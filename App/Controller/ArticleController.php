<?php

namespace App\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Form\Form;

class ArticleController implements ControllerProviderInterface {

  /**
   * @var string
   */
  protected $form;

  public function connect(Application $app) {
    // créer un nouveau controller basé sur la route par défaut
    $article = $app['controllers_factory'];
    $article->get('/feature/{ids}', array($this,getFeaturedArticles) )->bind("article.featured");
    #$article->match("/", 'App\Controller\ArticleController::index')->bind("article.index");
    $article->match("/", array($this,index))->bind("article.index");
    $article->get("/slug/{slug}", array($this,getBySlug) )->bind("article.get");
    $article->get("/tag/{tag}", array($this,getByTag) )->bind("article.getbytag")
      ->convert( 'tag',function($tag){return urldecode($tag);} );
    return $article;
  }

  /**
   * Lister les blog posts
   * @param \Silex\Application $app
   * @return mixed
   */
  public function index(Application $app) {
    $articles = $app['article_manager']->getArticles(array('created_at' => -1));
    return $app["twig"]->render("article/index.twig", array("articles" => $articles));
  }

  function getBySlug(Application $app, $slug) {
    $article = $app['article_manager']->getBySlug($slug);
    if ($article == null):
      return $app->redirect($app["url_generator"]->generate("article.index"));
    endif;
    return $app["twig"]->render("article/get.twig", array("article" => $article));
  }

  function getByTag(Application $app,$tag){
    $articles = $app['article_manager']->getByTag($tag);
    return $app['twig']->render("article/getbytag.twig",array("tag"=>$tag,'articles'=>$articles));
  }

  function paginator($items, $current_page = null, $item_per_page = 5) {
    if ($current_page !== null):
      $items = array_slice($items, ((int) $current_page - 1) * (int) $item_per_page, $item_per_page);
    endif;
    return $items;
  }

  function getFeaturedArticles(Application $app, $ids) {
    $ids = json_decode($ids);
    $articles = $app['article_manager']->getFirstThreeArticles();
    return $app['twig']->render('article/featured.twig', array('articles' => $articles));
  }

}