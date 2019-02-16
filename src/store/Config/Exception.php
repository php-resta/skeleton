<?php

namespace Store\Config;

class Exception
{

    /**
     * project exception handler for local.
     *
     * class exception container call access for every service.
     * @return array
     */
    public static function local($errNo=null, $errStr=null, $errFile=null, $errLine=null,$errType=null, $lang=null)
    {
        return [

            /**
             * Error file.
             * @key errorFile
             * @value $errFile
             */
            'errorFile'=>$errFile,

            /**
             * Error Line.
             * @key errorLine
             * @value $errLine
             */
            'errorLine'=>$errLine,

            /**
             * Error Type.
             * @key errorType
             * @value $errType
             */
            'errorType'=>$errType,

            /**
             * Error String.
             * @key errorString
             * @value $errStr
             */
            'errorMessage'=>$errStr,

            /**
             * Error No.
             * @key errorNo
             * @value $errNo
             */
            'errorNo'=>$errNo,
        ];
    }

    /**
     * @param null $errNo
     * @param null $errStr
     * @param null $errFile
     * @param null $errLine
     * @param null $errType
     * @param null $lang
     * @return array
     */
    public static function production($errNo=null, $errStr=null, $errFile=null, $errLine=null,$errType=null, $lang=null,$external=null)
    {

        return [

            /**
             * Error file.
             * @key errorFile
             * @value $errFile
             */
            //'errorFile'=>$errFile,

            /**
             * Error Line.
             * @key errorLine
             * @value $errLine
             */
            //'errorLine'=>$errLine,

            /**
             * Error Type.
             * @key errorType
             * @value $errType
             */
            //'errorType'=>$errType,

            /**
             * Error String.
             * @key errorString
             * @value $errStr
             */
            'errorMessage'=>$errStr,

            /**
             * Error No.
             * @key errorNo
             * @value $errNo
             */
            //'errorNo'=>$errNo,
        ];
    }

    /**
     * project exception type codes handler.
     *
     * class exception type codes call access for every service.
     *
     * @param string
     * @return array
     */
    public static function exceptionTypeCodes($type=null){

        $exceptionTypes=[

            /**
             * UndefinedCallException.
             *
             * @define Exception thrown if a callback refers to an undefined function
             * or if some arguments are missing.
             */
            'Undefined'=>500,

            /**
             * BadFunctionCallException.
             *
             * @define Exception thrown if a callback refers to an undefined function
             * or if some arguments are missing.
             */
            'BadFunctionCallException'=>500,

            /**
             * BadMethodCallException.
             *
             * @define Exception thrown if a callback refers to an undefined method
             * or if some arguments are missing.
             */
            'BadMethodCallException'=>500,

            /**
             * DomainException.
             *
             * @define Exception thrown if a value does not adhere to a defined valid data domain.
             */
            'DomainException'=>401,

            /**
             * InvalidArgumentException.
             *
             * @define Exception thrown if an argument is not of the expected type.
             */
            'InvalidArgumentException'=>400,

            /**
             * LengthException.
             *
             * @define Exception thrown if a length is invalid.
             */
            'LengthException'=>400,

            /**
             * LogicException.
             *
             * @define Exception that represents error in the program logic.
             * This kind of exception should lead directly to a fix in your code.
             */
            'LogicException'=>400,

            /**
             * OutOfBoundsException.
             *
             * @define Exception thrown if a value is not a valid key.
             * This represents errors that cannot be detected at compile time.
             */
            'OutOfBoundsException'=>400,

            /**
             * OutOfRangeException.
             *
             * @define Exception thrown when an illegal index was requested.
             * This represents errors that should be detected at compile time.
             */
            'OutOfRangeException'=>400,

            /**
             * OverflowException.
             *
             * @define Exception thrown when adding an element to a full container.
             */
            'OverflowException'=>400,

            /**
             * RangeException.
             *
             * @define Exception thrown to indicate range errors during program execution.
             * Normally this means there was an arithmetic error other than under/overflow.
             * This is the runtime version of DomainException.
             */
            'RangeException'=>400,

            /**
             * RuntimeException.
             *
             * @define Exception thrown if an error which can only be found on runtime occurs.
             */
            'RuntimeException'=>400,

            /**
             * UnderflowException.
             *
             * @define Exception thrown when performing an invalid operation on an empty container,
             * such as removing an element.
             */
            'UnderflowException'=>400,

            /**
             * UnexpectedValueException.
             *
             * @define Exception thrown if a value does not match with a set of values.
             * Typically this happens when a function calls another function and expects
             * the return value to be of a certain type or value not including arithmetic or buffer related errors.
             */
            'UnexpectedValueException'=>400
        ];

        if($type!==null){
            return (isset($exceptionTypes[$type])) ? $exceptionTypes[$type] : $exceptionTypes['BadFunctionCallException'] ;
        }
        return $exceptionTypes;


    }

}
