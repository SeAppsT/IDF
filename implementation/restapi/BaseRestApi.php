<?php


class BaseRestApi implements RestApi {

    public DataObject $dataObject;
    private string $contextPath;
    public string $connectionType = 'Sql';

    function addCreateHandler(){
        Shopin::addRequestHandler(function (Request $request){
            $entity = $request -> getModel(Shopin::getRestApi($request -> queryString()[0]) -> dataObject -> getDomain());
            if (!$this -> isDataObjectMethodExists('createOperation')) {
                Shopin::getRestApi($request -> queryString()[0]) -> dataObject -> setDomain($entity);
                Shopin::getMapperImplementation(Shopin::getRestApi($request -> queryString()[0]) -> connectionType) -> insert(Shopin::getRestApi($request->queryString()[0])->dataObject);
            } else {
                Shopin::getRestApi($request -> queryString()[0]) -> dataObject -> createOperation($entity);
            }
        })
            -> setPath($this -> contextPath.'/')
            -> addMethod('POST');
    }

    private function isDataObjectMethodExists(string $name){

    }

    function addUpdateHandler(){
        Shopin::addRequestHandler(function (Request $request){
            $entity = $request -> getModel(Shopin::getRestApi($request -> queryString()[0]) -> dataObject -> getDomain());
            $id = Shopin::getRestApi($request -> queryString()[0]) -> dataObject -> getCredentials()['identifier'];
            $entity -> $id = $request -> pathVariable('id');
            Shopin::getRestApi($request -> queryString()[0]) -> dataObject -> setDomain($entity);
            Shopin::getMapperImplementation(Shopin::getRestApi($request -> queryString()[0]) -> connectionType) -> insert(Shopin::getRestApi($request -> queryString()[0]) -> dataObject);
        })
            -> setPath($this -> contextPath.'/{id}/')
            -> addMethod('PUT');
    }

    function addReadHandler(){
        Shopin::addRequestHandler(function (Request $request){
            $query = new Query('get', Shopin::getRestApi($request -> queryString()[0]) -> dataObject);
            return new JsonResponse($query -> go());
        })
            -> setPath($this -> contextPath.'/')
            -> addMethod('GET');
    }

    function addReadOneHandler(){
        Shopin::addRequestHandler(function (Request $request){
            $query = new Query('one', Shopin::getRestApi($request -> queryString()[0]) -> dataObject);
            return new JsonResponse($query
                -> search(Shopin::getRestApi($request -> queryString()[0]) -> dataObject
                    -> getCredentials()['identifier'], equals($request -> pathVariable('id')))
                -> go());
        })
            -> setPath($this -> contextPath.'/{id}/')
            -> addMethod('GET');
    }

    function addDeleteHandler(){
        Shopin::addRequestHandler(function (Request $request){
            $query = new Query('del', Shopin::getRestApi($request -> queryString()[0]) -> dataObject);
            return new JsonResponse($query
                -> search(Shopin::getRestApi($request -> queryString()[0]) -> dataObject
                    -> getCredentials()['identifier'], equals($request -> pathVariable('id')))
                -> go());
        })
            -> setPath($this -> contextPath.'/{id}/')
            -> addMethod('DELETE');
    }

    function setContextPath(string $contextPath){
        $this -> contextPath = $contextPath;
    }

    function addAllHandlers(){
        $this -> addCreateHandler();
        $this -> addUpdateHandler();
        $this -> addReadHandler();
        $this -> addReadOneHandler();
        $this -> addDeleteHandler();
    }

    function setDataObject(DataObject $dataObject){
        $this -> dataObject = $dataObject;
    }

    function getContextPath(){
        return $this -> contextPath;
    }
}