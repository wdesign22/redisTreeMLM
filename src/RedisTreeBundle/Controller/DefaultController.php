<?php

namespace RedisTreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SymfonyBundles\RedisBundle\SymfonyBundlesRedisBundle;
use Predis\Client;


class DefaultController extends Controller
{
    /**
     * @Route("/redistree")
     */
    public function indexAction()
    {

     //   $em = $this->getDoctrine()->getManager();

     //   $posts = $em->getRepository('RedisTreeBundle:mlmUser')->testF();

        $redis = new Client(array(

            "scheme" => "tcp",
            'host' => 'localhost',
            'port' => 6379,
        ));

        $key = '17';
        $redis->hset($key, 'up', 18);// при записи надо установить кто сверху и под именем верхнего сделать down
        $redis->hset($key, 'down', 16);

        echo $redis->hget($key, 'up'); // Finland

        echo "<br>";
        return $this->render('RedisTreeBundle:Default:index.html.twig');
    }
}
