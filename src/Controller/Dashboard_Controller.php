<?php


namespace App\Controller;


use App\Entity\Client;
use App\Entity\User;
use App\Service\Email;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class Dashboard_Controller extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     * @throws \Exception
     */
    public function index()
    {
        $em =$this->getDoctrine()->getRepository(Client::class)->findAll();
        $nbrerappel=0;
        $nbrerappeloublie=0;
        $nbreprospect=0;
        $nbrerefuse=0;


        foreach ($em as $client)
        {
            if($client->getRdvvalide()=="Non Valide") {
                $time = new \DateTime();
                $time->setTimezone(new \DateTimeZone('Europe/Paris'));


                $d1 = strtotime($time->format('Y-m-d H:i:s'));
                $d2 = strtotime($client->getDateRappelTa()->format('Y-m-d') . $client->getHeureRappelTa()->format('H:i:s'));
                $totalSecondsDiff = abs($d2 - $d1); //42600225
                $totalMinutesDiff = $totalSecondsDiff / 60; //710003.75


                if ($totalMinutesDiff < 60 && $d2 > $d1) {
                    $nbrerappel++;
                } else if ($d1 > $d2) {
                    $nbrerappeloublie++;
                }

                $d4 = strtotime($time->format('Y-d-m'));
                $d3 = strtotime($client->getDateCreation()->format('Y-m-d'));
                $totalSecondsDiff2 = abs($d3 - $d4);
                if ($totalSecondsDiff2 == 0) {
                    $nbreprospect++;
                }
            }
            elseif($client->getRdvvalide()=="refus") {
                $nbrerefuse++;
            }
        }
        return $this->render("dashboard.html.twig",["nbrerappel"=>$nbrerappel,"nbrerappeloublie"=>$nbrerappeloublie,"nbreprospect"=>$nbreprospect,"nbrerefuse"=>$nbrerefuse]);
    }

    /**
     * @Route("/import",name="client-umport",methods={"POST"})
     */
    public function UploadElevesFile(Request $request){
        $report=[];
        $fileData = $request->files->get('file');

        $row = 1;
        $res=array();
        if (($handle = fopen($fileData->getRealPath(), 'r+')) !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $row++;
                $res[]=["email"=>$data[0],"nom"=>$data[1]];


            }
            fclose($handle);
            unset($res[0]);

        }
