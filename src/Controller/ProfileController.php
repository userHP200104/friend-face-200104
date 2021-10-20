<?php 

    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    //using the form builder
    use App\Form\UserProfileType;

    //userprofile entity 
    use App\Entity\UserProfile;

    //class controller for homeController
    class ProfileController extends AbstractController 
    {
        /** 
         * @Route("/profile/{id}", name="view_profile")
         */
        public function viewProfile($id = null) //default id value
        {

            //added some error handling when an id is not supplied
            if($id == null){
                return $this->redirectToRoute('index');
            }

            //access the wildcard
            $userId = (int) $id;
            
            //using the Entity & Doctrine to get our Database data
            $user = $this->getDoctrine()
             ->getRepository(UserProfile::class)
             ->find($userId);

            //create a model
            $model = array('user' => $user);

            //return with twig template, specifying the view and data sent to the view
            return $this->render('profile.html.twig', $model);
        }

        /** 
        * @Route("/register", name="profile_new")
        */
        public function newProfile(Request $request)
        {
            $userProfile = new UserProfile(); //instance of our UserProfile
            $form = $this->createForm(UserProfileType::class, $userProfile); //creating a form using our formBuilder
            $form->handleRequest($request); //let this form we created handle our requests

            //HANDLE FORM SUBMISSION
            //isValid - checks the asserts in our entity
            if($form->isSubmitted() && $form->isValid()){

                $userProfile = $form->getData(); //getData gets the data from the form

                //TODO: - Check if email exists
                //TODO: - Password Hashing

                //manages the creation of the new user using the Entity in our DB
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userProfile);
                $entityManager->flush();

                //TODO: - Set the Session()

                return $this->redirectToRoute("index");


            }

            

            //ELSE SHOW FORM
            $view = 'register.html.twig'; //twig
            $model = array(
                'form' => $form->createView(),
                'title' => "Register Here"
            ); //create our form views

            return $this->render($view, $model);
        }

    }

?>