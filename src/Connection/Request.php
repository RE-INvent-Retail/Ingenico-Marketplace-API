<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection;


use asdfklgash\IngenicoMarketplaceAPI\Connection\Exceptions\BadRequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\TransferStats;
use mysql_xdevapi\Exception;

class Request
{

    private $_connection = null;
    private $_url        = null;

    private $_request = null;
    private $_uri = null;

    private $_data = null;

    public function __construct( Connection $connection, $url )
    {
        $this->_connection = $connection;
        $this->_url = $url;
    }

    public function __call( $name, $arguments ) : Response
    {

        $response = new Response( $this->_connection, $this );

        try
        {
            switch( strtoupper( $name ) )
            {
                case 'GET':
                    $request_method = 'GET';
                    $request_options = [ 'query' => $this->_data ];
                    break;
                case 'POST':
                    $request_method = 'POST';
                    $request_options = [ 'json' => $this->_data ];
                    break;
                case 'PUT':
                    $request_method = 'PUT';
                    $request_options = [ 'query' => $this->_data ];
                    break;
                case 'DELETE':
                    $request_method = 'DELETE';
                    $request_options = [ 'query' => $this->_data ];
                    break;
                default:
                    throw new \Exception( 'Method ' . $name . ' not implemented in ' . __CLASS__ );    // TODO - new Exception!
            }

            $request_options[ 'on_stats' ] = function (TransferStats $stats) {
                $this->_uri = $stats->getEffectiveUri();
            };

            if( $this->_connection->isDebug() )
                $request_options[ 'debug' ] = true;

            $this->_request = $this->_createRequest( $request_method, $this->_url );
            $result = $this->_connection->send( $this->_request, $request_options );
        }
        catch( ServerException $e )
        {
            $result = $e->getResponse();
            $response->setError( $e );
        }
        catch( ClientException $e )
        {
            $result = $e->getResponse();
            switch( $result->getStatusCode() )
            {
                case 400:  // Bad Request
                    $ingenico_error = new BadRequestException( $result->getStatusCode(), $result->getReasonPhrase(), $result->getBody() );
                    break;
            }
            $response->setError( $e );
        }
        catch( \Exception | \Throwable $e )
        {
            $result = $e->getResponse();
            $response->setError( $e );
        }
        finally
        {
            $response->setResult( $result );
        }

        return $response;

    }

    public function setData( $data )
    {
        $this->_data = $data;
    }

    private function _createRequest( $method, $url )
    {
        $request = new \GuzzleHttp\Psr7\Request( $method, $url );
        return $request;
    }

    public function getRequest()
    {
        return $this->_request;
    }

    public function getUri()
    {
        return $this->_uri;
    }

}