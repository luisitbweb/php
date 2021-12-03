<?php
interface IConnectInfo{
const HOST     = 'localhost';
const UNAME    = 'luiscarlos';
const DBNAME   = 'comicbook_fansite';
const PW       = 'mother';

function testConnection();
}