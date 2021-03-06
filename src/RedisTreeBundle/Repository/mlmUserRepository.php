<?php

namespace RedisTreeBundle\Repository;

use Predis\Client;

/**
 * mlmUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class mlmUserRepository extends \Doctrine\ORM\EntityRepository
{

    public function saveRedis($mlmUser)
    {

        $redis = new Client(array(

            "scheme" => "tcp",
            'host' => 'localhost',
            'port' => 6379,
        ));

        $redis->hset($mlmUser->getId(), 'up', $mlmUser->getAncestor());// пишет предка
        $redis->hset($mlmUser->getAncestor(), 'down', $mlmUser->getId()); // пишет текущего юзера в потомки


//        echo "pre";
//        echo "<pre>";
//        print_r($mlmUser);
//        echo "</pre><br>";
//        die();

    }

    public function getAncestors($mlmUser)
    {

        $redis = new Client(array(

            "scheme" => "tcp",
            'host' => 'localhost',
            'port' => 6379,
        ));

        $idUser = $mlmUser->getId();

//        $idAncestor = $mlmUser->getAncestor();
        // $redis->hget($key, 'up');

        $currentId = $idUser;

        $ancestorsArray = array();

        while ($upLevel = $redis->hget($currentId, 'up')) { // получаем id вышестоящего , первый чувак в сети 0 должен быть
            $ancestorsArray[] = $upLevel;
            $currentId = $upLevel;
        }

        return  $ancestorsArray;

    }


}
