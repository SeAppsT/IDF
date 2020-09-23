<?php



class Source{

    private static array $connections = Array();
    private static array $paths = Array();
    private static array $implementations = Array(
        'mappers' => [],
    );
    public static bool $debug = false;

    public static function configure($path, $method = 'json'){
        $config_info = file_get_contents($path);
        if ($method = 'json')
            $config_info = json_decode($config_info);
        else if ($method = 'yaml')
            $config_info = yaml_parse($config_info);
        else if ($method = 'xml')
            $config_info = xml_parse('', $config_info);
        foreach ($config_info -> connections -> sql as $db_connection){
            if ($db_connection -> type == 'mysql') {
                $pdo = new PDO($db_connection -> type.':host=' .$db_connection -> hostname.';dbname='.$db_connection -> database, $db_connection -> username, $db_connection -> password);
                self::$connections[$db_connection -> connection_name] = Source::getMapperImplementation('Sql');
                self::$connections[$db_connection -> connection_name] -> setDbHandler($pdo);
            }
        }
    }

    public static function addRequestHandler(Closure $action): RequestHandler {
        $requestHandler = Source::getRequestHandlerImplementation('Base');
        $requestHandler -> setAction($action);
        self::$paths[] = $requestHandler;
        return self::$paths[count(self::$paths) - 1];
    }

    private function readDir($name): array {
        return Array();
    }

    public static function build(){

        foreach (glob("core{/*, /*/*, /*/*/*, /*/*/*/*}/*.php", GLOB_BRACE) as $component){
            require_once $component;
        }

        foreach (glob("implementation{/*, /*/*, /*/*/*}/*.php", GLOB_BRACE) as $component){
            require_once $component;
        }

        foreach (glob("app/*/*/*.php", GLOB_BRACE) as $component){
            require_once $component;
        }
    }

    public static function getConnection($name): Mapper {
        return self::$connections[$name];
    }

    public static function getMapperImplementation($type): Mapper {
        return new self::$implementations['mappers'][$type]();
    }

    public static function addMapperImplementation($name){
        self::$implementations['mappers'][explode('Mapper', $name)[0]] = $name;
    }

    public static function getRequestHandlerImplementation($type): RequestHandler {
        return new self::$implementations['request_handlers'][$type];
    }

    public static function addRequestHandlerImplementation($name){
        self::$implementations['request_handlers'][explode('RequestHandler', $name)[0]] = $name;
    }

    public static function getSessionImplementation($type): Session{
        return new self::$implementations['sessions'][$type];
    }

    public static function addSessionImplementation($name){
        self::$implementations['sessions'][explode('Session', $name)[0]] = $name;
    }

    public static function start(Request $request){
        foreach (self::$paths as $requestHandler){
            if ($requestHandler -> isItOk($request -> queryString())) {
                $request -> collectInformation($requestHandler);
                $requestHandler -> action -> call($request, $request);
            }
        }
    }
}