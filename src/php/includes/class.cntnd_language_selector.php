<?php

namespace Cntnd\LanguageSelector;

require_once("class.cntnd_util.php");

/**
 * cntnd_language_selector Class
 */
class CntndLanguageSelector extends CntndUtil {

    private $idart;
    private $lang;
    private $client;
    private $showDisabled;

    private $db;

    function __construct($idart, $lang, $client, $showDisabled) {
        $this->idart = $idart;
        $this->lang = $lang;
        $this->client = $client;
        $this->showDisabled = $showDisabled;

        $this->db = new \cDb;
    }

    public function languages() {
        $cfg = \cRegistry::getConfig();
        $languages = array();
        $articles = $this->articles($cfg);

        $sql = "SELECT cl.idlang as idlang, l.name as lang FROM :clients_lang as cl, :lang as l WHERE cl.idclient = :idclient AND cl.idlang = l.idlang";
        $values = array(
            'clients_lang' => $cfg['tab']['clients_lang'],
            'lang' => $cfg['tab']['lang'],
            'idclient' => \cSecurity::toInteger($this->client)
        );
        $this->db->query($sql, $values);
        while ($this->db->nextRecord()) {
            $idlang = $this->db->f('idlang');
            $url = false;
            if (!empty($articles[$idlang])) {
                $prob = array('idart' => $this->idart, 'lang' => $this->lang, 'changelang' => $idlang);
                $url = \cUri::getInstance()->build($prob);
            }

            $languages[$idlang]=array(
                'name' => $this->db->f('lang'),
                'url' => $url,
            );
        }

        return $languages;
    }

    private function articles($cfg){
        $articles = array();

        $sql = "SELECT art.idlang as idlang FROM :art_lang as art, :clients_lang as cl WHERE art.idlang = cl.idlang AND cl.idclient = :idclient AND art.idart = :idart";
        $values = array(
            'art_lang' => $cfg['tab']['art_lang'],
            'clients_lang' => $cfg['tab']['clients_lang'],
            'idclient' => \cSecurity::toInteger($this->client),
            'idart' => \cSecurity::toInteger($this->idart)
        );
        $this->db->query($sql, $values);
        while ($this->db->nextRecord()) {
            $articles[$this->db->f('idlang')]=$this->idart;
        }

        return $articles;
    }
}