<?php

class ExampleClass {
    private $property;

    public function __construct() {
        $this->property = 'Some value';
    }

    public function getProperty() {
        return $this->property;
    }

    public function setProperty($value) {
        $this->$property = $value; // Typo: should be $this->property
    }

    public function printMessage() {
        echo "This is a test message" . PHP_EOL;
    }
}

// Usage of the ExampleClass
$exampleObject = new ExampleClass();
echo $exampleObject->getProperty() . PHP_EOL;

// Unused variable
$unusedVariable = 'This variable is unused';

// Undefined variable
echo $undefinedVariable . PHP_EOL;

// Function with too many arguments
function addNumbers($a, $b, $c, $d) {
    return $a + $b + $c + $d;
}

// Call to undefined function
callUndefinedFunction();

// Syntax error
echo "Missing semicolon"; // Missing semicolon here