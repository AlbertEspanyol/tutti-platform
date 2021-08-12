<?php

namespace App\Http\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class RegisterController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    //Agafem les dades introduïdes per l'usuari i les comprovem
    public function create(Request $request, Response $response): Response
    {
        //Si no s'escriu res al formulari no executem res més
        if(empty($_POST)){
            exit;
        }

        try {
            //Obtenim les dades que l'usuari ha introduït al formulari
            $data = $request->getParsedBody();

            //Comprovem si les dades son correctes usant una funció que rep el mail i la contrassenya
            $errors = $this->checkDades($data['username'],$data['email'], $data['password']);

            //Obtenim tots els mails de la nostra BBDD
            $allmails = $this->container->get('user_repository')->getInfo("email");

            //Comprovem si el mail introduït ja existeix (FUNCIONALITAT EXTRA TOT I QUE L'ENUNCIAT NO HO DEMANA)
            foreach ($allmails as $a){
                if($a == $data['email']){
                    $errors[0] = "This user already exists";
                }
            }

            //Errors està format per tants paràmetres com valors es demanen al formulari.
            //Si no hi ha cap error al paràmetre, equivaldrà a "nice"
            if ($errors[0] != "nice" || $errors[1] != "nice" || $errors[2] != "nice") {

                //En cas que hi hagi algún error el mostrarem.
                //La variable "formReg" serà true si el formulari és de Registre i false si és de Login
                return $this->container->get('view')->render(
                    $response,
                    'formLog.twig',
                    [
                        'formReg' => true,
                        'usernameErr' => $errors[0],
                        'emailErr' => $errors[1],
                        'passErr' => $errors[2],
                        'username' => $data['username'],
                        'email' => $data['email'],
                        'pass' => $data['password']
                    ]
                );
            }

            //Creem un nou usuari amb les dades que li passem
            $user = new User(
                $data['username'] ?? '',
                $data['email'] ?? '',
                ($data['password']) ?? '',
                new DateTime(),
                new DateTime()
            );

            //Guardem l'usuari a la BBDD
            $this->container->get('user_repository')->save($user);

            //Iniciem la sessió al usuari
            $id = $this->container->get('user_repository')->getId($data['email']);
            $_SESSION['user_id'] = $id;

        } catch (Exception $exception) {
            $response->getBody()
                ->write('Unexpected error: ' . $exception->getMessage());
            return $response->withStatus(500);
        }

        //Si no hi ha cap paràmetre incorrecte, passem a la vista principal
        return $this->container->get('view')->render(
            $response,
            'home.twig',
            [
                'logged' => true
            ]
        );
    }

    //Funció per mostrar la vista del registre
    public function showRegister(){
        $param1 = 0;
        $param2 = 'value';
        $param3 = 'value';
        return view('register', compact('param1','param2','param3'));
    }

    //Funció que comprova si les dades de l'usuari són vàlides segons la normativa de l'enunciat
    public function checkDades(?string $username, ?string $email, ?string $password): array
    {
        //S'inicialitza l'array de errors
        $errors = ["nice","nice", "nice"];

        //Comprovem si el username és vàlid
        if ($username == null || $username == "" || $username == " ") {
            $errors[0] = sprintf('The username is empty');
        } else {

            //Surt error si és més llarg de 10 o té un número
            if (preg_match('~[0-9]+~', $username)|| strlen($password) > 10){
                $errors[0] = "The username is not valid";
            }
        }

        //Comprovem si el mail és vàlid
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[1] = sprintf('The email is not valid');
        }

        //Comprovem les condicions de la contrassenya de l'enunciat
        if($password != " " || $password != null) {
            if (strlen($password) < 6 || strlen($password) > 12) {
                $errors[2] = sprintf('The password is not valid');
            }
        }

        return $errors;
    }

}
