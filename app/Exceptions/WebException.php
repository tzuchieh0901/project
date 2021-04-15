<?php

namespace App\Exceptions;

use Exception;

class WebException extends Exception
{
    /**
     * WebException constructor.
     * @param string $message
     * @param string $code
     */
    public function __construct(
        $message = 'web 回傳錯誤，請洽相關人員',
        $code = 500
    ) {
        parent::__construct($message, $code);
    }
}