//        foreach ($res as $v)
//        {
//
//
//            $user->setEmail($v["email"]);
//
//
//        }
        return $this->json(json_encode($res));

    }

    /**
     * @Route("/insertion", name="insertion")
     * @throws \Exception
     */
    public function insertion(Request $request)
    {
        $client =new Client();
        $client->setNumeroDossier($request->get('Numero_de_dossier'));
        $client->setActivite($request->get('activite_client'));
        $client->setAdresse($request->get('adresse_client'));
        $client->setBudget($request->get('budget_client'));
        $client->setCommentaire($request->get('commentaires'));
        $client->setDisponibilite($request->get('disponibilite_rappel'));
        $client->setCp($request->get('CP_client'));
//        $client->setConfirmateur(80);
        $client->setEmail($request->get('email_client'));
        $client->setMatiere($request->get('client_domain'));
        $client->setMontant($request->get('Montant'));
        $client->setPrenom($request->get('prenom_client'));
        $client->setNom($request->get('nom_client'));
        $client->setStatut($request->get('statut_client_select'));
        $client->setOrganisme($request->get('id_of'));
        $client->setDateAffectation(new \DateTime($request->get('date_affectation')));
        $client->setDateCreation(new \DateTime($request->get('date_creation')));
        $client->setDateDeNaissance(new \DateTime($request->get('date_naissance_client')));
        $client->setVille($request->get('ville_client'));
        $user=$this->getDoctrine()->getRepository(User::class)->find($request->get('conseiller_client'));
        $client->setTa($user);
        $client->setTel1($request->get('tel1_client'));
        $client->setTel2($request->get('tel2_client'));
        $client->setTypeDeFiche($request->get('source_client'));
        $client->setDateRappelTa(new \DateTime($request->get('date_rappel_TA')));
        $client->setHeureRappelTa(new \DateTime($request->get('heure_rappel_TA')));


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();
        return $this->redirect("/clients");      }

    /**
     * @Route("/clients", name="listeclient")
     */
    public function listeclient()
    {
        $em =$this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render("listeclient.html.twig",["listeclient"=>$em]);
    }


    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteclient($id)
    {
        $formation =$this->getDoctrine()->getRepository(Client::class)->find($id);

        $em=$this->getDoctrine()->getManager();
        $em->remove($formation);
        $em->flush();
        return $this->redirect("/clients");      }


    /**
     * @Route("/details/{id}", name="details")
     */
    public function detailsclient($id)
    {
        $em =$this->getDoctrine()->getRepository(Client::class)->find($id);
//     var_dump($em->getDateRappelTa()->format('Y-m-d').$em->getHeureRappelTa()->format('H:i:s'));
//     die();
        return $this->render("clientdetails.html.twig",["client"=>$em]);

    }

    /**
     * @Route("/rappel/{etat}", name="rappel")
     * @throws \Exception
     */
    public function rdv($etat)
    {
        $em =$this->getDoctrine()->getRepository(Client::class)->findAll();


            $listclient= array();

            if($etat=="PROSPECTS-DU-JOUR") {
                foreach ($em as $client)
                {

                    if($client->getRdvvalide()=="Non Valide") {
                        $time = new \DateTime();
                        $time->setTimezone(new \DateTimeZone('Europe/Paris'));
                        $d4 = strtotime($time->format('Y-d-m'));
                        $d3 = strtotime($client->getDateCreation()->format('Y-m-d'));
                        $totalSecondsDiff2 = abs($d3 - $d4);
                        if ($totalSecondsDiff2 == 0) {
                            array_push($listclient,$client);
                        }
                    }


                }

            }else if($etat=="RAPPELS-DU-JOUR") {
                foreach ($em as $client)
                {

                    if($client->getRdvvalide()=="Non Valide") {
                        $time = new \DateTime();
                        $time->setTimezone(new \DateTimeZone('Europe/Paris'));


                        $d1 = strtotime($time->format('Y-m-d H:i:s'));
                        $d2 = strtotime($client->getDateRappelTa()->format('Y-m-d') . $client->getHeureRappelTa()->format('H:i:s'));
                        $totalSecondsDiff = abs($d2 - $d1); //42600225
                        $totalMinutesDiff = $totalSecondsDiff / 60; //710003.75


                        if ($totalMinutesDiff < 60 && $d2 > $d1) {
                            array_push($listclient,$client);
                        }


                    }


                }


            } else if($etat=="RAPPELS-OUBLIÉS") {
                foreach ($em as $client)
                {

                    if($client->getRdvvalide()=="Non Valide") {
                        $time = new \DateTime();
                        $time->setTimezone(new \DateTimeZone('Europe/Paris'));


                        $d1 = strtotime($time->format('Y-m-d H:i:s'));
                        $d2 = strtotime($client->getDateRappelTa()->format('Y-m-d') . $client->getHeureRappelTa()->format('H:i:s'));
                        $totalSecondsDiff = abs($d2 - $d1); //42600225
                        $totalMinutesDiff = $totalSecondsDiff / 60; //710003.75


                        if ($d1 > $d2) {
                            array_push($listclient,$client);
                        }


                    }


                }


            }else if($etat=="REFUS")  {
                foreach ($em as $client)
                {

                    if($client->getRdvvalide()=="refus") {

                        array_push($listclient,$client);

                    }


                }


            }
        return $this->render("listerdv.html.twig",["clients"=>$listclient]);
    }

    /**
     * @Route("/refus/{id}", name="refus")
     */
    public function refus($id)
    {
        $client =$this->getDoctrine()->getRepository(Client::class)->find($id);
        $client->setRdvvalide("refus");
        $em=$this->getDoctrine()->getManager();
        $em->persist($client);
         $em->flush();
        return $this->redirect("/");
    }
}