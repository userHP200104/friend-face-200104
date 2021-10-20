<?php 

    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    use App\Entity\Mood;

    //class controller for homeController
    class HomeController extends AbstractController 
    {
        /** 
         * @Route("/", name="index")
         */
        public function helloWorld()
        {
            
            return new Response(
                '<html><body><h1>Hello World</h1></body></html>'
            );
        }

         /** 
         * @Route("/moods", name="all_moods")
         */
        public function viewMoods(Request $request)
        {
            //if it is a POST
            if($request->isXmlHttpRequest()) { //if we are receiving a HTTP request
                //get the POST data - id
                $moodId = $_POST['id'];
                $likes = 0; //default

                $entityManager = $this->getDoctrine()->getManager();
                //get the mood that was liked
                $mood = $entityManager->getRepository(Mood::class)->find($moodId);
                //update the likes to the moods current count - using the getter
                $likes = $mood->getLikesCount();
                //update our entity using the setter
                $mood->setLikesCount($likes + 1);

                //TODO: - Add mood id and user id to likes table

                $entityManager->flush();

                return $likes + 1;

            }
            //else just do the normal return

            //using the Entity & Doctrine to get our Database data
            $moods = $this->getDoctrine()
             ->getRepository(Mood::class)
             ->findAll(); //findAll() function to get all of our data
             //findBy(array(feeling => 'happy', id => '1')) - to compare more than one field

             //TODO: get the likes

            //create a model
            $model = array('moods' => $moods);

            //return with twig template, specifying the view and data sent to the view
            return $this->render('moods.html.twig', $model);
        }

    }

?>