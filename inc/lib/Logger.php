<?php

!defined('ROOT_PATH') && exit;

/**
 * 从dz中移植的日志记录代码
 */
class Logger {
    /**
     * 实时写入日志
     * @param mixed $log
     * @param string $file
     */
    public static function write($log, $file = 'log') {
        
        $yearmonth = date('Ym');
        $logdir = ROOT_PATH . '/data/log/';
        $logfile = $logdir . $yearmonth . '_' . $file . '.php';
        if (@filesize($logfile) > 2048000) {
            $dir = opendir($logdir);
            $length = strlen($file);
            $maxid = $id = 0;
            while ($entry = readdir($dir)) {
                if (strpos($entry, $yearmonth . '_' . $file) !== false) {
                    $id = intval(substr($entry, $length + 8, -4));
                    $id > $maxid && $maxid = $id;
                }
            }
            closedir($dir);

            $logfilebak = $logdir . $yearmonth . '_' . $file . '_' . ($maxid + 1) . '.php';
            @rename($logfile, $logfilebak);
        }
        if ($fp = @fopen($logfile, 'a')) {
            @flock($fp, 2);
            $log = var_export($log, true);
            $datetime = date('Y-m-d H:i:s');
            fwrite($fp, "<?PHP exit;?>\t{$datetime}\t" . str_replace(array('<?', '?>'), '', $log) . "\n");
            
            fclose($fp);
        }
    }

}
