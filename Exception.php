<?php
namespace CyberCite\DataGardenApiClient;

class Exception extends \Exception {

    /**
     * Le corps de la réponse http lors de l'erreur 
     * @var string
     */
    protected string $_body;

    /**
     * L'uri appelée lors de l'erreur
     * @var string
     */
    protected string $_uri;

    /**
     * Le code http retourné par l'api (correspond également au code d'exception)
     * @var int
     */
    protected int $_statusCode;

    /**
     * La méthode http employée lors de l'erreur
     * @var string
     */
    protected string $_method;

    public function __construct(string $body, string $uri, string $method, string $message ="", int $code =0) {
        parent::__construct($message, $code);
        $this->_body = $body;
        $this->_uri = $uri;
        $this->_statusCode = $code;
        $this->_method = $method;
        return $this;
    }

    /**
     * Retourne la méthode http employée lors de l'erreur
     * @return string
     */
    public function getMethod():string
    {
        return $this->_method;
    }

    /**
     * Retourne le code de status envoyée par l'api lors de l'erreur
     * @return int
     */
    public function getStatusCode():int
    {
        return $this->_statusCode;
    }

    /**
     * Retourne l'uri qui a été appelée lors de l'erreur
     * @return string
     */
    public function getUri():string
    {
        return $this->_uri;
    }

    /**
     * Retourne le body de l'erreur
     * @return string
     */
    public function getBody():string
    {
        return $this->_body;
    }

}