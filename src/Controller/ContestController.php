<?php

namespace App\Controller;

use App\Entity\Contest;
use App\Entity\Prize;
use App\Entity\PrizeImage;
use App\Helpers\ArrayHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContestController extends AbstractController
{
    /**
     * @Route("/contest", name="contest")
     */
    public function index()
    {

        $contestsQuery = $this->getDoctrine()->getRepository(Contest::class)->findAll();
        $contests = [];
        foreach ($contestsQuery as $key => $item){
             $contests[$key]['id'] = $item->getId();
             $contests[$key]['nickname'] = $item->getNickname();
             $contests[$key]['conditionContest'] = $item->getConditionContest();
             $prizeQuery = $this->getDoctrine()->getRepository(Prize::class)->findBy([
                'contest' => $item
             ]);


             foreach ($prizeQuery as $prizeKey => $prize){
                 $contests[$key]['prize'][$prizeKey]['name'] = $prize->getName();
                 $contests[$key]['prize'][$prizeKey]['amount'] = $prize->getAmount();
                 $contests[$key]['prize'][$prizeKey]['description'] = $prize->getDescription();
                 $prizeImageQuery = $this->getDoctrine()->getRepository(PrizeImage::class)->findBy([
                        'prize' => $prize
                     ]);


                 foreach ($prizeImageQuery as $imageKey => $image){
                     $contests[$key]['prize'][$prizeKey]['images'] = $image->getPath();
                 }

             }


        }



//        dd($contests);

        return $this->render('contest/index.html.twig', [
            'controller_name' => 'ContestController',
        ]);
    }




    /**
     * @Route("/create-contest", name="create-contest")
     */
    public function create(Request $request)
    {
        $post = $request->request->all();
        if (!empty($post)) {
            $dataPrize = ArrayHelper::sortEntity($post['prize']);

            $em = $this->getDoctrine()->getManager();
            $contestRepository = $em->getRepository(Contest::class);
            $contest = new Contest();
            $contest->setNickname($post['nickname']);
            $contest->setConditionContest($post['conditionContest']);
            $em->persist($contest);
            $em->flush();


            foreach ($dataPrize as $key => $item){
                $prize = new Prize();
                $prize->setName($item['name']);
                $prize->setAmount($item['amount']);
                $prize->setDescription($item['description']);
                $prize->setContest($contest);
                $em->persist($prize);
                $em->flush();
                $i = rand(1, 100);
                $test = move_uploaded_file($item['image'], "public/test_$i.jpeg");
                if (!$test) dd($item['image'], $test);
                $prizeImage = new PrizeImage();
                $prizeImage->setPath($item['image']);
                $prizeImage->setPrize($prize);
                $em->persist($prizeImage);
                $em->flush();
            }
        }


        return $this->render('contest/create_contest.html.twig', [

        ]);
    }

    /**
     * @Route("/add-block-prize-image", name="add-block-prize-image")
     */
    public function addBLockPriseImage(Request $request): Response
    {
        $result = $this->renderView('contest/blocks/prise_image_block.html.twig', [
        ]);

        return new Response($result, 200, [
            'Content-Type' => 'text/html',
        ]);
    }

    /**
     * @Route("/add-block-prize", name="add-block-prize")
     */
    public function addBLockPrise(Request $request): Response
    {
        $result = $this->renderView('contest/blocks/prise_block.html.twig', [
        ]);

        return new Response($result, 200, [
            'Content-Type' => 'text/html',
        ]);
    }
}
