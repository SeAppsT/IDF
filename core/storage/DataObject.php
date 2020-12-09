<?php


interface DataObject{
    function getCredentials();
    function getFields();
    function __toString();
    function getName();
    function setDomain($domain);
    function getDomain();
}