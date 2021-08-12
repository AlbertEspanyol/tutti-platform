<?php

namespace App\Http\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

final class LoginController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function logIn(Request $request, Response $response): Response
    {
        if(empty($_POST)){
            exit;
        }

        try {
            $data = $request->getParsedBody();

            //Comprovació de les dades
            $errors = $this->checkDades($data['email'], $data['password']);

            //Obtenim tots els mails de la BBDD
            $allmails = $this->container->get('user_repository')->getInfo('email');

            $flag = false;

            //Comprovem si hi ha un mail que sigui igual al que s'ha entrat al formulari de login
            foreach ($allmails as $a){
                if($a == $data['email']){
                    $flag = true;
                 }
            }

            //Comprovem si existeix l'usuari
            if(!$flag){
                $errors[0] = "This user does not exist";
            } else{
                //En cas que l'usuari existeixi verifiquem que les contrassenyes siguin iguals
                $checkPass = $this->container->get('user_repository')->getPass($data['email']);

                //En cas que el tipus de camp de la DB no sigui molt curt, es pot fer encriptació amb MD5 de la contrassenya per fer la comprovació
                //md5($data['password'])
                if(($data['password']) != $checkPass){
                    $errors[1] = "The password is incorrect";
                }
            }

            //En cas que hi hagi algún error es mostra per pantalla
            if ($errors[0] != "nice" || $errors[1] != "nice") {
                return $this->container->get('view')->render(
                    $response,
                    'formLog.twig',
                    [
                        'isReg' => false,
                        'emailErr' => $errors[0],
                        'passErr' => $errors[1],
                        'email' => $data['email'],
                        'pass' => $data['password'],
                    ]
                );
            }

            //Iniciem la sessió al usuari
            $id = $this->container->get('user_repository')->getId($data['email']);
            $_SESSION['user_id'] = $id;

            //Si tot esta correcte es mostra la llista
            return $response->withHeader('Location', '/notebook')->withStatus(302);

        } catch (Exception $exception) {
            $response->getBody()
                ->write('Unexpected error: ' . $exception->getMessage());
            return $response->withStatus(500);
        }
    }

    //Funció per mostrar la vista del login
    public function showLogin(){
        $param1 = 0;
        $param2 = 'value';
        $param3 = 'value';
        return view('login', compact('param1','param2','param3'));
    }

    //Funció que comprova si les dades de l'usuari són vàlides segons la normativa de l'enunciat
    public function checkDades(?string $email, ?string $password): array
    {
        //S'inicialitza l'array de errors
        $errors = ["nice", "nice"];

        //Comprovem si el mail és vàlid
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[0] = sprintf('The email is not valid');
        }

        //Comprovem la condició de la contrassenya de l'enunciat
        if($password != " " || $password != null) {
            if (strlen($password) < 6) {
                $errors[1] = sprintf('The password is not valid');
            }
        }

        return $errors;
    }
}
