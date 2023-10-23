<?php
class tools{

    function numRand(){
        return rand(1,9);
    }

    function oper(){
        switch(rand()%3){
            case 0:
                return "*";
                break;
            case 1:
                return "+";
                break;
            case 2:
                return "-";
                break;
        }
    }

    function geneCaptcha(){

        $dato1 = $this -> numRand();
        $dato2 = $this -> numRand();
        $dato3 = $this -> numRand();

        $oper1 = $this -> oper();
        $oper2 = $this -> oper();

        $expression = $dato1 . $oper1 . $dato2 . $oper2 . $dato3;

        $_SESSION['captcha'] = $dato1;

        switch ($oper1) {
            case '*':
                $_SESSION['captcha'] *= $dato2;
                break;
            case '+':
                $_SESSION['captcha'] += $dato2;
                break;
            case '-':
                $_SESSION['captcha'] -= $dato2;
                break;
        }

        switch ($oper2) {
            case '*':
                $_SESSION['captcha'] *= $dato3;
                break;
            case '+':
                $_SESSION['captcha'] += $dato3;
                break;
            case '-':
                $_SESSION['captcha'] -= $dato3;
                break;
        }

        return $expression;
    }   
}

$oTools = new tools;

?>