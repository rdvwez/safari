<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration()
    {
        $user  = new User();
        $form =  $this->createForm(RegistrationType::class,$user);
        return $this->render('security/registration.html.twig',[
          'form' => $form->createView()
        ]);

        //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/SecurityController.php',
    //     ]);
    }
}
