<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $formFields =  $request->request->get($form->getName());
            $hash = $this->get('api_hash');
            $userHash = $hash->getHash($formFields['firstname'], $formFields['lastname']);

            if($userHash['status']==true){
                $user->setHash($userHash['hash']);
                /** @var EntityManager $em */
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $msg = 'Nombre y apellido guardado correctamente con el hash '.$userHash['hash'];
            }
            else{
                $msg = $userHash['code'].$userHash['msg'];
            }

            $params['msg'] = $msg;
        }

        $params['form'] = $form->createView();
        return $this->render('default/index.html.twig', $params);
    }
}
