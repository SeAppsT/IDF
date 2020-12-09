<?php


interface RestApi {
    function setContextPath(string $contextPath);
    function getContextPath();
    function setDataObject(DataObject $dataObject);
    function addAllHandlers();
    function addCreateHandler();
    function addUpdateHandler();
    function addReadHandler();
    function addReadOneHandler();
    function addDeleteHandler();
}