<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use RainLab\Blog\Components\Post as BlogPostComponent;
use RainLab\Blog\Models\Post as BlogPost;
use Cms\Classes\Controller;

class BlogShortcode extends Shortcode
{

    public $postId;

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('blog', function(ShortcodeInterface $sc) {

           $this->postId = $sc->getParameter('id');

			BlogPostComponent::extend(function ($component) {

				$component->addDynamicMethod('onRenderNew', function () use($component) {
					$component->categoryPage = $component->property('categoryPage');

					$post = new BlogPost;
					$post = $post->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
			            ? $post->transWhere('id', $this->postId)
			            : $post->where('id', $this->postId);

			        try {
			        	$component->post = $post->firstOrFail();
			        } catch (ModelNotFoundException $ex) {
			        }

			        $controller = new Controller;
            		$controller->setComponentContext($component);
/*
			        if (!$component->checkEditor()) {
			            $post = $post->isPublished();
			        }

*/

			        if ($component->post && $component->post->categories->count()) {
			            $blogPostsComponent = null;//$component->getComponent('blogPosts', $component->categoryPage);

			            $component->post->categories->each(function ($category) use ($component,$controller,$blogPostsComponent) {
			                $category->setUrl($component->categoryPage, $controller, [
			                    //'slug' => $component->urlProperty(null, 'categoryFilter')
			                ]);
			            });
			   		}

            		return $controller->renderPartial('@default.htm');
                });
			});

            $blogPostComponent = new BlogPostComponent;
            return $blogPostComponent->onRenderNew();
        });
    }
}