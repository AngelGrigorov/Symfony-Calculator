<?php

namespace CalculatorBundle\Controller;

use CalculatorBundle\Form\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CalculatorBundle\Entity\Calculator;

class CalculatorController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/", name="index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $calculator = new Calculator();
        $form = $this->createForm(CalculatorType::class,$calculator);
$form->handleRequest($request);
if($form->isSubmitted() && $form->isValid()){
    $leftOperand = $calculator->getLeftOperand();
    $rightOperand = $calculator->getRightOperand();
    $operator = $calculator->getOperator();
    $result = 0;
switch($operator){
    case '+' :
        $result = $leftOperand + $rightOperand;
        break;
    case '-' :
        $result = $leftOperand - $rightOperand;
        break;
    case '*' :
        $result = $leftOperand * $rightOperand;
        break;
    case '/' :
        $result = $leftOperand / $rightOperand;
        break;
    case '%' :
        if($leftOperand % 2 == 1 && $rightOperand % 2 ==1){
            $result = "Both are odd";
        }else if($leftOperand % 2 == 1 && $rightOperand % 2 ==0) {
            $result = "Left operand is odd, right is even";
        }elseif($leftOperand % 2 == 0 && $rightOperand % 2 ==1){
            $result = "Left operand is even, right is odd";
            }
            else{
            $result = "Both are even";
        }
        break;
    case '^' :
        $result = pow($leftOperand ,$rightOperand);
        break;
    case 'NEXT TO' :
        $result = $leftOperand . $rightOperand;
        break;

}
    return $this->render('calculator/index.html.twig',
        ['result' => $result,'calculator' => $calculator, 'form' => $form->createView()]);
}
        return $this->render('calculator/index.html.twig');
    }
}
