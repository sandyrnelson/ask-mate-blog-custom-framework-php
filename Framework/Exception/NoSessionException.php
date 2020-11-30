<?php


namespace BK_Framework\Exception;


use Exception;

/**
 * Class NoSessionException
 *
 * Custom Exception. It should be thrown in cases when a session-variable
 * was attempted to be set/get but session_start method was not called before,
 * thus super-global variable $_SESSION is not accessible
 *
 * @package BK_Framework\Exception
 */
class NoSessionException extends Exception
{

}
