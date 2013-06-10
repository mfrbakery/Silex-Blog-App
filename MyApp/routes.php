<?php

// EN : define main routes 
// FR : définir les routes principales

$app->mount("/", new MyApp\Controller\IndexController());
$app->mount("/article",new MyApp\Controller\ArticleController($app['article_manager'],$app['user_manager']) );
$app->mount("/comment",new MyApp\Controller\CommentController($app['spam_manager']) );
$app->mount('/user', new MyApp\Controller\UserController($app['user_manager'],$app['spam_manager']) );
$app->mount('/admin/user', new MyApp\Controller\Admin\UserAdminController());
$app->mount('/admin/article',new MyApp\Controller\Admin\ArticleAdminController($app['article_manager']));
$app->mount('/admin/option',new MyApp\Controller\Admin\OptionAdminController($app['options']));

// the following code is just a test

// use Silex\Application;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use App\Form\CaptchaType;
// use App\Form\ImageType;
// $app->match('/captcha',function(Application $app,Request $request){
//   /** @var $image Symfony\Component\Form\Form **/
//   $image = $app['form.factory']->create(new CaptchaType());
//   return $app['twig']->render('form/captcha.twig',array('form'=>$image->createView()));
// });