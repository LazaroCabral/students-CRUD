<?php

namespace Lazaro\StudentCrud\Input\Utils\Enums;

enum STUDENT_INPUT_NAMES: string{
    case ID="id";
    case NAME="name";
    case EMAIL="email";
    case PHONE="phone";
    case VALUE_PER_MONTH ="value_per_month";
    case PASSWORD="password";
    case STATUS="status";
    case OBSERVATION="observation";
}