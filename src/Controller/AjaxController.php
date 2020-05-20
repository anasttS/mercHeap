<?php


namespace App\Controller;


use App\Repository\ProductRepository;

;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController
{
    /**
     * Creates a new ActionItem entity.
     * @Route("/search", name="ajax_search")
     */
    public function searchAction(Request $request, ProductRepository $repository)
    {

        $requestString = $request->query->get('query');

        $entities = $repository->findEntitiesByString($requestString);

        $result['entities'] = $this->getRealEntities($entities);

        return new Response(json_encode($result));
    }

    public function getRealEntities($entities)
    {

        $i = 0;
        foreach ($entities as $entity) {
            $realEntities[$i] = array("id" => $entity->getId(), "name" => $entity->getName(),
                "cost" => $entity->getCost(), "photo" => $entity->getPhoto());
            $i++;
        }

        return $realEntities;
    }

}