<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /** 
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request,ObjectManager $manager,UserPasswordEncoderInterface $encoder)
    {
      

        $user  = new User();
        $form =  $this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
          $hash = $encoder->encoderPassword($user,$user->getPassword());
          $user->setPassword($hash);
          $manager->persist($user);
          $manager->flush();

         return  $this->redirectToRoute('security_login');
        }
        return $this->render('security/registration.html.twig',[
          'form' => $form->createView()
        ]);

        //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/SecurityController.php',
    //     ]);
    }

    /** 
     * @Route("/login", name="security_login")
     */
    public function login()
    {
      return $this->render('security/login.html.twig');
    }

    /** 
     * @Route("/logout", name="security_logout")
     */
    public function logout(){}

}
