<?php
/**
 * Created by PhpStorm.
 * User: bzgras
 * Date: 13.07.2016
 * Time: 07:54
 */
class ConnectionHandler
{
    /**
     * Nach dem ersten Aufruf der getConnection Methode wird hier die Verbindung
     * für die weiteren Aufrufe dieser Methode zwischengespeichert. Dadurch muss
     * nicht für jedes Query eine neue Verbindung geöffnet werden.
     */
    private static $connection = null;
    /**
     * Der ConnectionHandler implementiert das sogenannte Singleton
     * Entwurfsmuster bei dem es gewünscht ist, dass keine Instanzen (new
     * ConnectionHandler()) davon erstellt werden können. Dies kann ganz einfach
     * mit einem solchen privaten Konstruktor realisiert werden.
     */
    private function __construct()
    {
        // Privater Konstruktor um das erstellen von Instanzen zu verhindern
    }
    /**
     * Prüft ob bereits eine Verbindung auf die Datenbank existiert,
     * initialisiert diese ansonsten und gibt sie dann zurück.
     *
     * @throws Exception wenn der Verbindungsaufbau schiefgegeangen ist.
     *
     * @return Die MySQLi Verbindung, welche für den Zugriff aud die Datenbank
     *             verwendet werden kann.
     */
    public static function getConnection()
    {
        // Prüfen ob bereits eine Verbindung existiert
        if (self::$connection === null) {
            // Konfigurationsdatei auslesen
            $config = require 'config.php';
            $host = $config['database']['host'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];
            $database = $config['database']['database'];
            // Verbindung initialisieren
            self::$connection = new MySQLi($host, $username, $password, $database);
            if (self::$connection->connect_error) {
                $error = self::$connection->connect_error;
                throw new Exception("Verbindungsfehler: $error");
            }
            self::$connection->set_charset('utf8');
        }
        // Verbindung zurückgeben
        return self::$connection;
    }
}