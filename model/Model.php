<?php

namespace model;

class Model
{
    private $twig;
    private $arrForCurrentPage = [];
    private $routers = [];
    private $namePage = '';
    private $arrDir = [];

    public function setTwig($nameDirectory = '')
    {
        $loader = new \Twig\Loader\FilesystemLoader($nameDirectory);
        $this->twig = new \Twig\Environment($loader);
    }

    public function getTwig()
    {
        return $this->twig;
    }

    public function setArrForCurrentPage()
    {
        $this->arrForCurrentPage['person'] = $this->getArrPerson();
        $this->arrForCurrentPage['nowTime'] = date('Y-m-d');

        if($this->namePage === 'torrent')
            $this->setArrForPageTorrent();
    }

    public function getArrForCurrentPage(): array
    {
        if(isset($this->arrForCurrentPage))
            return $this->arrForCurrentPage;

        return [];
    }

    public function setRouters($arr)
    {
        $this->routers = $arr;
    }

    public function setNamePage($namePage = '')
    {
        $fl = true;
        $query = trim($_SERVER['REQUEST_URI'], '/');
        $arrRouters = $this->routers;

        if($query === '')
        {
            $this->namePage = 'torrent';
            $fl = false;
        }
        else
        {
            foreach ($arrRouters as $route) {
                if($query === $route)
                {
                    $this->namePage = $route;
                    $fl = false;
                }
            }
        }

        if($fl)
            $this->namePage = '404';
    }

    public function getNamePage()
    {
        return $this->namePage;
    }

    public function uploadFiles()
    {
        if(empty($_FILES['file']['name']))
            return false;

        if (!file_exists('uploads')) {
            mkdir('uploads', 0777);
        }

        $filename = time().'_'.$_FILES['file']['name'];

        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$filename);

        echo 'uploads/'.$filename;
        die;
    }

    public function downloadFile()
    {
        if(!isset($_POST['file_name']))
            return false;

        $file =  'uploads/' . $_POST['file_name'] . '.' . $_POST['file_type'] ;

        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit;
        }

        return 1;
    }

    private function getArrPerson()
    {
        if(isset($_COOKIE['user']))
            return ['person' => 'user'];
        elseif(isset($_COOKIE['admin']))
            return ['person' => 'admin'];
        else
            return ['person' => 'guest'];
    }

    private function setArrForPageTorrent()
    {
        $this->arrDir = scandir('uploads/');
        $arr['names'] = $this->getFilesName();
        $arr['sizes'] = $this->getFilesSize();
        $arr['types'] = $this->getFilesType();
        $this->arrForCurrentPage['arrFiles'] = $this->getArrFiles($arr);
    }

    private function getArrFiles($arr):array
    {
        if(empty($arr['names']) && empty($arr['sizes']) && empty($arr['types']))
            return [];

        $result = [];

        for($i = 0; $i < count($arr['names']); $i++)
        {
            $result[$i]['name'] =  $arr['names'][$i];
            $result[$i]['size'] =  $arr['sizes'][$i];
            $result[$i]['type'] =  $arr['types'][$i];
        }

        return $result;
    }

    private function getFilesName():array
    {
        $arrDir = $this->arrDir;
        $result = [];

        foreach ($arrDir as $item) {
            if($item !== "." && $item !== "..")
                $result[] = preg_replace('#(\.[a-zA-Z]+$)#', '', $item);
        }

        return $result;
    }

    private function getFilesSize():array
    {
        $arrDir = $this->arrDir;
        $result = [];

        foreach ($arrDir as $item) {
            if($item !== "." && $item !== "..")
            {
                $fileSize = intval(filesize('uploads/' . $item));

                if($fileSize >= 1073741824)
                    $result[] = round(($fileSize / 1073741824)) . 'ГБ' ;
                elseif($fileSize >= 1048576)
                    $result[] = round(($fileSize / 1048576)) . 'МБ' ;
                elseif($fileSize >= 1024)
                    $result[] = round(($fileSize / 1024), 2) . 'КБ' ;
                else
                    $result[] = round(($fileSize), 2) . 'Б' ;
            }
        }

        return $result;
    }

    private function getFilesType():array
    {
        $arrDir = $this->arrDir;
        $result = [];

        foreach ($arrDir as $item) {
            if($item !== "." && $item !== "..")
            {
                $splitFile = preg_split('#\.#', $item);
                $result[] = $splitFile[count($splitFile) - 1];
            }
        }

        return $result;
    }
}