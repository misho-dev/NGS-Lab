<?php

namespace App\Model\Logger;

class Logger
{
    // TODO: move to global conf
    const LOG_DIR = '/var/log/';

    /** @var string $fileName */
    protected string $fileName;

    /** @var string $logDir */
    protected string $logDir;

    /**
     * Logger constructor.
     * @param $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->logDir = $_SERVER['DOCUMENT_ROOT'] . self::LOG_DIR;

        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0755, true);
        }
    }

    public function log($data)
    {
        $timestamp = "[" . date("Y-m-d H:i:s") . "] ";
        file_put_contents(
            $this->logDir . $this->fileName,
            $timestamp . $data . PHP_EOL,
            FILE_APPEND
        );
    }
}
