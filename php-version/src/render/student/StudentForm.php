<?php

namespace Lazaro\StudentCrud\Render\Student;

use Lazaro\StudentCrud\Db\Entities\Student;
use Lazaro\StudentCrud\Render\Student\Utils\StudentRenderUtils;

class StudentForm{

    static function printForm(Student|null $student=null){
        if($student == null){
            $student= new Student(null,null,null,null,null,null,null,null);
        }
        echo "<form action=\"\" method=\"post\">".
                "<input hidden=\"hidden\" name=\"id\" id=\"".$student->getId()."\" value=\"".$student->getId()."\">".
                "<label for=\"name\">Nome</label>".
                "<input type=\"text\" name=\"name\" value=\"".$student->getName()."\">".
                "<label for=\"email\">E-mail</label>".
                "<input type=\"text\" name=\"email\" value=\"".$student->getEmail()."\">".
                "<label for=\"phone\">Telefone</label>".
                "<input type=\"text\" name=\"phone\" value=\"".$student->getPhone()."\">".
                "<label for=\"value_per_month\">Valor por mês</label>".
                "<input type=\"text\" name=\"value_per_month\" value=\"".$student->getValuePerMonth()."\">".
                "<label for=\"password\">Senha</label>".
                "<input type=\"text\" name=\"password\" value=\"".$student->getPassword()."\">".
                "<label for=\"status\">Status</label>".
                StudentRenderUtils::studentStatusIsActive($student->getStatus(),["name=status","type=checkbox","id=".$student->GetId()]).
                "<label for=\"observation\">Observação</label>".
                "<input type=\"text-area\" name=\"observation\" value=\"".$student->getObservation()."\">".
                "<button type=\"submit\">enviar</button>".
            "</form>";
    }
}