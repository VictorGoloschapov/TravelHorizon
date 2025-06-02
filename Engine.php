<?php
class Engine {
    private $_pageFile = "flight_search";
    private $_error = null;
    private $_pageTitle = null;
    private $_templateDir = 'templates/';

    public function __construct() {
        if (isset($_GET['page'])) {
            $page = $this->sanitizePage($_GET['page']);

            if ($this->templateExists($page)) {
                $this->_pageFile = $page;
            } else {
                $this->setError("Template '{$page}.php' not found");
            }
        }
    }
    
    private function sanitizePage($page) {
        return preg_replace("/[^a-zA-Z0-9_-]/", "", $page);
    }

    private function templateExists($page) {
        return file_exists($this->_templateDir . $page . ".php");
    }

    public function getPageFile() {
        return $this->_pageFile;
    }

    public function setError($error) {
        $this->_error = $error;
    }

    public function getError() {
        return $this->_error;
    }

    public function setPageTitle($pageTitle) {
        $this->_pageTitle = $pageTitle;
    }

    public function getPageTitle() {
        return $this->_pageTitle;
    }

    public function getContentPage() {
       $path = $this->_templateDir . $this->_pageFile . ".php";
    
        if (file_exists($path)) {
            ob_start();

            $departure = $_GET['departure'] ?? null;
            $arrival = $_GET['arrival'] ?? null;
            $date = $_GET['dateOfFlight'] ?? null;
            $pax = $_GET['pax_count'] ?? null;

            include $path;
            return ob_get_clean();
        } else {
            return "Template not found.";
        }
    }
}
?>