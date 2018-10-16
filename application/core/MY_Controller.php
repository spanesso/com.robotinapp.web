<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    //Page info
    protected $data = Array();
    protected $pageName = FALSE;
    protected $template = "main";
    protected $hasNav = TRUE;
    //Page contents
    protected $javascript = array();
    protected $css = array();
    protected $fonts = array();
    //Page Meta
    protected $title = FALSE;
    protected $description = FALSE;
    protected $keywords = FALSE;
    protected $author = FALSE;

    function __construct() {

        parent::__construct();
        $this->data["uri_segment_1"] = $this->uri->segment(1);
        $this->data["uri_segment_2"] = $this->uri->segment(2);
        $this->title = $this->config->item('site_title');
        $this->description = $this->config->item('site_description');
        $this->keywords = $this->config->item('site_keywords');
        $this->author = $this->config->item('site_author');
        $this->pageName = strToLower(get_class($this));
    }

    protected function _simple_render($skeleton, $view, $style, $script) { 
        $body_view["content_body"] = $this->load->view($view, array_merge($this->data), true);
        $render_view["body"] = $this->load->view("template/" . $this->template, $body_view, true);
        $render_view["style"] = $style;
        $render_view["script"] = $script;
        $this->load->view($skeleton, $render_view);
    }

    protected function _render($skeleton, $view, $style, $script) {

        $is_logged_in = $this->session->userdata('is_logged_in');
 

        if (!isset($is_logged_in) || $is_logged_in !== true) {

            redirect("login", 'refresh');
        } else { 
            $body_view["content_body"] = $this->load->view($view, array_merge($this->data), true);
            $render_view["body"] = $this->load->view("template/" . $this->template, $body_view, true);
            $render_view["style"] = $style;
            $render_view["script"] = $script;
            $this->load->view($skeleton, $render_view);
        }
    }

    protected function getLanguageController($view, $menu) {
        if ($this->session->userdata('clicklanguaje') == "") {
            $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
            if ($idioma == "es") {
                $this->lang->load($menu, 'spanish');
                $this->lang->load($view, 'spanish');
            } else if ($idioma == "en") {
                $this->lang->load($menu, 'english');
                $this->lang->load($view, 'english');
            }
        } else if ($this->session->userdata('clicklanguaje') == "OK") {
            if ($this->session->userdata('languaje') == "ES") {
                $this->lang->load($menu, 'spanish');
                $this->lang->load($view, 'spanish');
            } else if ($this->session->userdata('languaje') == "EN") {
                $this->lang->load($menu, 'english');
                $this->lang->load($view, 'english');
            }
        }
    }

    protected function getLanguageSimpleController($view) {
        if ($this->session->userdata('clicklanguaje') == "") {
            $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
            if ($idioma == "es") {

                $this->lang->load($view, 'spanish');
            } else if ($idioma == "en") {
                $this->lang->load($menu, 'english');
                $this->lang->load($view, 'english');
            }
        } else if ($this->session->userdata('clicklanguaje') == "OK") {
            if ($this->session->userdata('languaje') == "ES") {

                $this->lang->load($view, 'spanish');
            } else if ($this->session->userdata('languaje') == "EN") {

                $this->lang->load($view, 'english');
            }
        }
    }

    protected function return_message($status, $message, $data) {
        $message_return = array(
            "status" => $status,
            "data" => $data,
            "message" => $message
        );
        return json_encode($message_return);
    }

    protected function validate_user() {

        $username = $this->input->server('PHP_AUTH_USER');
        $password = $this->input->server('PHP_AUTH_PW');

        if ($username == "def-com" && $password == "123k1j23adsfaesrsl2k3") {
            return true;
        } else {
            return false;
        }
    }

    protected function scanear_string($string) {
        $string = trim($string);
        $string = str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string);
        $string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string);
        $string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string);
        $string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string);
        $string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string);
        $string = str_replace(array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '_', $string);

        return $string;
    }

}
