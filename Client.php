<?php

use GuzzleHttp\Client as GuzzleClient;

class Client {

    protected $_token = "";
    protected $_username = "";
    protected $_password = "";
    protected $_baseUrl = "";

    /**
     * Représente le curl qui se connecte à l'api
     * @var GuzzleClient
     */
    protected $_connection;

    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    public const PATCH = 'PATCH';

    public function __construct($username, $password, $baseurl) {
        $this->_username = $username;
        $this->_password = $password;
        $this->_baseUrl = $baseurl;
        $this->_connection = new GuzzleClient(['base_uri' => $baseurl]);
    }

    /**
     * Retourne le token d'authentification de la session
     * @return string
     */
    public function getToken():string
    {
        return $this->_token;
    }

    /**
     * Authentifie l'utilisateur et retourne le token d'authentification
     * @return string
     */
    public function login():string
    {
        $params = [
            'json' => [
                'username' => $this->_username,
                'password' => $this->_password,
                ]
            ];
        $response = $this->execute(self::POST, "login", $params);
        $this->_token = $response['token'];
        return $this->_token;
    }

    /**
     * Recupère les informations sur le site passé en paramètre
     * @var string $idSite
     * @return array
    */
    public function getSiteInfos(string $idSite):array
    {
        $uri = sprintf("sites/%s", $idSite);
        $params = [
            "headers" => [
                'Authorization' => 'Bearer ' . $this->_token,
                'Accept'        => 'application/json',
            ]
        ];
        return $this->execute(self::GET, $uri, $params);
    }

    /**
     * Retourne les informations sur le rapport passé en paramètre
     *
     * @param string $idRapport
     * @return array
     */
    public function getRapportInfos(string $idRapport):array
    {
        $uri = sprintf("rapports/%s", $idRapport);

        $params = [
            "headers" => [
                'Authorization' => 'Bearer ' . $this->_token,
                'Accept'        => 'application/json',
            ]
        ];
        return $this->execute(self::GET, $uri, $params);
    }

    /**
     * Retourne les résultats de positions pour le rapport passé en paramètre
     * Paramètres obligatoires :
     *  "date" => (string) format : AAAA-MM-JJ la date du rapport auquel on veut les résultats
     *  "outId" => (int/string) l'id de l'outil sur lequel on veut des résultats
     * Paramètres disponibles :
     *  "expressionId" => (int|string) l'id de l'expression
     *  "pagination" => "true|false" (string)
     *  "itemsPerPage" => (int|string) nombre d'items à afficher par page
     *  "page" => (int|string) page demandée
     *
     * @param string $idRapport
     * @param array|null $apiParams
     * @return array
     */
    public function getRapportPositionsResultats(string $idRapport, ?array $apiParams = null):array
    {
        $uri = sprintf("rapports/%s/positions/resultats/", $idRapport);

        if ($apiParams !== null) {
            $uri.="?".http_build_query($apiParams,"","&",);
        }

        $params = [
            "headers" => [
                'Authorization' => 'Bearer ' . $this->_token,
                'Accept'        => 'application/json',
            ]
        ];
        return $this->execute(self::GET, $uri, $params);
    }

    /**
     * Retourne les dates du rapport dont l'id est passé en paramètre
     * Paramètres disponibles :
     *  "pagination" => "true|false" (string)
     *  "itemsPerPage" => (int|string) nombre d'items à afficher par page
     *  "page" => (int|string) page demandée
     *
     * @param string $idRapport
     * @param array|null $apiParams
     * @return array
     */
    public function getRapportDates(string $idRapport, ?array $apiParams = null): array
    {
        $uri = sprintf("rapports_dates?racId=%s", $idRapport);

        if ($apiParams !== null) {
            $uri.="&".http_build_query($apiParams,"","&",);
        }

        $params = [
            "headers" => [
                'Authorization' => 'Bearer ' . $this->_token,
                'Accept'        => 'application/json',
            ]
        ];
        return $this->execute(self::GET, $uri, $params);
    }

    /**
     * Retourne toutes les expressions liées à un rapport.
     * Paramètres disponibles :
     *  "pagination" => "true|false" (string)
     *  "itemsPerPage" => (int|string) nombre d'items à afficher par page
     *  "page" => (int|string) page demandée
     *
     * @param string $idRapport
     * @param array|null $apiParams
     * @return array
     */
    public function getRapportExpressionsLiees(string $idRapport, ?array $apiParams = null):array
    {
        $uri = "rapports/expressions";

        $apiParams['racId'] = $idRapport;

        if ($apiParams !== null) {
            $uri.="?".http_build_query($apiParams,"","&",);
        }

        $params = [
            "headers" => [
                'Authorization' => 'Bearer ' . $this->_token,
                'Accept'        => 'application/json',
            ]
        ];
        return $this->execute(self::GET, $uri, $params);
    }

    /**
     * Effectue un appel vers l'url $url en utilisant la méthode $method en passant les paramètres $params
     * Retourne le résultat de l'appel sous la forme d'un tableau
     * @param string $method Il est préférable d'utiliser les constantes de la classe client
     * @param string $url Uri relative à l'url de base de l'api. Une url absolue peut également être utilisée
     * @param array $params
     * @return array
     */
    public function execute($method=self::GET, string $url, ?array  $params=null):array
    {
        try {
            $response = $this->_connection->$method($url, $params);
            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $exp) {
            throw new Exception(
                $exp->getMessage(),
                $url,
                $method,
                sprintf("Erreur %s lors de l'appel de %s",
                    $exp->getCode(),
                    $url),
                $exp->getCode()
            );
        }
    }
}
