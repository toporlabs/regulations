<?php

namespace Toporlabs\Regulations\Services;


class CommandService
{
    /**
     * Gets full path to file in application.
     *
     * @param $fileName
     * @param $appName
     *
     * @return null|string
     */
    public function getFilePath($fileName, $appName)
    {
        $filePath = null;
        $keyPaths = config('regulations.keys_paths');

        if (isset($keyPaths[$fileName])) {
            $path = $keyPaths[$fileName];
            $filePath =  str_replace('{appName}', $appName, $path) . $fileName;
        }

        return $filePath;
    }

    /**
     * Create backup directory if not exist
     *
     * @return bool
     */
    function makeBcDir()
    {
        $ret = @mkdir('regulations_backup');
        return $ret === true || is_dir('regulations_backup');
    }

}


