<?php
namespace GFB\RestClientBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 * Class DefaultController
 * @package GFB\RestClientBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/test-rest-client")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return new Response(<<<HTML
<html>
<body>
    <div>You must not see this text! This letter for Hogwards pupils!</div>
</body>
</html>
HTML
    );
    }
}
